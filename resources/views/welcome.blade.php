<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Desa Adat Tamanbali - Portal Transparansi</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "error": "#ba1a1a",
                        "surface-dim": "#d9dadb",
                        "on-error-container": "#93000a",
                        "surface-container-highest": "#e1e3e4",
                        "on-secondary-container": "#745c00",
                        "secondary-fixed": "#ffe088",
                        "on-error": "#ffffff",
                        "on-primary-fixed-variant": "#264191",
                        "on-surface": "#191c1d",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed": "#6ffbbe",
                        "on-secondary-fixed-variant": "#574500",
                        "secondary": "#735c00",
                        "on-tertiary-container": "#27c38a",
                        "outline": "#757682",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f3f4f5",
                        "primary-fixed-dim": "#b6c4ff",
                        "error-container": "#ffdad6",
                        "surface": "#f8f9fa",
                        "tertiary-container": "#004a31",
                        "surface-tint": "#4059aa",
                        "on-secondary-fixed": "#241a00",
                        "surface-variant": "#e1e3e4",
                        "tertiary-fixed-dim": "#4edea3",
                        "surface-container": "#edeeef",
                        "secondary-fixed-dim": "#e9c349",
                        "inverse-primary": "#b6c4ff",
                        "tertiary": "#00311f",
                        "on-tertiary-fixed-variant": "#005236",
                        "surface-container-high": "#e7e8e9",
                        "primary": "#00236f",
                        "surface-bright": "#f8f9fa",
                        "on-primary-container": "#90a8ff",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed": "#00164e",
                        "primary-container": "#1e3a8a",
                        "primary-fixed": "#dce1ff",
                        "on-background": "#191c1d",
                        "inverse-on-surface": "#f0f1f2",
                        "on-surface-variant": "#444651",
                        "outline-variant": "#c5c5d3",
                        "secondary-container": "#fed65b",
                        "on-tertiary-fixed": "#002113",
                        "background": "#f8f9fa",
                        "inverse-surface": "#2e3132"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">

