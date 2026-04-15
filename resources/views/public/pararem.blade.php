@extends('public.layout')

@section('title', 'Pararem - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-primary px-6 py-24 text-white">
            <div class="absolute inset-0 hero-overlay opacity-90"></div>
            <div class="relative mx-auto max-w-7xl">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">Keputusan Operasional
                </p>
                <h1 class="max-w-3xl font-headline text-5xl font-extrabold tracking-tight md:text-6xl">Pararem Desa Adat
                    Tamanbali</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary_fixed_dim">Keputusan pelaksanaan yang lahir dari
                    paruman dan menjadi panduan praktis bagi pengelolaan kegiatan desa adat sehari-hari.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-16">
            <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-2">
                <div class="glass-card rounded-[28px] p-8 shadow-sky">
                    <div class="font-headline text-4xl font-extrabold text-secondary">{{ count($pararemItems) }}</div>
                    <div class="mt-2 text-on_surface_variant">Pararem aktif dan evaluatif</div>
                </div>
                <div class="glass-card rounded-[28px] p-8 shadow-sky">
                    <div class="font-headline text-4xl font-extrabold text-secondary">{{ $documentsPublished }}</div>
                    <div class="mt-2 text-on_surface_variant">Dokumen administrasi yang mendukung implementasi</div>
                </div>
            </div>
        </section>

        <section class="bg-surface_container_low px-6 py-20">
            <div class="mx-auto max-w-7xl space-y-6">
                @foreach ($pararemItems as $item)
                    <article class="rounded-[28px] bg-white p-8 shadow-sky">
                        <div class="mb-3 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                            <h2 class="font-headline text-3xl font-extrabold text-primary">{{ $item['title'] }}</h2>
                            <span
                                class="rounded-full bg-surface_container_low px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-secondary">{{ $item['status'] }}</span>
                        </div>
                        <p class="leading-8 text-on_surface_variant">{{ $item['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
@endsection
