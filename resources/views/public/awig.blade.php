@extends('public.layout')

@section('title', 'Awig-Awig - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-primary px-6 py-24 text-white">
            <div class="absolute inset-0 hero-overlay opacity-90"></div>
            <div class="relative mx-auto max-w-7xl">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">Pedoman Adat</p>
                <h1 class="max-w-3xl font-headline text-5xl font-extrabold tracking-tight md:text-6xl">Awig-Awig Desa Adat
                    Tamanbali</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary_fixed_dim">Landasan nilai dan tata tertib yang
                    menjaga keseimbangan hubungan krama, prajuru, dan lingkungan desa.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-6 lg:grid-cols-2">
                    @foreach ($principles as $principle)
                        <article class="rounded-[28px] bg-white p-8 shadow-sky">
                            <div class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Prinsip
                                {{ $loop->iteration }}</div>
                            <h2 class="mb-4 font-headline text-3xl font-extrabold text-primary">{{ $principle['title'] }}
                            </h2>
                            <p class="leading-8 text-on_surface_variant">{{ $principle['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-surface_container_low px-6 py-20">
            <div class="mx-auto max-w-5xl rounded-[28px] bg-white p-10 shadow-sky">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Catatan</p>
                <h2 class="mb-4 font-headline text-3xl font-extrabold text-primary">Awig-awig sebagai pondasi transparansi
                </h2>
                <p class="leading-8 text-on_surface_variant">Dalam konteks sistem digital ini, awig-awig tidak hanya
                    dipahami sebagai aturan adat, tetapi juga sebagai semangat keterbukaan, ketertiban pencatatan, dan
                    tanggung jawab bersama atas pengelolaan administrasi maupun keuangan desa adat.</p>
            </div>
        </section>
    </main>
@endsection
