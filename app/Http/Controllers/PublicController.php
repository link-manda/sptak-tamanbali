<?php

namespace App\Http\Controllers;

use App\Models\Banjar;
use App\Models\Krama;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $totalPemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $transaksiTerbaru = Transaksi::with('kategori')
            ->orderBy('tanggal_transaksi', 'desc')
            ->take(10)
            ->get();

        $banjarHighlights = Banjar::withCount('kramas')
            ->orderBy('nama_banjar')
            ->take(4)
            ->get();

        $homeMetrics = [
            'banjar' => Banjar::count(),
            'krama_aktif' => Krama::where('status_aktif', true)->count(),
            'dokumen' => SuratMasuk::count() + SuratKeluar::count(),
        ];

        $contentCards = [
            [
                'title' => 'Profil Desa Adat Tamanbali',
                'description' => 'Sejarah, visi-misi, dan identitas luhur desa kami.',
                'icon' => 'account_balance',
                'target' => route('profil'),
            ],
            [
                'title' => 'Susunan Prajuru',
                'description' => 'Struktur organisasi dan pelayan masyarakat desa.',
                'icon' => 'groups',
                'target' => route('prajuru'),
            ],
            [
                'title' => 'Awig-Awig',
                'description' => 'Pedoman hukum adat dan tata tertib kehidupan desa.',
                'icon' => 'gavel',
                'target' => route('awig'),
            ],
            [
                'title' => 'Pararem',
                'description' => 'Keputusan dan kesepakatan terbaru rapat desa.',
                'icon' => 'menu_book',
                'target' => route('pararem'),
            ],
        ];

        $infoSections = [
            'profil' => [
                'title' => 'Profil Desa Adat Tamanbali',
                'body' => 'Desa Adat Tamanbali membangun tata kelola publik yang memadukan nilai adat, gotong royong, dan akuntabilitas digital untuk pelayanan masyarakat yang lebih terbuka.',
            ],
            'prajuru' => [
                'title' => 'Susunan Prajuru',
                'body' => 'Prajuru desa terdiri dari Bendesa Adat, penyarikan, petengen, dan unsur banjar yang bekerja bersama menjaga administrasi, keuangan, dan kegiatan adat berjalan tertib.',
            ],
            'awig' => [
                'title' => 'Awig-Awig',
                'body' => 'Awig-awig menjadi landasan tata kehidupan desa adat, termasuk aturan partisipasi krama, pengelolaan aset adat, dan mekanisme musyawarah dalam paruman desa.',
            ],
            'pararem' => [
                'title' => 'Pararem',
                'body' => 'Pararem dipakai untuk keputusan operasional dan penyesuaian kebijakan terbaru berdasarkan hasil rapat desa, terutama untuk kegiatan sosial, budaya, dan administrasi harian.',
            ],
        ];

        return view('public.home', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'transaksiTerbaru',
            'banjarHighlights',
            'homeMetrics',
            'contentCards',
            'infoSections',
        ));
    }

    public function keuangan(Request $request)
    {
        $scope = $request->string('scope')->toString() ?: 'rkt';

        $transaksiQuery = Transaksi::with('kategori')->orderByDesc('tanggal_transaksi');

        if ($scope === 'catur-wulan') {
            $transaksiQuery->where('tanggal_transaksi', '>=', now()->subMonths(4)->startOfDay());
        } elseif ($scope === 'realisasi') {
            $transaksiQuery->where('tanggal_transaksi', '>=', now()->startOfYear());
        } else {
            $transaksiQuery->where('tanggal_transaksi', '>=', now()->startOfYear());
        }

        $riwayatAnggaran = $transaksiQuery->take(8)->get();

        $totalPemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $hibahDonasi = Transaksi::query()
            ->where('jenis', 'pemasukan')
            ->whereHas('kategori', fn (Builder $query) => $query->where('nama_kategori', 'like', '%Dana%')->orWhere('nama_kategori', 'like', '%Bantuan%'))
            ->sum('nominal');

        $grafikKas = Transaksi::query()
            ->selectRaw('MONTH(tanggal_transaksi) as month_number, SUM(nominal) as total')
            ->where('jenis', 'pemasukan')
            ->where('tanggal_transaksi', '>=', now()->subMonths(3)->startOfMonth())
            ->groupBy('month_number')
            ->orderBy('month_number')
            ->pluck('total')
            ->pad(4, 0)
            ->values();

        $latestUpdate = Transaksi::latest('updated_at')->value('updated_at');

        return view('public.keuangan', compact(
            'scope',
            'riwayatAnggaran',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'hibahDonasi',
            'grafikKas',
            'latestUpdate',
        ));
    }

    public function surat(Request $request)
    {
        $jenis = $request->string('jenis')->toString();
        $search = $request->string('q')->toString();
        $startDate = $request->date('start_date');
        $endDate = $request->date('end_date');

        $suratMasuk = SuratMasuk::query()
            ->when($search, fn (Builder $query) => $query->where(function (Builder $inner) use ($search) {
                $inner->where('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('perihal', 'like', "%{$search}%")
                    ->orWhere('asal_surat', 'like', "%{$search}%");
            }))
            ->when($startDate, fn (Builder $query) => $query->whereDate('tanggal_surat', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('tanggal_surat', '<=', $endDate))
            ->get()
            ->map(fn (SuratMasuk $surat) => [
                'id' => 'masuk-' . $surat->id,
                'jenis' => 'Surat Masuk',
                'nomor_surat' => $surat->nomor_surat,
                'perihal' => $surat->perihal,
                'tanggal_surat' => Carbon::parse($surat->tanggal_surat),
                'asal_tujuan' => $surat->asal_surat,
                'file_surat' => $surat->file_surat,
                'status' => Carbon::parse($surat->created_at)->diffInDays(now()) <= 3 ? 'Baru' : 'Arsip',
            ]);

        $suratKeluar = SuratKeluar::query()
            ->when($search, fn (Builder $query) => $query->where(function (Builder $inner) use ($search) {
                $inner->where('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('perihal', 'like', "%{$search}%")
                    ->orWhere('tujuan_surat', 'like', "%{$search}%");
            }))
            ->when($startDate, fn (Builder $query) => $query->whereDate('tanggal_surat', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('tanggal_surat', '<=', $endDate))
            ->get()
            ->map(fn (SuratKeluar $surat) => [
                'id' => 'keluar-' . $surat->id,
                'jenis' => 'Surat Keluar',
                'nomor_surat' => $surat->nomor_surat,
                'perihal' => $surat->perihal,
                'tanggal_surat' => Carbon::parse($surat->tanggal_surat),
                'asal_tujuan' => $surat->tujuan_surat,
                'file_surat' => $surat->file_surat,
                'status' => Carbon::parse($surat->created_at)->diffInDays(now()) <= 2 ? 'Diproses' : 'Selesai',
            ]);

        $arsipDokumen = $suratMasuk
            ->concat($suratKeluar)
            ->when($jenis === 'surat-masuk', fn ($collection) => $collection->where('jenis', 'Surat Masuk'))
            ->when($jenis === 'surat-keluar', fn ($collection) => $collection->where('jenis', 'Surat Keluar'))
            ->sortByDesc('tanggal_surat')
            ->values();

        $featuredDocument = $arsipDokumen->first();
        $recentDocuments = $arsipDokumen->slice(1, 3)->values();

        return view('public.surat', compact(
            'jenis',
            'search',
            'startDate',
            'endDate',
            'arsipDokumen',
            'featuredDocument',
            'recentDocuments',
        ));
    }

    public function profil()
    {
        $banjars = Banjar::withCount('kramas')->orderBy('nama_banjar')->get();

        $profileStats = [
            'banjar' => $banjars->count(),
            'krama' => Krama::count(),
            'aktif' => Krama::where('status_aktif', true)->count(),
        ];

        $timeline = [
            ['year' => 'Awal 1900-an', 'title' => 'Tumbuh sebagai pusat banjar adat', 'body' => 'Tamanbali berkembang sebagai ruang hidup adat yang menata kegiatan keagamaan, sosial, dan pengelolaan banjar berbasis musyawarah.'],
            ['year' => 'Era pembaruan desa', 'title' => 'Administrasi adat makin tertib', 'body' => 'Pencatatan warga, kegiatan desa, dan pengelolaan surat diperkuat untuk mendukung pelayanan yang lebih rapi dan terbuka.'],
            ['year' => 'Transformasi digital', 'title' => 'Lahirnya portal transparansi', 'body' => 'Desa Adat Tamanbali mengadopsi sistem digital untuk membuka akses informasi keuangan dan administrasi kepada seluruh krama.'],
        ];

        return view('public.profil', compact('banjars', 'profileStats', 'timeline'));
    }

    public function prajuru()
    {
        $coreTeam = [
            ['role' => 'Bendesa Adat', 'name' => 'I Made Dharma Putra', 'desc' => 'Memimpin arah kebijakan desa adat dan memastikan keputusan paruman dijalankan secara tertib.'],
            ['role' => 'Penyarikan', 'name' => 'Ni Luh Sri Ayuni', 'desc' => 'Mengelola administrasi persuratan, notulen rapat, dan dokumentasi keputusan desa adat.'],
            ['role' => 'Petengen', 'name' => 'I Ketut Arsana', 'desc' => 'Mengawasi pengelolaan keuangan, pencatatan kas, dan pelaporan transparansi desa.'],
        ];

        $banjarLeaders = Banjar::orderBy('nama_banjar')->get(['nama_banjar', 'kelian_banjar']);

        return view('public.prajuru', compact('coreTeam', 'banjarLeaders'));
    }

    public function awig()
    {
        $principles = [
            ['title' => 'Tertib Paruman', 'body' => 'Setiap keputusan strategis desa adat diambil melalui musyawarah dan dituangkan dalam berita acara yang dapat dipertanggungjawabkan.'],
            ['title' => 'Gotong Royong Krama', 'body' => 'Krama berperan aktif dalam kegiatan adat, sosial, dan kebersihan lingkungan sebagai bentuk ngayah dan tanggung jawab bersama.'],
            ['title' => 'Akuntabilitas Aset Adat', 'body' => 'Pengelolaan keuangan, sarana upacara, dan aset desa dilakukan terbuka untuk menjaga kepercayaan warga.'],
            ['title' => 'Harmoni Sosial', 'body' => 'Awig-awig menjaga hubungan yang seimbang antara sesama krama, prajuru, dan lingkungan desa.'],
        ];

        return view('public.awig', compact('principles'));
    }

    public function pararem()
    {
        $pararemItems = [
            ['title' => 'Pararem Ketertiban Administrasi', 'status' => 'Aktif', 'body' => 'Mengatur standar pencatatan surat masuk, surat keluar, dan arsip digital untuk memastikan seluruh dokumen mudah ditelusuri.'],
            ['title' => 'Pararem Pelaporan Keuangan Berkala', 'status' => 'Aktif', 'body' => 'Mewajibkan pelaporan kas dan realisasi kegiatan pada periode tertentu agar seluruh krama dapat memantau penggunaan dana desa.'],
            ['title' => 'Pararem Dukungan Kegiatan Sosial Budaya', 'status' => 'Evaluasi Tahunan', 'body' => 'Menentukan prioritas dukungan kegiatan upacara, kebersihan, dan program bersama antar banjar.'],
        ];

        $documentsPublished = SuratMasuk::count() + SuratKeluar::count();

        return view('public.pararem', compact('pararemItems', 'documentsPublished'));
    }
}