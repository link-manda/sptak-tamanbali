@extends('public.layout')

@section('title', 'Beranda - Portal Transparansi Desa Adat Tamanbali')

@section('content')
    <main>
        <!-- 1. Hero Section (The Sacred Modernist) -->
        <section class="relative flex min-h-[700px] lg:min-h-[760px] items-center justify-center overflow-hidden bg-primary px-6 pt-16 pb-28 text-white">
            <!-- Batik Motif Background with Ambient Glow -->
            <div class="absolute inset-0 h-full w-full opacity-45 mix-blend-luminosity"
                style="background-image: url('{{ asset('images/batik_patern.jpeg') }}'); background-repeat: repeat; background-size: 420px;"></div>
            
            <div class="hero-overlay absolute inset-0 opacity-80"></div>
            
            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <!-- Eyebrow Badge -->
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-heritage_gold animate-pulse"></span>
                    <span class="font-headline text-[11px] font-bold uppercase tracking-[0.25em] text-heritage_gold_light">
                        Ngajegang Dresta, Ngelimbakang Desa
                    </span>
                </div>

                <!-- Main Display Heading -->
                <h1 class="mb-6 font-serif_display text-4xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-[1.1] text-balance">
                    Menjaga Martabat Leluhur,<br class="hidden sm:inline">
                    <span class="italic font-normal text-secondary_fixed_dim">Mewujudkan Keterbukaan Nyata bagi Krama.</span>
                </h1>

                <!-- Subtitle -->
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body text-pretty">
                    Ruang kebersamaan krama Desa Adat Tamanbali untuk menyimak keterbukaan kas desa, menelusuri pedoman awig-awig, serta mengawal capaian pembangunan desa secara jujur dan transparan.
                </p>

                <!-- Action CTAs -->
                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('keuangan') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-heritage_gold px-7 py-3.5 font-headline text-sm font-bold text-slate-900 shadow-md transition duration-200 hover:bg-secondary_container hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                        <span class="material-symbols-outlined text-lg">account_balance_wallet</span>
                        <span>Transparansi Kas &amp; Punia</span>
                    </a>
                    <a href="{{ route('awig') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-6 py-3.5 font-headline text-sm font-semibold text-white backdrop-blur-md transition duration-200 hover:bg-white/15 hover:border-white/40">
                        <span class="material-symbols-outlined text-lg">gavel</span>
                        <span>Pedoman Sukreta Awig-Awig</span>
                    </a>
                </div>
            </div>

            <!-- Fade to Surface Transition -->
            <div class="absolute bottom-0 left-0 z-10 w-full h-32 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Transparency Ribbon / Data Tape -->
        <section class="relative z-20 -mt-16 mx-auto max-w-6xl px-5">
            <div class="rounded-2xl border border-black/[0.08] bg-white p-6 md:p-8 shadow-hover_card">
                <div class="grid grid-cols-1 divide-y divide-black/[0.06] sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                    <!-- Stat 1: Banjar -->
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ $homeMetrics['banjar'] }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Wewidangan Banjar Adat
                        </div>
                    </div>

                    <!-- Stat 2: Krama -->
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ number_format($homeMetrics['krama_aktif']) }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Krama Ngarep &amp; Krama Desa
                        </div>
                    </div>

                    <!-- Stat 3: Dokumen -->
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ $homeMetrics['dokumen'] }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Arsip Awig &amp; Pararem Sah
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Asymmetric Bento Grid (Pusat Layanan & Transparansi) -->
        <section id="layanan-utama" class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-black/[0.06] pb-6">
                    <div>
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Sukreta Tata Kelola Desa</span>
                        <h2 class="mt-2 font-serif_display text-3xl sm:text-4xl font-bold tracking-tight text-primary">
                            Pusat Layanan Krama &amp; Keterbukaan Desa
                        </h2>
                    </div>
                    <p class="max-w-md text-sm text-on_surface_variant font-body">
                        Keterbukaan informasi dan kemudahan korespondensi resmi krama Desa Adat Tamanbali.
                    </p>
                </div>

                <!-- Bento Grid Layout -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
                    
                    <!-- Bento 1: Kas & Realisasi (Large Feature Card - Col Span 2) -->
                    <a href="{{ route('keuangan') }}"
                        class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card md:col-span-2">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                                <span class="material-symbols-outlined text-2xl">account_balance</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 font-headline text-[11px] font-bold text-emerald-800 border border-emerald-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                Akuntabel &amp; Terbuka
                            </span>
                        </div>

                        <div class="my-6">
                            <div class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Saldo Kas &amp; Punia Desa</div>
                            <div class="mt-2 font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                                Rp {{ number_format($saldoKas, 0, ',', '.') }}
                            </div>
                            <div class="mt-4 flex flex-wrap gap-2 text-xs">
                                <span class="rounded-lg bg-surface_container_low px-3 py-1.5 font-medium text-slate-600">
                                    Penerimaan Punia: <strong class="text-emerald-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</strong>
                                </span>
                                <span class="rounded-lg bg-surface_container_low px-3 py-1.5 font-medium text-slate-600">
                                    Belanja Ayahan: <strong class="text-amber-800">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-black/[0.06] pt-4 text-xs font-bold text-primary">
                            <span>Telusuri Rincian Kas &amp; Belanja Ayahan</span>
                            <span class="material-symbols-outlined text-sm transition group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </a>

                    <!-- Bento 2: Layanan Surat (Col Span 2 on Desktop) -->
                    <a href="{{ route('surat') }}"
                        class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card md:col-span-1 lg:col-span-2">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                                <span class="material-symbols-outlined text-2xl">mark_email_read</span>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 font-headline text-[11px] font-semibold text-slate-700">
                                Layanan Krama
                            </span>
                        </div>

                        <div class="my-6">
                            <h3 class="font-serif_display text-2xl font-bold text-primary">Layanan Persuratan</h3>
                            <p class="mt-2 text-sm leading-relaxed text-on_surface_variant">
                                Kemudahan penelusuran warta surat masuk dan permohonan surat keterangan adat bagi krama.
                            </p>
                        </div>

                        <div class="flex items-center justify-between border-t border-black/[0.06] pt-4 text-xs font-bold text-primary">
                            <span>Buka Arsip Persuratan</span>
                            <span class="material-symbols-outlined text-sm transition group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </a>

                    <!-- Bento 3: Awig-Awig Desa Adat -->
                    <a href="{{ route('awig') }}"
                        class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                                <span class="material-symbols-outlined text-2xl">gavel</span>
                            </div>
                        </div>

                        <div class="my-4">
                            <h3 class="font-serif_display text-xl font-bold text-primary">Awig-Awig Desa</h3>
                            <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                                Pedoman hukum adat warisan luhur demi kerukunan dan ketertiban bersama.
                            </p>
                        </div>

                        <div class="flex items-center justify-between border-t border-black/[0.06] pt-3 text-xs font-bold text-primary">
                            <span>Pelajari Awig-Awig</span>
                            <span class="material-symbols-outlined text-sm transition group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </a>

                    <!-- Bento 4: Pararem Desa -->
                    <a href="{{ route('pararem') }}"
                        class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                                <span class="material-symbols-outlined text-2xl">menu_book</span>
                            </div>
                        </div>

                        <div class="my-4">
                            <h3 class="font-serif_display text-xl font-bold text-primary">Pararem Desa</h3>
                            <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                                Ketetapan musyawarah dan kesepakatan paruman adat terkini.
                            </p>
                        </div>

                        <div class="flex items-center justify-between border-t border-black/[0.06] pt-3 text-xs font-bold text-primary">
                            <span>Lihat Pararem</span>
                            <span class="material-symbols-outlined text-sm transition group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </a>

                    <!-- Bento 5: Susunan Prajuru -->
                    <a href="{{ route('prajuru') }}"
                        class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card md:col-span-1 lg:col-span-2">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                                <span class="material-symbols-outlined text-2xl">groups</span>
                            </div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-heritage_gold">Pamong Adat</span>
                        </div>

                        <div class="my-4">
                            <h3 class="font-serif_display text-xl font-bold text-primary">Pamong Prajuru Desa</h3>
                            <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                                Jajaran prajuru yang tulus ngayah mengemban amanah pelayanan krama dan dresta desa.
                            </p>
                        </div>

                        <div class="flex items-center justify-between border-t border-black/[0.06] pt-3 text-xs font-bold text-primary">
                            <span>Bagan Kepengurusan</span>
                            <span class="material-symbols-outlined text-sm transition group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </a>

                    <!-- Bento 6: Program Prioritas Desa Adat (Tri Hita Karana Strategic Initiatives) -->
                    <a href="{{ route('program') }}"
                        class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card md:col-span-2 lg:col-span-2">
                        <div class="flex items-start justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                                <span class="material-symbols-outlined text-2xl">assignment_turned_in</span>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-heritage_gold/10 px-3 py-1 font-headline text-[11px] font-bold text-heritage_gold border border-heritage_gold/20">
                                <span class="h-1.5 w-1.5 rounded-full bg-heritage_gold animate-pulse"></span>
                                Tri Hita Karana
                            </span>
                        </div>

                        <div class="my-4">
                            <h3 class="font-serif_display text-xl font-bold text-primary">Program Prioritas Desa</h3>
                            <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                                Inisiasi langkah nyata prajuru dalam memelihara pura, merawat kerukunan, dan menjaga keasrian palemahan.
                            </p>

                            @if(isset($programHighlights) && $programHighlights->isNotEmpty())
                                <div class="mt-4 space-y-2.5 rounded-xl bg-surface_container_low p-3 border border-black/[0.04]">
                                    @foreach ($programHighlights->take(2) as $ph)
                                        <div class="text-xs">
                                             <div class="flex items-center justify-between mb-1">
                                                <span class="font-semibold text-slate-800 truncate max-w-[200px]">{{ $ph->nama_program }}</span>
                                                <span class="font-bold font-headline {{ $ph->persentase_progress == 100 ? 'text-emerald-700' : 'text-amber-700' }}">{{ $ph->persentase_progress }}%</span>
                                            </div>
                                            <div class="h-1.5 w-full rounded-full bg-slate-200 overflow-hidden">
                                                <div class="h-full rounded-full {{ $ph->persentase_progress == 100 ? 'bg-emerald-600' : 'bg-amber-500' }}" style="width: {{ $ph->persentase_progress }}%"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between border-t border-black/[0.06] pt-3 text-xs font-bold text-primary">
                            <span>Lihat Seluruh Program &amp; Capaian</span>
                            <span class="material-symbols-outlined text-sm transition group-hover:translate-x-1">arrow_forward</span>
                        </div>
                    </a>

                </div>
            </div>
        </section>

        <!-- 4. Living Archive & Banjar Highlights -->
        <section class="bg-surface_container_low px-6 py-20 border-t border-black/[0.06]">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-12 lg:grid-cols-12">
                    
                    <!-- Left: Profil & Highlight Banjar (7 Cols) -->
                    <div class="lg:col-span-7 space-y-8">
                        <div>
                            <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Identitas &amp; Wilayah</span>
                            <h2 class="mt-2 font-serif_display text-3xl sm:text-4xl font-bold tracking-tight text-primary">
                                {{ $infoSections['profil']['title'] }}
                            </h2>
                            <p class="mt-4 text-base leading-relaxed text-on_surface_variant font-body">
                                {{ $infoSections['profil']['body'] }}
                            </p>
                        </div>

                        <!-- Sebaran Banjar Adat Grid -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Sebaran Banjar Adat</span>
                                <a href="{{ route('profil') }}" class="text-xs font-semibold text-primary hover:underline">Lihat Seluruh Wilayah &rarr;</a>
                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">
                                @foreach ($banjarHighlights as $banjar)
                                    <div class="rounded-xl border border-black/[0.06] bg-white p-5 shadow-subtle transition hover:border-primary/30">
                                        <div class="flex items-start justify-between">
                                            <div class="font-serif_display text-lg font-bold text-primary">{{ $banjar->nama_banjar }}</div>
                                            <span class="rounded-full bg-primary/5 px-2.5 py-0.5 text-[11px] font-bold text-primary">
                                                {{ $banjar->kramas_count }} Krama
                                            </span>
                                        </div>
                                        <div class="mt-2 text-xs text-on_surface_variant">
                                            Kelian: <span class="font-medium text-slate-800">{{ $banjar->kelian_banjar ?: 'Prajuru Terkait' }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Right: 3 Pilar Utama (5 Cols) -->
                    <div class="lg:col-span-5 space-y-5">
                        <div class="rounded-2xl border border-black/[0.08] bg-white p-6 shadow-subtle">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-heritage_gold">shield_with_heart</span>
                                <h3 class="font-serif_display text-xl font-bold text-primary">{{ $infoSections['prajuru']['title'] }}</h3>
                            </div>
                            <p class="mt-3 text-xs leading-relaxed text-on_surface_variant">
                                {{ $infoSections['prajuru']['body'] }}
                            </p>
                            <a href="{{ route('prajuru') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                                <span>Detail Kepengurusan</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>

                        <div class="rounded-2xl border border-black/[0.08] bg-white p-6 shadow-subtle">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-heritage_gold">balance</span>
                                <h3 class="font-serif_display text-xl font-bold text-primary">{{ $infoSections['awig']['title'] }}</h3>
                            </div>
                            <p class="mt-3 text-xs leading-relaxed text-on_surface_variant">
                                {{ $infoSections['awig']['body'] }}
                            </p>
                            <a href="{{ route('awig') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                                <span>Eksplorasi Pasal</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>

                        <div class="rounded-2xl border border-black/[0.08] bg-white p-6 shadow-subtle">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-heritage_gold">history_edu</span>
                                <h3 class="font-serif_display text-xl font-bold text-primary">{{ $infoSections['pararem']['title'] }}</h3>
                            </div>
                            <p class="mt-3 text-xs leading-relaxed text-on_surface_variant">
                                {{ $infoSections['pararem']['body'] }}
                            </p>
                            <a href="{{ route('pararem') }}" class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-primary hover:underline">
                                <span>Hasil Paruman</span>
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 5. CTA Prajuru & Paruman Portal -->
        <section class="border-t border-black/[0.06] bg-surface px-6 py-16">
            <div class="mx-auto max-w-4xl rounded-2xl border border-primary/20 bg-primary/5 p-8 text-center sm:p-12">
                <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Akses Khusus Prajuru</span>
                <h3 class="mt-2 font-serif_display text-2xl sm:text-3xl font-bold text-primary">
                    Portal Administrasi &amp; Pembukuan Adat
                </h3>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-relaxed text-on_surface_variant">
                    Bagi Bendesa, Penyarikan, Petengen, dan Kelian Banjar yang mengemban amanah ngayah, silakan masuk ke panel pembukuan dan tata kelola krama.
                </p>
                <div class="mt-6 flex justify-center">
                    <a href="/admin"
                        class="inline-flex items-center gap-2 rounded-full bg-primary px-7 py-3 font-headline text-xs font-bold uppercase tracking-wider text-white shadow-md transition hover:bg-primary_container hover:shadow-lg">
                        <span class="material-symbols-outlined text-base">login</span>
                        <span>Masuk ke Panel Prajuru</span>
                    </a>
                </div>
            </div>
        </section>
    </main>
@endsection
