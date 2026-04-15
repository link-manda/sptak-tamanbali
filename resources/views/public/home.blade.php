@extends('public.layout')

@section('title', 'Beranda - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative flex min-h-[720px] items-center justify-center overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDchMLqsivRJ73El1EzUA_xppgA99G1ZpoAwpc4pOREdAdDvxCz9aA6-KOq3R-SlhUH-yn7lXl2FpLEVwCrCERzqpwYM0N4L61Nbxj_jjims8E9Lw392If_iV-aAjXlmb_R1xR8m1i6wA-ED3p8tI_v6Kaki77hoXKoCLZ4QLYIyhPg4sRv3cYKjm54J0H47ENiZeq0Sa90ibh2bfg7X-zM4y8pm7ahN7TGFlnBPWc6kZ_3-sKSBWtxz2xpcJxlpFXWVc_zdL5JlV0"
                alt="Gerbang Desa Tamanbali" />
            <div class="hero-overlay absolute inset-0"></div>
            <div class="relative z-10 mx-auto max-w-4xl px-6 text-center">
                <span
                    class="mb-4 inline-block rounded-full bg-secondary px-4 py-1 text-xs font-bold uppercase tracking-[0.28em] text-white">Digital
                    Banjar Ecosystem</span>
                <h1 class="mb-6 font-headline text-5xl font-extrabold leading-tight tracking-tight text-white md:text-7xl">
                    Portal Transparansi<br>Administrasi &amp; Keuangan</h1>
                <p class="mx-auto max-w-2xl text-lg text-primary_fixed_dim md:text-xl">Mewujudkan tata kelola desa adat yang
                    modern, akuntabel, dan tetap berpijak pada nilai-nilai luhur kearifan lokal.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-24">
            <div class="mx-auto max-w-4xl space-y-6">
                @foreach ($contentCards as $card)
                    <a class="group relative flex items-center justify-between overflow-hidden rounded-[28px] bg-primary px-8 py-8 shadow-sky transition duration-300 hover:-translate-y-1 hover:shadow-[0_30px_60px_rgba(0,35,111,0.12)]"
                        href="{{ $card['target'] }}">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-white/5 to-transparent opacity-0 transition-opacity group-hover:opacity-100">
                        </div>
                        <div class="relative z-10 flex items-center gap-6">
                            <div
                                class="flex h-16 w-16 items-center justify-center rounded-full bg-primary_container text-secondary_fixed_dim">
                                <span class="material-symbols-outlined text-3xl"
                                    style="font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 24;">{{ $card['icon'] }}</span>
                            </div>
                            <div>
                                <h2 class="font-headline text-2xl font-bold text-white">{{ $card['title'] }}</h2>
                                <p class="mt-1 text-sm text-primary_fixed_dim">{{ $card['description'] }}</p>
                            </div>
                        </div>
                        <span
                            class="material-symbols-outlined relative z-10 text-3xl text-white/50 transition group-hover:translate-x-1 group-hover:text-secondary_fixed_dim">arrow_forward_ios</span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="bg-surface_container_low px-6 py-16">
            <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 md:grid-cols-3">
                <div class="glass-card rounded-[28px] px-8 py-9 text-center shadow-sky">
                    <div class="mb-2 font-headline text-4xl font-extrabold text-secondary">{{ $homeMetrics['banjar'] }}
                    </div>
                    <div class="font-medium text-on_surface_variant">Banjar Adat Terintegrasi</div>
                </div>
                <div class="glass-card rounded-[28px] px-8 py-9 text-center shadow-sky">
                    <div class="mb-2 font-headline text-4xl font-extrabold text-secondary">{{ $homeMetrics['krama_aktif'] }}
                    </div>
                    <div class="font-medium text-on_surface_variant">Krama Aktif Tercatat</div>
                </div>
                <div class="glass-card rounded-[28px] px-8 py-9 text-center shadow-sky">
                    <div class="mb-2 font-headline text-4xl font-extrabold text-secondary">{{ $homeMetrics['dokumen'] }}
                    </div>
                    <div class="font-medium text-on_surface_variant">Dokumen Transparansi Tersedia</div>
                </div>
            </div>
        </section>

        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl space-y-10">
                <div class="grid gap-6 lg:grid-cols-2">
                    <article id="profil-desa" class="rounded-[28px] bg-white p-8 shadow-sky">
                        <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Profil</p>
                        <h3 class="mb-4 font-headline text-3xl font-extrabold text-primary">
                            {{ $infoSections['profil']['title'] }}</h3>
                        <p class="mb-6 leading-7 text-on_surface_variant">{{ $infoSections['profil']['body'] }}</p>
                        <div class="grid gap-4 sm:grid-cols-2">
                            @foreach ($banjarHighlights as $banjar)
                                <div class="rounded-2xl bg-surface_container_low p-5">
                                    <div class="font-headline text-lg font-bold text-primary">{{ $banjar->nama_banjar }}
                                    </div>
                                    <div class="mt-1 text-sm text-on_surface_variant">Kelian: {{ $banjar->kelian_banjar }}
                                    </div>
                                    <div class="mt-2 text-xs font-semibold uppercase tracking-[0.2em] text-secondary">
                                        {{ $banjar->kramas_count }} krama</div>
                                </div>
                            @endforeach
                        </div>
                    </article>

                    <div class="space-y-6">
                        <article id="prajuru-desa" class="rounded-[28px] bg-white p-8 shadow-sky">
                            <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Prajuru</p>
                            <h3 class="mb-3 font-headline text-2xl font-extrabold text-primary">
                                {{ $infoSections['prajuru']['title'] }}</h3>
                            <p class="leading-7 text-on_surface_variant">{{ $infoSections['prajuru']['body'] }}</p>
                        </article>
                        <article id="awig-awig" class="rounded-[28px] bg-white p-8 shadow-sky">
                            <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Awig-Awig</p>
                            <h3 class="mb-3 font-headline text-2xl font-extrabold text-primary">
                                {{ $infoSections['awig']['title'] }}</h3>
                            <p class="leading-7 text-on_surface_variant">{{ $infoSections['awig']['body'] }}</p>
                        </article>
                        <article id="pararem" class="rounded-[28px] bg-white p-8 shadow-sky">
                            <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Pararem</p>
                            <h3 class="mb-3 font-headline text-2xl font-extrabold text-primary">
                                {{ $infoSections['pararem']['title'] }}</h3>
                            <p class="leading-7 text-on_surface_variant">{{ $infoSections['pararem']['body'] }}</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
