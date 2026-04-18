<?php

namespace App\Http\Controllers;

use App\Models\AwigAwig;
use App\Models\Banjar;
use App\Models\Krama;
use App\Models\Pararem;
use App\Models\ProfilDesa;
use App\Models\Prajuru;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\TimelineDesa;
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
            'banjar'      => Banjar::count(),
            'krama_aktif' => Krama::where('status_aktif', true)->count(),
            'dokumen'     => SuratMasuk::count() + SuratKeluar::count(),
        ];

        $contentCards = [
            [
                'title'       => 'Profil Desa Adat Tamanbali',
                'description' => 'Sejarah, visi-misi, dan identitas luhur desa kami.',
                'icon'        => 'account_balance',
                'target'      => route('profil'),
            ],
            [
                'title'       => 'Susunan Prajuru',
                'description' => 'Struktur organisasi dan pelayan masyarakat desa.',
                'icon'        => 'groups',
                'target'      => route('prajuru'),
            ],
            [
                'title'       => 'Awig-Awig',
                'description' => 'Pedoman hukum adat dan tata tertib kehidupan desa.',
                'icon'        => 'gavel',
                'target'      => route('awig'),
            ],
            [
                'title'       => 'Pararem',
                'description' => 'Keputusan dan kesepakatan terbaru rapat desa.',
                'icon'        => 'menu_book',
                'target'      => route('pararem'),
            ],
        ];

        $infoSections = [
            'profil' => [
                'title' => 'Profil Desa Adat Tamanbali',
                'body'  => 'Desa Adat Tamanbali membangun tata kelola publik yang memadukan nilai adat, gotong royong, dan akuntabilitas digital untuk pelayanan masyarakat yang lebih terbuka.',
            ],
            'prajuru' => [
                'title' => 'Susunan Prajuru',
                'body'  => 'Prajuru desa terdiri dari Bendesa Adat, penyarikan, petengen, dan unsur banjar yang bekerja bersama menjaga administrasi, keuangan, dan kegiatan adat berjalan tertib.',
            ],
            'awig' => [
                'title' => 'Awig-Awig',
                'body'  => 'Awig-awig menjadi landasan tata kehidupan desa adat, termasuk aturan partisipasi krama, pengelolaan aset adat, dan mekanisme musyawarah dalam paruman desa.',
            ],
            'pararem' => [
                'title' => 'Pararem',
                'body'  => 'Pararem dipakai untuk keputusan operasional dan penyesuaian kebijakan terbaru berdasarkan hasil rapat desa, terutama untuk kegiatan sosial, budaya, dan administrasi harian.',
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
        $tahun = $request->integer('tahun') ?: date('Y');

        // Mengambil tahun-tahun yang tersedia dari data transaksi
        $availableYears = Transaksi::selectRaw('YEAR(tanggal_transaksi) as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        // Pastikan tahun yang diminta ada dalam data, jika tidak fallback ke tahun terbaru yang ada
        if ($availableYears->isNotEmpty() && !$availableYears->contains($tahun)) {
            $tahun = $availableYears->first();
        }

        $transaksiQuery = Transaksi::with('kategori')
            ->whereYear('tanggal_transaksi', $tahun)
            ->orderByDesc('tanggal_transaksi');

        $riwayatAnggaran = collect();
        $caturWulanData = [];

        if ($scope === 'catur-wulan') {
            $allTransactions = $transaksiQuery->get();
            
            // Definisi rentang bulan untuk tiap Catur Wulan
            $periods = [
                ['id' => 'cw3', 'label' => 'Catur Wulan III (September - Desember)', 'months' => [9, 10, 11, 12]],
                ['id' => 'cw2', 'label' => 'Catur Wulan II (Mei - Agustus)', 'months' => [5, 6, 7, 8]],
                ['id' => 'cw1', 'label' => 'Catur Wulan I (Januari - April)', 'months' => [1, 2, 3, 4]],
            ];

            foreach ($periods as $period) {
                // Filter transaksi yang termasuk dalam rentang bulan CW ini
                $items = $allTransactions->filter(function ($t) use ($period) {
                    $month = \Carbon\Carbon::parse($t->tanggal_transaksi)->month;
                    return in_array($month, $period['months']);
                });
                
                // Hanya tambahkan jika ada data (sesuai request: tidak perlu menampilkan status kosong)
                if ($items->isNotEmpty()) {
                    $in = $items->where('jenis', 'pemasukan')->sum('nominal');
                    $out = $items->where('jenis', 'pengeluaran')->sum('nominal');
                    
                    $caturWulanData[] = [
                        'id' => $period['id'],
                        'label' => $period['label'],
                        'items' => $items,
                        'totals' => [
                            'pemasukan' => $in,
                            'pengeluaran' => $out,
                            'saldo' => $in - $out
                        ]
                    ];
                }
            }
        } else {
            // Default untuk scope rkt dan realisasi (15 data terbaru di tahun tersebut)
            $riwayatAnggaran = $transaksiQuery->take(15)->get();
        }

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
            'tahun',
            'availableYears',
            'riwayatAnggaran',
            'caturWulanData',
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
                'id'            => 'masuk-' . $surat->id,
                'jenis'         => 'Surat Masuk',
                'nomor_surat'   => $surat->nomor_surat,
                'perihal'       => $surat->perihal,
                'tanggal_surat' => Carbon::parse($surat->tanggal_surat),
                'asal_tujuan'   => $surat->asal_surat,
                'file_surat'    => $surat->file_surat,
                'status'        => Carbon::parse($surat->created_at)->diffInDays(now()) <= 3 ? 'Baru' : 'Arsip',
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
                'id'            => 'keluar-' . $surat->id,
                'jenis'         => 'Surat Keluar',
                'nomor_surat'   => $surat->nomor_surat,
                'perihal'       => $surat->perihal,
                'tanggal_surat' => Carbon::parse($surat->tanggal_surat),
                'asal_tujuan'   => $surat->tujuan_surat,
                'file_surat'    => $surat->file_surat,
                'status'        => Carbon::parse($surat->created_at)->diffInDays(now()) <= 2 ? 'Diproses' : 'Selesai',
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
            'krama'  => Krama::count(),
            'aktif'  => Krama::where('status_aktif', true)->count(),
        ];

        // Data dari DB — fallback ke objek kosong jika belum diisi
        $profil   = ProfilDesa::getSingleton();
        $timeline = TimelineDesa::orderBy('urutan')->get();

        return view('public.profil', compact('banjars', 'profileStats', 'profil', 'timeline'));
    }

    public function prajuru()
    {
        // Data prajuru dikelompokkan berdasarkan kategori
        // Khusus untuk coreTeam (Inti), kita ambil hierarchy (parent-child)
        $coreTeam = Prajuru::aktif()
            ->with('children')
            ->where('kategori', Prajuru::CAT_INTI)
            ->whereNull('parent_id')
            ->orderBy('urutan')
            ->get();

        $balaAngkep = Prajuru::aktif()
            ->where('kategori', Prajuru::CAT_BALA_ANGKEP)
            ->orderBy('urutan')
            ->get();

        $sabhaDesa = Prajuru::aktif()
            ->where('kategori', Prajuru::CAT_SABHA_DESA)
            ->orderBy('urutan')
            ->get();

        $kertaDesa = Prajuru::aktif()
            ->where('kategori', Prajuru::CAT_KERTA_DESA)
            ->orderBy('urutan')
            ->get();

        $banjarLeaders = Banjar::orderBy('nama_banjar')->get(['nama_banjar', 'kelian_banjar']);

        return view('public.prajuru', compact(
            'coreTeam',
            'banjarLeaders',
            'balaAngkep',
            'sabhaDesa',
            'kertaDesa'
        ));
    }

    public function awig()
    {
        // Prinsip/pasal awig-awig dari DB, sorted by urutan
        $principles = AwigAwig::aktif()->orderBy('urutan')->get();

        return view('public.awig', compact('principles'));
    }

    public function pararem()
    {
        // Item pararem dari DB — sorted: aktif dulu, lalu evaluasi, lalu tidak aktif
        $pararemItems = Pararem::orderByRaw("FIELD(status, 'aktif', 'evaluasi', 'tidak_aktif')")
            ->orderByDesc('tanggal_ditetapkan')
            ->get();

        $documentsPublished = SuratMasuk::count() + SuratKeluar::count();

        return view('public.pararem', compact('pararemItems', 'documentsPublished'));
    }
}