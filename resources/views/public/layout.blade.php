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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#00236f',
                        primary_container: '#0f317d',
                        primary_fixed_dim: '#b6c4ff',
                        secondary: '#8a6d00',
                        secondary_container: '#fed65b',
                        secondary_fixed_dim: '#e9c349',
                        heritage_gold: '#b48a3c',
                        heritage_gold_light: '#fbf3db',
                        charcoal: '#0f172a',
                        surface: '#f9f8f6',
                        surface_container_low: '#f3f2ee',
                        surface_container: '#ebe9e3',
                        surface_container_high: '#e3e1da',
                        surface_container_highest: '#dbd9d1',
                        outline: '#757682',
                        outline_variant: '#c5c5d3',
                        on_surface: '#181c20',
                        on_surface_variant: '#43474e',
                        error: '#ba1a1a',
                        error_container: '#ffdad6',
                        on_error_container: '#93000a',
                    },
                    fontFamily: {
                        serif_display: ['Newsreader', 'Georgia', 'serif'],
                        headline: ['Plus Jakarta Sans', 'Manrope', 'sans-serif'],
                        body: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        sky: '0 20px 40px rgba(0, 35, 111, 0.05)',
                        subtle: '0 2px 8px rgba(0, 0, 0, 0.04)',
                        hover_card: '0 12px 30px rgba(0, 35, 111, 0.08)',
                    },
                    borderRadius: {
                        xl: '1.5rem',
                        '2xl': '1.75rem',
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

<body class="bg-surface text-on_surface font-body antialiased selection:bg-heritage_gold_light selection:text-secondary">
    <header class="sticky top-0 z-50 bg-white/85 backdrop-blur-xl border-b border-black/[0.06] shadow-subtle">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 md:px-8">
            <a class="flex items-center gap-3 font-headline text-lg md:text-xl font-bold tracking-tight text-primary transition hover:opacity-90"
                href="{{ route('home') }}">
                <img class="h-10 w-10 md:h-11 md:w-11 rounded-full object-cover ring-2 ring-heritage_gold/40 shadow-sm"
                    src="{{ asset('images/logo_tamanbali.jpeg') }}"
                    alt="Logo Desa Adat Tamanbali" />
                <div class="flex flex-col">
                    <span class="leading-tight">Desa Adat Tamanbali</span>
                    <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-heritage_gold">Kabupaten Bangli</span>
                </div>
            </a>

            <nav class="hidden items-center gap-7 lg:gap-8 font-headline text-sm font-semibold md:flex">
                <a class="{{ request()->routeIs('home') ? 'text-primary font-bold border-b-2 border-heritage_gold pb-1' : 'text-slate-600 hover:text-primary' }} transition-colors"
                    href="{{ route('home') }}">Beranda</a>
                <a class="{{ request()->routeIs('program*') ? 'text-primary font-bold border-b-2 border-heritage_gold pb-1' : 'text-slate-600 hover:text-primary' }} transition-colors"
                    href="{{ route('program') }}">Program</a>
                <a class="{{ request()->routeIs('keuangan*') ? 'text-primary font-bold border-b-2 border-heritage_gold pb-1' : 'text-slate-600 hover:text-primary' }} transition-colors"
                    href="{{ route('keuangan') }}">Keuangan</a>
                <a class="{{ request()->routeIs('surat*') ? 'text-primary font-bold border-b-2 border-heritage_gold pb-1' : 'text-slate-600 hover:text-primary' }} transition-colors"
                    href="{{ route('surat') }}">Surat</a>
            </nav>

            <a class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 font-headline text-xs font-bold uppercase tracking-wider text-white shadow-sm transition hover:bg-primary_container hover:shadow-md"
                href="/admin">
                <span class="material-symbols-outlined text-sm">lock</span>
                <span>Login Prajuru</span>
            </a>
        </div>
    </header>

    @yield('content')

    <footer class="border-t border-black/[0.08] bg-primary px-6 pb-12 pt-16 text-white">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col items-center justify-between gap-8 pb-12 text-center md:flex-row md:text-left">
                <div class="flex items-center gap-4">
                    <img class="h-12 w-12 rounded-full object-cover ring-2 ring-heritage_gold/50"
                        src="{{ asset('images/logo_tamanbali.jpeg') }}"
                        alt="Logo Desa Adat Tamanbali" />
                    <div>
                        <div class="font-serif_display text-2xl font-bold tracking-tight text-white">Desa Adat Tamanbali</div>
                        <p class="text-xs uppercase tracking-[0.2em] text-heritage_gold_light/70">Kecamatan Bangli, Kabupaten Bangli, Bali</p>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-6 lg:gap-8 font-headline text-xs font-medium uppercase tracking-[0.2em] text-slate-300">
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('profil') }}">Profil &amp; Sejarah</a>
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('prajuru') }}">Susunan Prajuru</a>
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('program') }}">Program Prioritas</a>
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('awig') }}">Awig-Awig</a>
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('pararem') }}">Pararem</a>
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('keuangan') }}">Transparansi Kas</a>
                    <a class="transition hover:text-heritage_gold_light" href="{{ route('surat') }}">Layanan Surat</a>
                </div>
            </div>
            <div class="flex flex-col items-center justify-between gap-4 border-t border-white/10 pt-8 text-[11px] uppercase tracking-[0.2em] text-slate-400 md:flex-row">
                <div>&copy; {{ date('Y') }} Desa Adat Tamanbali. Sistem Informasi &amp; Portal Transparansi Publik.</div>
                <div class="text-slate-500">Mewujudkan Tata Kelola Adat yang Akuntabel &amp; Berkelanjutan</div>
            </div>
        </div>
    </footer>
</body>

</html>
