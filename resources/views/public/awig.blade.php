@extends('public.layout')

@section('title', 'Awig-Awig - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-primary px-6 py-24 text-white">
            <div class="absolute inset-0 hero-overlay opacity-90"></div>
            <div class="relative mx-auto max-w-7xl">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">Pedoman Adat</p>
                <h1 class="max-w-3xl font-headline text-5xl font-extrabold tracking-tight md:text-6xl">Awig-Awig Desa Adat Tamanbali</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary_fixed_dim">Landasan nilai dan tata tertib yang
                    menjaga keseimbangan hubungan krama, prajuru, dan lingkungan desa.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                @if($principles->isEmpty())
                    <div class="rounded-[28px] bg-white p-10 text-center shadow-sky">
                        <span class="material-symbols-outlined text-4xl text-outline mb-3 block">gavel</span>
                        <p class="text-on_surface_variant italic">Data Awig-Awig belum tersedia.</p>
                    </div>
                @else
                    <div class="grid gap-6 lg:grid-cols-2">
                        @foreach ($principles as $principle)
                            <article class="rounded-[28px] bg-white p-8 shadow-sky flex flex-col">
                                <div class="mb-3 flex items-center justify-between">
                                    <div class="text-xs font-bold uppercase tracking-[0.28em] text-secondary">
                                        {{ $principle->nomor_pasal ?: 'Prinsip ' . $loop->iteration }}
                                    </div>
                                    @if($principle->tanggal_ditetapkan)
                                        <span class="text-xs text-on_surface_variant">
                                            {{ $principle->tanggal_ditetapkan->translatedFormat('d M Y') }}
                                        </span>
                                    @endif
                                </div>
                                <h2 class="mb-4 font-headline text-2xl font-extrabold text-primary">{{ $principle->judul }}</h2>
                                <p class="leading-8 text-on_surface_variant flex-1">{{ $principle->deskripsi }}</p>

                                @if($principle->file_pdf)
                                    <a
                                        href="{{ $principle->file_pdf_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="mt-6 inline-flex items-center gap-2 rounded-full border border-primary px-5 py-2.5 text-sm font-bold text-primary transition hover:bg-primary hover:text-white self-start"
                                    >
                                        <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">download</span>
                                        Unduh {{ $principle->label_unduh }}
                                    </a>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="bg-surface_container_low px-6 py-20">
            <div class="mx-auto max-w-5xl rounded-[28px] bg-white p-10 shadow-sky">
                <p class="mb-3 text-xs font-bold uppercase tracking-[0.28em] text-secondary">Catatan</p>
                <h2 class="mb-4 font-headline text-3xl font-extrabold text-primary">Awig-awig sebagai pondasi transparansi</h2>
                <p class="leading-8 text-on_surface_variant">Dalam konteks sistem digital ini, awig-awig tidak hanya
                    dipahami sebagai aturan adat, tetapi juga sebagai semangat keterbukaan, ketertiban pencatatan, dan
                    tanggung jawab bersama atas pengelolaan administrasi maupun keuangan desa adat.</p>
            </div>
        </section>
    </main>
@endsection
