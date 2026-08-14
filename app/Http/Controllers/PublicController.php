<?php

namespace App\Http\Controllers;

use App\Models\AwigAwig;
use App\Models\Banjar;
use App\Models\GaleriDesa;
use App\Models\Krama;
use App\Models\Pararem;
use App\Models\ProfilDesa;
use App\Models\ProgramPrioritas;
use App\Models\Prajuru;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\TimelineDesa;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $programHighlights = ProgramPrioritas::aktif()
            ->tampilBeranda()
            ->orderBy('urutan')
            ->orderByDesc('persentase_progress')
            ->take(3)
            ->get();

        return view('public.home', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'transaksiTerbaru',
            'banjarHighlights',
            'homeMetrics',
            'contentCards',
            'infoSections',
            'programHighlights',
        ));
    }

    public function program(Request $request)
    {
        $availableYears = ProgramPrioritas::distinct()
            ->orderByDesc('tahun_anggaran')
            ->pluck('tahun_anggaran')
            ->toArray();

        $currentYear = (int) date('Y');
        $selectedYear = $request->integer('tahun') ?: (in_array($currentYear, $availableYears) ? $currentYear : ($availableYears[0] ?? $currentYear));

        $programs = ProgramPrioritas::aktif()
            ->where('tahun_anggaran', $selectedYear)
            ->orderBy('urutan')
            ->orderByDesc('created_at')
            ->get();

        $bukuProgram = [
            'total_program'    => $programs->count(),
            'total_estimasi'   => $programs->sum('estimasi_anggaran'),
            'total_realisasi'  => $programs->sum('realisasi_anggaran'),
            'avg_progress'     => $programs->count() > 0 ? round($programs->avg('persentase_progress')) : 0,
            'selesai_count'    => $programs->where('status', ProgramPrioritas::STATUS_SELESAI)->count(),
            'berjalan_count'   => $programs->where('status', ProgramPrioritas::STATUS_BERJALAN)->count(),
            'rencana_count'    => $programs->where('status', ProgramPrioritas::STATUS_DIRENCANAKAN)->count(),
        ];

        $bidangOptions = ProgramPrioritas::bidangOptions();
        $statusOptions = ProgramPrioritas::statusOptions();

        return view('public.program', compact(
            'programs',
            'availableYears',
            'selectedYear',
            'bukuProgram',
            'bidangOptions',
            'statusOptions'
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

        $monthNames = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Ags', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        $monthFullNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // Ambil data pemasukan & pengeluaran per bulan di tahun yang dipilih
        $monthlyTotals = Transaksi::query()
            ->selectRaw('MONTH(tanggal_transaksi) as bulan, jenis, SUM(nominal) as total')
            ->whereYear('tanggal_transaksi', $tahun)
            ->groupBy('bulan', 'jenis')
            ->get();

        // Tentukan rentang 6 bulan yang relevan untuk ditampilkan
        $currentYear = (int) date('Y');
        if ($tahun == $currentYear) {
            $endMonth = (int) date('n');
            $startMonth = max(1, $endMonth - 5);
            if ($endMonth < 6) {
                $startMonth = 1;
                $endMonth = 6;
            }
        } else {
            $startMonth = 1;
            $endMonth = 6;
        }

        // Cari nilai maksimum untuk normalisasi tinggi grafik batang
        $maxVal = $monthlyTotals->max('total') ?: 1;

        $grafikKas = collect(range($startMonth, $endMonth))->map(function ($m) use ($monthlyTotals, $monthNames, $monthFullNames, $tahun, $maxVal) {
            $in = $monthlyTotals->where('bulan', $m)->where('jenis', 'pemasukan')->sum('total');
            $out = $monthlyTotals->where('bulan', $m)->where('jenis', 'pengeluaran')->sum('total');
            
            return [
                'bulan_num'       => $m,
                'bulan_label'     => $monthNames[$m] ?? "B$m",
                'bulan_full'      => ($monthFullNames[$m] ?? "Bulan $m") . " $tahun",
                'pemasukan'       => $in,
                'pengeluaran'     => $out,
                'pemasukan_rp'    => 'Rp ' . number_format($in, 0, ',', '.'),
                'pengeluaran_rp'   => 'Rp ' . number_format($out, 0, ',', '.'),
                'height_in'       => $in > 0 ? max(14, min(100, intval(($in / $maxVal) * 100))) : 4,
                'height_out'      => $out > 0 ? max(14, min(100, intval(($out / $maxVal) * 100))) : 4,
            ];
        });

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

    /**
     * Generate laporan Realisasi Kegiatan sebagai PDF (dompdf).
     * aksi=preview => stream inline (untuk viewer pdf.js, same-origin).
     * aksi=unduh   => download attachment.
     */
    public function laporanRealisasi(Request $request)
    {
        $tahun = $request->integer('tahun') ?: (int) date('Y');
        $aksi = $request->string('aksi')->toString() ?: 'preview';

        // Regenerate data realisasi sama seperti scope 'realisasi' di keuangan():
        // 15 transaksi terbaru pada tahun terkait.
        $riwayatAnggaran = Transaksi::with('kategori')
            ->whereYear('tanggal_transaksi', $tahun)
            ->orderByDesc('tanggal_transaksi')
            ->take(15)
            ->get();

        $totalPemasukan = $riwayatAnggaran->where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = $riwayatAnggaran->where('jenis', 'pengeluaran')->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('pdf.laporan-realisasi', compact(
            'tahun',
            'riwayatAnggaran',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
        ))->setPaper('a4', 'portrait');

        $namaFile = 'Laporan-Realisasi-Kegiatan-'.$tahun.'.pdf';

        // download() = attachment; stream() = inline (dibuka langsung / di-fetch pdf.js).
        return $aksi === 'unduh'
            ? $pdf->download($namaFile)
            : $pdf->stream($namaFile);
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

        $galeris = GaleriDesa::aktif()
            ->orderBy('urutan')
            ->orderByDesc('tanggal_kegiatan')
            ->get();

        $kategoriGaleri = GaleriDesa::kategoriOptions();

        return view('public.profil', compact(
            'banjars',
            'profileStats',
            'profil',
            'timeline',
            'galeris',
            'kategoriGaleri'
        ));
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