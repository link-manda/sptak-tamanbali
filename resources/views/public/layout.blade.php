<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Desa Adat Tamanbali')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Alpine.js Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#00236f',
                        primary_container: '#1e3a8a',
                        primary_fixed_dim: '#b6c4ff',
                        secondary: '#735c00',
                        secondary_container: '#fed65b',
                        secondary_fixed_dim: '#e9c349',
                        tertiary_fixed: '#6ffbbe',
                        tertiary_container: '#004a31',
                        surface: '#f8f9fa',
                        surface_container_low: '#f3f4f5',
                        surface_container: '#edeeef',
                        surface_container_high: '#e7e8e9',
                        surface_container_highest: '#e1e3e4',
                        outline: '#757682',
                        outline_variant: '#c5c5d3',
                        on_surface: '#191c1d',
                        on_surface_variant: '#444651',
                        error: '#ba1a1a',
                        error_container: '#ffdad6',
                        on_error_container: '#93000a',
                    },
                    fontFamily: {
                        headline: ['Manrope', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        sky: '0 20px 40px rgba(0, 35, 111, 0.05)',
                    },
                    borderRadius: {
                        xl: '1.5rem',
                    },
                },
            },
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .hero-overlay {
            background: radial-gradient(circle at top left, rgba(30, 58, 138, 0.25), transparent 45%),
                linear-gradient(135deg, rgba(0, 35, 111, 0.92), rgba(30, 58, 138, 0.55));
        }
    </style>
</head>

<body class="bg-surface text-on_surface font-body">
    <header class="sticky top-0 z-50 bg-white/75 backdrop-blur-xl shadow-sky">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 md:px-8">
            <a class="flex items-center gap-2 font-headline text-xl font-extrabold tracking-tight text-primary"
                href="{{ route('home') }}">
                <span class="material-symbols-outlined text-secondary"
                    style="font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 24;">temple_hindu</span>
                <span>Desa Adat Tamanbali</span>
            </a>

            <nav class="hidden items-center gap-8 font-headline text-sm font-semibold md:flex">
                <a class="{{ request()->routeIs('home') ? 'border-b-2 border-secondary pb-1 text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors"
                    href="{{ route('home') }}">Beranda</a>
                <a class="{{ request()->routeIs('keuangan') ? 'border-b-2 border-secondary pb-1 text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors"
                    href="{{ route('keuangan') }}">Keuangan</a>
                <a class="{{ request()->routeIs('surat') ? 'border-b-2 border-secondary pb-1 text-primary' : 'text-slate-500 hover:text-primary' }} transition-colors"
                    href="{{ route('surat') }}">Surat</a>
            </nav>

            <a class="rounded-full bg-primary px-6 py-2.5 font-headline text-sm font-bold text-white transition hover:bg-primary_container"
                href="/admin">
                Login Prajuru
            </a>
        </div>
    </header>

    @yield('content')

    <footer class="bg-primary px-6 pb-8 pt-14 text-white">
        <div class="mx-auto max-w-7xl text-center">
            <div class="mb-6 font-headline text-2xl font-extrabold tracking-tight text-secondary_fixed_dim">Tamanbali
                Digital Banjar</div>
            <div class="mb-8 flex flex-wrap justify-center gap-8 text-xs uppercase tracking-[0.28em] text-slate-300">
                <a class="hover:text-white" href="{{ route('home') }}#profil-desa">Sejarah</a>
                <a class="hover:text-white" href="{{ route('home') }}#awig-awig">Budaya</a>
                <a class="hover:text-white" href="{{ route('surat') }}">Kontak</a>
                <a class="hover:text-white" href="{{ route('keuangan') }}">Transparansi</a>
            </div>
            <div class="border-t border-white/10 pt-6 text-[11px] uppercase tracking-[0.2em] text-slate-400">
                &copy; {{ date('Y') }} Desa Adat Tamanbali. The Digital Banjar.
            </div>
        </div>
    </footer>
</body>

</html>
