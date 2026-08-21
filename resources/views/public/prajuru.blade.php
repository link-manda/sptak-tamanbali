@extends('public.layout')

@section('title', 'Susunan Prajuru - Desa Adat Tamanbali')

@section('content')
    <main>
        <!-- 1. Hero Section -->
        <section class="relative flex min-h-[440px] items-center justify-center overflow-hidden bg-primary px-6 pt-16 pb-24 text-white">
            <div class="absolute inset-0 h-full w-full opacity-40 mix-blend-luminosity"
                style="background-image: url('{{ asset('images/batik_patern.jpeg') }}'); background-repeat: repeat; background-size: 420px;"></div>
            
            <div class="hero-overlay absolute inset-0 opacity-85"></div>

            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-heritage_gold animate-pulse"></span>
                    <span class="font-headline text-[11px] font-bold uppercase tracking-[0.25em] text-heritage_gold_light">
                        Pamong &amp; Pengabdi Adat
                    </span>
                </div>
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Pamong Prajuru Desa Adat
                </h1>
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    Para pengabdi dan pengemban amanah paruman desa yang tulus ngayah memelihara ketertiban dresta, kejujuran tata kelola, dan ketenteraman krama Tamanbali.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Manggal Desa Adat (Core Executive Board) -->
        <section class="bg-surface px-6 py-16">
            <div class="mx-auto max-w-7xl">
                <div class="mb-12 border-b border-black/[0.06] pb-5">
                    <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Penggerak &amp; Pelayan Adat</span>
                    <h2 class="mt-1 font-serif_display text-3xl sm:text-4xl font-bold text-primary">
                        Manggala Prajuru Inti (Duaning Desa)
                    </h2>
                    <p class="mt-1 text-xs text-on_surface_variant">Pucuk pimpinan kepengurusan adat yang tulus ngayah mengayomi dan mengoordinasikan seluruh tata kelola desa.</p>
                </div>

                @if ($coreTeam->isEmpty())
                    <div class="rounded-2xl border border-black/[0.08] bg-white p-12 text-center">
                        <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">groups</span>
                        <p class="text-xs text-on_surface_variant">Data prajuru inti belum tersedia.</p>
                    </div>
                @else
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($coreTeam as $member)
                            <article class="flex flex-col justify-between rounded-2xl border border-black/[0.08] bg-white p-8 shadow-subtle transition duration-300 hover:border-primary/30 hover:shadow-hover_card">
                                <div>
                                    <!-- Foto Profil -->
                                    <div class="flex flex-col items-center text-center">
                                        <div class="relative mb-5 h-28 w-28 overflow-hidden rounded-full ring-4 ring-heritage_gold/30 shadow-md">
                                            <img src="{{ $member->foto_url }}" alt="Foto {{ $member->nama_lengkap }}"
                                                class="h-full w-full object-cover" />
                                        </div>
                                        <span class="rounded-full bg-surface_container_low px-3 py-1 font-headline text-[10px] font-bold uppercase tracking-wider text-heritage_gold border border-black/[0.06]">
                                            {{ $member->jabatan }}
                                        </span>
                                        <h3 class="mt-3 font-serif_display text-2xl font-bold text-primary">
                                            {{ $member->nama_lengkap }}
                                        </h3>
                                    </div>

                                    @if ($member->deskripsi)
                                        <p class="mt-4 text-center text-xs leading-relaxed text-on_surface_variant">
                                            {{ $member->deskripsi }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Sub-Jabatan / Hierarki (Staf/Juru Raksa) -->
                                @if ($member->children->isNotEmpty())
                                    <div class="mt-8 border-t border-black/[0.06] pt-5">
                                        <span class="mb-3 block text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                            Perangkat Pendukung / Staf
                                        </span>
                                        <div class="space-y-3">
                                            @foreach ($member->children as $child)
                                                <div class="flex items-center gap-3.5 rounded-xl bg-surface_container_low/70 p-3">
                                                    <div class="h-10 w-10 shrink-0 overflow-hidden rounded-full ring-1 ring-primary/20">
                                                        <img src="{{ $child->foto_url }}" alt="Foto {{ $child->nama_lengkap }}"
                                                            class="h-full w-full object-cover" />
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div class="text-[10px] font-bold uppercase tracking-wider text-heritage_gold">
                                                            {{ $child->jabatan }}
                                                        </div>
                                                        <div class="font-headline text-xs font-bold text-primary truncate">
                                                            {{ $child->nama_lengkap }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- 3. Kelian Banjar Adat -->
        <section class="bg-surface_container_low px-6 py-20 border-t border-black/[0.06]">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10 border-b border-black/[0.06] pb-4">
                    <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Pamong Wilayah Banjar</span>
                    <h2 class="mt-1 font-serif_display text-3xl font-bold text-primary">
                        Kelian Banjar Adat
                    </h2>
                    <p class="mt-1 text-xs text-on_surface_variant">Pengayom warga dan penghubung aspirasi krama di masing-masing banjar adat se-wilayah Tamanbali.</p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($banjarLeaders as $leader)
                        <article class="flex items-center gap-4 rounded-2xl border border-black/[0.06] bg-white p-5 shadow-subtle transition hover:border-primary/30">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary/5 text-primary">
                                <span class="material-symbols-outlined text-2xl">holiday_village</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="font-serif_display text-lg font-bold text-primary truncate">
                                    {{ $leader->kelian_banjar }}
                                </div>
                                <p class="text-xs text-on_surface_variant font-medium">
                                    Kelian {{ $leader->nama_banjar }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 4. Bala Angkep (Jika ada) -->
        @if (!$balaAngkep->isEmpty())
            <section class="bg-surface px-6 py-20 border-t border-black/[0.06]">
                <div class="mx-auto max-w-7xl">
                    <div class="mb-10 border-b border-black/[0.06] pb-4">
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Koordinasi Bala</span>
                        <h2 class="mt-1 font-serif_display text-3xl font-bold text-primary">
                            Kelian Bala Angkep
                        </h2>
                    </div>
                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach ($balaAngkep as $member)
                            <article class="flex flex-col items-center rounded-2xl border border-black/[0.08] bg-white p-7 text-center shadow-subtle">
                                <div class="mb-4 h-20 w-20 overflow-hidden rounded-full ring-2 ring-heritage_gold/40">
                                    <img src="{{ $member->foto_url }}" alt="Foto {{ $member->nama_lengkap }}"
                                        class="h-full w-full object-cover" />
                                </div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-heritage_gold">
                                    {{ $member->jabatan }}
                                </span>
                                <h3 class="mt-1 font-serif_display text-xl font-bold text-primary">
                                    {{ $member->nama_lengkap }}
                                </h3>
                                @if ($member->deskripsi)
                                    <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">{{ $member->deskripsi }}</p>
                                @endif
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- 5. Sabha Desa & Kerta Desa (Lembaga Musyawarah & Peradilan Adat) -->
        @if (!$sabhaDesa->isEmpty() || !$kertaDesa->isEmpty())
            <section class="bg-surface_container_low px-6 py-20 border-t border-black/[0.06]">
                <div class="mx-auto max-w-7xl space-y-16">
                    
                    @if (!$sabhaDesa->isEmpty())
                        <div>
                            <div class="mb-8 border-b border-black/[0.06] pb-4">
                                <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Lembaga Legislatif Adat</span>
                                <h2 class="mt-1 font-serif_display text-3xl font-bold text-primary">
                                    Sabha Desa Adat
                                </h2>
                            </div>
                            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach ($sabhaDesa as $member)
                                    <article class="flex flex-col items-center rounded-2xl border border-black/[0.08] bg-white p-6 text-center shadow-subtle">
                                        <div class="mb-3 h-16 w-16 overflow-hidden rounded-full ring-2 ring-primary/10">
                                            <img src="{{ $member->foto_url }}" alt="Foto {{ $member->nama_lengkap }}"
                                                class="h-full w-full object-cover" />
                                        </div>
                                        <span class="text-[9px] font-bold uppercase tracking-wider text-heritage_gold">
                                            {{ $member->jabatan }}
                                        </span>
                                        <h3 class="mt-1 font-headline text-sm font-bold text-primary">
                                            {{ $member->nama_lengkap }}
                                        </h3>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (!$kertaDesa->isEmpty())
                        <div>
                            <div class="mb-8 border-b border-black/[0.06] pb-4">
                                <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Lembaga Peradilan &amp; Pertimbangan</span>
                                <h2 class="mt-1 font-serif_display text-3xl font-bold text-primary">
                                    Kerta Desa Adat
                                </h2>
                            </div>
                            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                                @foreach ($kertaDesa as $member)
                                    <article class="flex flex-col items-center rounded-2xl border border-black/[0.08] bg-white p-6 text-center shadow-subtle">
                                        <div class="mb-3 h-16 w-16 overflow-hidden rounded-full ring-2 ring-primary/10">
                                            <img src="{{ $member->foto_url }}" alt="Foto {{ $member->nama_lengkap }}"
                                                class="h-full w-full object-cover" />
                                        </div>
                                        <span class="text-[9px] font-bold uppercase tracking-wider text-heritage_gold">
                                            {{ $member->jabatan }}
                                        </span>
                                        <h3 class="mt-1 font-headline text-sm font-bold text-primary">
                                            {{ $member->nama_lengkap }}
                                        </h3>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </section>
        @endif
    </main>
@endsection