<!-- Top Navigation Bar -->
<nav class="docked full-width top-0 sticky z-50 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl shadow-[0_20px_40px_rgba(0,35,111,0.05)] bg-gradient-to-b from-white/10 to-transparent">
    <div class="flex justify-between items-center w-full px-8 py-4 max-w-7xl mx-auto">
        <div class="font-manrope tracking-tight text-xl font-bold text-[#00236f] dark:text-white flex items-center gap-2">
            <span class="material-symbols-outlined text-[#735c00]" style="font-variation-settings: 'FILL' 1;">account_balance</span>
            <span>Desa Adat Tamanbali</span>
        </div>
        <div class="hidden md:flex items-center gap-8 font-manrope tracking-tight font-bold">
            <a class="text-slate-600 dark:text-slate-400 hover:text-[#00236f] transition-colors" href="#">Beranda</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-[#00236f] transition-colors" href="#">Profil</a>
            <a class="text-[#00236f] dark:text-blue-300 border-b-2 border-[#735c00] pb-1" href="#">Transparansi</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-[#00236f] transition-colors" href="#">Budaya</a>
        </div>
        <a href="/admin" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-bold hover:bg-primary-container transition-all active:scale-95 duration-200 ease-in-out">
            Login Prajuru
        </a>
    </div>
</nav>

<!-- Hero Section -->
<header class="relative min-h-[716px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-black/50 z-10"></div>
    <img alt="Candi Bentar Gateway" class="absolute inset-0 w-full h-full object-cover" data-alt="majestic traditional Balinese temple gate Candi Bentar at dawn with soft morning light and mist in a serene village setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD1TRWOrUEbYXGzwFC1s0bdY8qcrwD8sPuI_cyX08s5sVNXbc4cXkn58YfWewtKJpytkCX9fYBQJmHOtkdsgc6yvHpyXxPzu35NW4vTb7r0RgA5Q-kGymJhGgMZhm4HOpHv9oF85x7lwiA9QH49L1xTbM1zPOEiitrXmxkGqPM9pG8PjshRdYa4xe4zMX-BCAcPj3sK5beqbdk3hkQkDEwuBqVxpkQKgO6ARNvWDKrIFBfX2-BZLRHhJo5hXy1_N7olgViVbDFWE1w"/>
    <div class="relative z-20 text-center px-4 max-w-4xl mx-auto">
        <h1 class="font-headline text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight">
            Portal Transparansi <br/>Administrasi &amp; Keuangan
        </h1>
        <p class="text-xl md:text-2xl text-white/80 font-medium max-w-2xl mx-auto leading-relaxed">
            Sistem informasi publik untuk mewujudkan tata kelola Desa Adat Tamanbali yang transparan dan akuntabel.
        </p>
    </div>
</header>

<!-- Financial Statistics Overlap -->
<section class="relative z-30 px-4 -mt-24 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="glass-card p-8 rounded-xl shadow-[0_20px_40px_rgba(0,35,111,0.05)] border border-white/20 flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <span class="text-primary font-bold text-sm tracking-widest uppercase">Saldo Kas Desa</span>
                <span class="material-symbols-outlined text-primary bg-primary-fixed/30 p-2 rounded-lg" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
            </div>
            <div>
                <h3 class="text-3xl font-headline font-extrabold text-primary">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h3>
                <p class="text-on-surface-variant text-sm mt-1">Status: Terverifikasi</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="glass-card p-8 rounded-xl shadow-[0_20px_40px_rgba(0,35,111,0.05)] border border-white/20 flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <span class="text-tertiary-container font-bold text-sm tracking-widest uppercase">Total Pemasukan</span>
                <span class="material-symbols-outlined text-tertiary-container bg-tertiary-fixed/30 p-2 rounded-lg" style="font-variation-settings: 'FILL' 1;">trending_up</span>
            </div>
            <div>
                <h3 class="text-3xl font-headline font-extrabold text-on-tertiary-container">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                <p class="text-on-surface-variant text-sm mt-1">Periode: Tahun {{ date('Y') }}</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="glass-card p-8 rounded-xl shadow-[0_20px_40px_rgba(0,35,111,0.05)] border border-white/20 flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <span class="text-error font-bold text-sm tracking-widest uppercase">Total Pengeluaran</span>
                <span class="material-symbols-outlined text-error bg-error-container/30 p-2 rounded-lg" style="font-variation-settings: 'FILL' 1;">trending_down</span>
            </div>
            <div>
                <h3 class="text-3xl font-headline font-extrabold text-error">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                <p class="text-on-surface-variant text-sm mt-1">Hingga hari ini</p>
            </div>
        </div>
    </div>
</section>

<!-- Main Content: Recent Activity -->
<main class="max-w-7xl mx-auto px-4 py-24">
    <div class="mb-12 flex items-center justify-between">
        <div>
            <h2 class="font-headline text-3xl font-extrabold text-primary mb-2">10 Transaksi Terakhir</h2>
            <div class="w-20 h-1.5 bg-secondary rounded-full"></div>
        </div>
        <button class="flex items-center gap-2 text-primary font-bold hover:underline">
            Lihat Semua Laporan
            <span class="material-symbols-outlined">arrow_forward</span>
        </button>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-[0_20px_40px_rgba(0,35,111,0.05)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high">
                        <th class="px-8 py-5 text-sm font-bold text-on-surface tracking-wider uppercase">Tanggal</th>
                        <th class="px-8 py-5 text-sm font-bold text-on-surface tracking-wider uppercase">Kategori</th>
                        <th class="px-8 py-5 text-sm font-bold text-on-surface tracking-wider uppercase">Keterangan</th>
                        <th class="px-8 py-5 text-sm font-bold text-on-surface tracking-wider uppercase text-center">Jenis</th>
                        <th class="px-8 py-5 text-sm font-bold text-on-surface tracking-wider uppercase text-right">Nominal (Rp)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high">
                    @forelse($transaksiTerbaru as $trx)
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-8 py-4 font-medium">{{ \Carbon\Carbon::parse($trx->tanggal_transaksi)->format('d M Y') }}</td>
                            <td class="px-8 py-4">{{ $trx->kategori->nama_kategori ?? '-' }}</td>
                            <td class="px-8 py-4">{{ $trx->keterangan }}</td>
                            <td class="px-8 py-4 text-center">
                                @if (strtolower($trx->jenis) == 'pemasukan')
                                    <span class="bg-tertiary-fixed text-on-tertiary-fixed-variant px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight">Pemasukan</span>
                                @else
                                    <span class="bg-error-container text-on-error-container px-3 py-1 rounded-full text-xs font-bold uppercase tracking-tight">Pengeluaran</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-right font-bold {{ strtolower($trx->jenis) == 'pemasukan' ? 'text-primary' : 'text-error' }}">
                                {{ number_format($trx->nominal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-surface-container-low/50">
                            <td class="px-8 py-10 text-center" colspan="5">
                                <div class="flex flex-col items-center justify-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-4xl mb-2 opacity-20">hourglass_empty</span>
                                    <p class="text-sm italic">Belum ada data transaksi.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Visual Divider Section -->
<section class="bg-surface-container-low py-24">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="relative">
            <div class="absolute -top-6 -left-6 w-32 h-32 bg-secondary/10 rounded-full blur-3xl"></div>
            <img alt="Transparency Visual" class="relative z-10 rounded-xl shadow-xl w-full h-[400px] object-cover" data-alt="abstract architectural minimalist stairs leading upwards with strong clean lines and professional corporate aesthetic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDTgMsLa4wXEDykHIZ44WeuGlG5_V2yDI5N8zjuQ_spOUjk1K98OFUYuI7n4WlzOwux1EOEx3i1rjnya3bUTKlv1VRVo6z9POOFKqnHtkxuNZnl_uiC3av7tVX9Mwo2H27nvACnSdnvmBPX0_cyEe2QnXZGPaNTyVtD2p9kIHZ_aLBiuIzpsVc_T26V5yYm9zy4SdThl8W4EelzV3m6R4EFeoB8l94zss5ycIP4JGVY5OcUJXxpJr14T6NWtz6esVOGJTFgIAwmBRM"/>
            <div class="absolute -bottom-6 -right-6 glass-card p-6 rounded-xl shadow-lg z-20">
                <p class="font-headline font-bold text-primary text-xl">100% Digital</p>
                <p class="text-sm text-on-surface-variant">Pencatatan Keuangan Desa</p>
            </div>
        </div>
        <div>
            <h3 class="font-headline text-4xl font-extrabold text-primary mb-6">Akuntabilitas Budaya Digital</h3>
            <p class="text-lg text-on-surface-variant mb-8 leading-relaxed">
                Kami mengadopsi teknologi digital untuk menjaga kepercayaan masyarakat. Setiap nominal yang masuk dan keluar dikelola secara profesional sesuai dengan hukum adat dan administrasi negara.
            </p>
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <div class="p-2 bg-secondary/10 rounded-lg">
                        <span class="material-symbols-outlined text-secondary">verified_user</span>
                    </div>
                    <div>
                        <p class="font-bold text-on-surface">Audit Internal Rutin</p>
                        <p class="text-sm text-on-surface-variant">Pemeriksaan dilakukan setiap bulan oleh tim Prajuru.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="p-2 bg-secondary/10 rounded-lg">
                        <span class="material-symbols-outlined text-secondary">visibility</span>
                    </div>
                    <div>
                        <p class="font-bold text-on-surface">Akses Publik Terbuka</p>
                        <p class="text-sm text-on-surface-variant">Warga dapat memantau dana pembangunan desa kapan saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-[#00236f] dark:bg-slate-950 w-full py-12">
    <div class="flex flex-col items-center justify-center space-y-6 w-full px-4 text-center">
        <div class="font-manrope font-bold text-white text-2xl flex items-center gap-3">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">account_balance</span>
            Desa Adat Tamanbali
        </div>
        <div class="flex flex-wrap justify-center gap-8 font-inter text-sm tracking-wide text-slate-300">
            <a class="hover:text-[#735c00] transition-colors" href="#">Kebijakan Privasi</a>
            <a class="hover:text-[#735c00] transition-colors" href="#">Kontak Kami</a>
            <a class="hover:text-[#735c00] transition-colors" href="#">Peta Desa</a>
        </div>
        <div class="w-16 h-px bg-slate-700"></div>
        <p class="font-inter text-sm tracking-wide text-slate-300 opacity-80 hover:opacity-100 transition-opacity">
            &copy; {{ date('Y') }} Desa Adat Tamanbali. Sistem Pengelolaan Tata Administrasi &amp; Keuangan.
        </p>
    </div>
</footer>

</body>
</html>
