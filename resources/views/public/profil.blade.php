@extends('public.layout')

@section('title', 'Profil Desa - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-primary px-6 py-24 text-white">
            <div class="absolute inset-0 hero-overlay opacity-90"></div>
            <div class="relative mx-auto max-w-7xl">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">Profil Desa</p>
                <h1 class="max-w-3xl font-headline text-5xl font-extrabold tracking-tight md:text-6xl">Mengenal Desa Adat
                    Tamanbali</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary_fixed_dim">Ruang hidup adat yang menjaga keseimbangan
                    antara tradisi, pelayanan masyarakat, dan tata kelola digital yang terbuka.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-16">
            <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-3">
                <div class="glass-card rounded-[28px] p-8 text-center shadow-sky">
                    <div class="font-headline text-4xl font-extrabold text-secondary">{{ $profileStats['banjar'] }}</div>
                    <div class="mt-2 text-on_surface_variant">Banjar Adat</div>
                </div>
                <div class="glass-card rounded-[28px] p-8 text-center shadow-sky">
                    <div class="font-headline text-4xl font-extrabold text-secondary">{{ $profileStats['krama'] }}</div>
                    <div class="mt-2 text-on_surface_variant">Total Krama</div>
                </div>
                <div class="glass-card rounded-[28px] p-8 text-center shadow-sky">
                    <div class="font-headline text-4xl font-extrabold text-secondary">{{ $profileStats['aktif'] }}</div>
                    <div class="mt-2 text-on_surface_variant">Krama Aktif</div>
                </div>
            </div>
        </section>

        <section class="bg-surface_container_low px-6 py-20">
            <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <article class="rounded-[28px] bg-white p-8 shadow-sky">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Narasi Desa</p>
                    <h2 class="mb-4 font-headline text-3xl font-extrabold text-primary">Desa yang hidup dalam musyawarah
                    </h2>
                    <p class="mb-4 leading-8 text-on_surface_variant">Desa Adat Tamanbali membangun tata kelola yang
                        menempatkan paruman sebagai pusat pengambilan keputusan, sementara administrasi modern membantu
                        memastikan keputusan tersebut tercatat, dilaksanakan, dan dapat diawasi oleh warga.</p>
                    <p class="leading-8 text-on_surface_variant">Transformasi digital bukan menggantikan adat, tetapi
                        memperkuatnya: arsip surat menjadi rapi, keuangan lebih mudah dipantau, dan informasi penting lebih
                        cepat menjangkau krama dari berbagai banjar.</p>
                </article>

                <div class="space-y-6">
                    @foreach ($timeline as $item)
                        <article class="rounded-[28px] bg-white p-7 shadow-sky">
                            <div class="mb-2 text-xs font-bold uppercase tracking-[0.28em] text-secondary">
                                {{ $item['year'] }}</div>
                            <h3 class="mb-3 font-headline text-2xl font-extrabold text-primary">{{ $item['title'] }}</h3>
                            <p class="leading-7 text-on_surface_variant">{{ $item['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-8">
                    <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Banjar Adat</p>
                    <h2 class="font-headline text-3xl font-extrabold text-primary">Struktur Banjar Tamanbali</h2>
                </div>
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($banjars as $banjar)
                        <article class="rounded-[28px] bg-white p-7 shadow-sky">
                            <h3 class="font-headline text-2xl font-extrabold text-primary">{{ $banjar->nama_banjar }}</h3>
                            <p class="mt-2 text-on_surface_variant">Kelian Banjar: {{ $banjar->kelian_banjar }}</p>
                            <div
                                class="mt-4 inline-flex rounded-full bg-surface_container_low px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-secondary">
                                {{ $banjar->kramas_count }} krama tercatat</div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
