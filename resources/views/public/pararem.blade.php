@extends('public.layout')

@section('title', 'Pararem - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-primary px-6 py-24 text-white">
            <div class="absolute inset-0 hero-overlay opacity-90"></div>
            <div class="relative mx-auto max-w-7xl">
                <p class="mb-4 text-xs font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">Keputusan Operasional</p>
                <h1 class="max-w-3xl font-headline text-5xl font-extrabold tracking-tight md:text-6xl">Pararem Desa Adat Tamanbali</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary_fixed_dim">Keputusan pelaksanaan yang lahir dari
                    paruman dan menjadi panduan praktis bagi pengelolaan kegiatan desa adat sehari-hari.</p>
            </div>
        </section>

        <section class="bg-surface px-6 py-16">
            <div class="mx-auto grid max-w-7xl gap-8 md:grid-cols-2">
                <div class="glass-card rounded-[28px] p-8 shadow-sky">
                    <div class="font-headline text-4xl font-extrabold text-secondary">{{ $pararemItems->count() }}</div>
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
                @forelse ($pararemItems as $item)
                    <article class="rounded-[28px] bg-white p-8 shadow-sky">
                        <div class="mb-4 flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                            <div class="flex-1">
                                @if($item->nomor_pararem)
                                    <p class="mb-1 text-xs font-bold uppercase tracking-widest text-secondary">{{ $item->nomor_pararem }}</p>
                                @endif
                                <h2 class="font-headline text-2xl font-extrabold text-primary">{{ $item->judul }}</h2>
                            </div>
                            <span class="inline-flex shrink-0 items-center rounded-full px-4 py-2 text-xs font-bold uppercase tracking-[0.2em]
                                @if($item->status === 'aktif') bg-tertiary_fixed/30 text-tertiary_container
                                @elseif($item->status === 'evaluasi') bg-secondary_container/30 text-secondary
                                @else bg-error_container/30 text-error
                                @endif">
                                {{ $item->status_label }}
                            </span>
                        </div>

                        <p class="leading-8 text-on_surface_variant">{{ $item->deskripsi }}</p>

                        <div class="mt-4 flex flex-wrap items-center gap-4">
                            @if($item->tanggal_ditetapkan)
                                <span class="text-xs text-on_surface_variant">
                                    Ditetapkan: {{ $item->tanggal_ditetapkan->translatedFormat('d M Y') }}
                                </span>
                            @endif
                            @if($item->berlaku_mulai)
                                <span class="text-xs text-on_surface_variant">
                                    Berlaku: {{ $item->berlaku_mulai->translatedFormat('d M Y') }}
                                </span>
                            @endif

                            @if($item->file_pdf)
                                <a
                                    href="{{ $item->file_pdf_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="ml-auto inline-flex items-center gap-2 rounded-full border border-primary px-5 py-2 text-sm font-bold text-primary transition hover:bg-primary hover:text-white"
                                >
                                    <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">download</span>
                                    Unduh {{ $item->label_unduh }}
                                </a>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="rounded-[28px] bg-white p-10 text-center shadow-sky">
                        <span class="material-symbols-outlined text-4xl text-outline mb-3 block">menu_book</span>
                        <p class="text-on_surface_variant italic">Data pararem belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
@endsection
