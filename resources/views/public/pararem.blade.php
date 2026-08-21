@extends('public.layout')

@section('title', 'Pararem - Desa Adat Tamanbali')

@section('content')
    <main x-data="pdfViewerData()">
        <!-- 1. Hero Section -->
        <section class="relative flex min-h-[440px] items-center justify-center overflow-hidden bg-primary px-6 pt-16 pb-24 text-white">
            <div class="absolute inset-0 h-full w-full opacity-40 mix-blend-luminosity"
                style="background-image: url('{{ asset('images/batik_patern.jpeg') }}'); background-repeat: repeat; background-size: 420px;"></div>
            
            <div class="hero-overlay absolute inset-0 opacity-85"></div>

            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-heritage_gold animate-pulse"></span>
                    <span class="font-headline text-[11px] font-bold uppercase tracking-[0.25em] text-heritage_gold_light">
                        Ketetapan &amp; Musyawarah Adat
                    </span>
                </div>
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Pararem Desa Adat Tamanbali
                </h1>
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    Ketetapan musyawarah paruman desa sebagai aturan teknis dan kesepakatan bersama dalam menjaga ketenteraman warga.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Metric Ribbon -->
        <section class="relative z-20 -mt-10 mx-auto max-w-4xl px-6">
            <div class="rounded-2xl border border-black/[0.08] bg-white p-6 shadow-hover_card">
                <div class="grid grid-cols-1 divide-y divide-black/[0.06] sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ $pararemItems->count() }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Ketetapan Pararem Terdata
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ $documentsPublished }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Dokumen Pendukung Terbit
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Daftar Ketetapan Pararem -->
        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-5xl space-y-6">
                <div class="mb-10 border-b border-black/[0.06] pb-4">
                    <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Hasil Paruman</span>
                    <h2 class="mt-1 font-serif_display text-3xl font-bold text-primary">
                        Daftar Ketetapan &amp; Kesepakatan
                    </h2>
                </div>

                @forelse ($pararemItems as $item)
                    <article class="rounded-2xl border border-black/[0.08] bg-white p-7 sm:p-8 shadow-subtle transition duration-300 hover:border-primary/30 hover:shadow-hover_card">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 border-b border-black/[0.06] pb-4">
                            <div>
                                @if($item->nomor_pararem)
                                    <span class="rounded-full bg-heritage_gold/10 px-3 py-0.5 font-headline text-xs font-bold uppercase tracking-wider text-heritage_gold">
                                        {{ $item->nomor_pararem }}
                                    </span>
                                @endif
                                <h3 class="mt-2 font-serif_display text-2xl font-bold text-primary leading-snug">
                                    {{ $item->judul }}
                                </h3>
                            </div>
                            
                            <span class="inline-flex shrink-0 items-center gap-1.5 rounded-full px-3.5 py-1 text-xs font-bold uppercase tracking-wider border
                                @if($item->status === 'aktif') bg-emerald-50 text-emerald-800 border-emerald-200
                                @elseif($item->status === 'evaluasi') bg-amber-50 text-amber-800 border-amber-200
                                @else bg-red-50 text-red-800 border-red-200
                                @endif">
                                <span class="h-1.5 w-1.5 rounded-full
                                    @if($item->status === 'aktif') bg-emerald-600
                                    @elseif($item->status === 'evaluasi') bg-amber-600
                                    @else bg-red-600
                                    @endif"></span>
                                {{ $item->status_label }}
                            </span>
                        </div>

                        <div class="my-5 text-xs sm:text-sm leading-relaxed text-slate-700 font-body">
                            {{ $item->deskripsi }}
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4 border-t border-black/[0.06] pt-4 text-xs text-slate-500">
                            <div class="flex flex-wrap items-center gap-4">
                                @if($item->tanggal_ditetapkan)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">event_available</span>
                                        Ditetapkan: <strong class="text-slate-700">{{ $item->tanggal_ditetapkan->translatedFormat('d F Y') }}</strong>
                                    </span>
                                @endif
                                @if($item->berlaku_mulai)
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm">schedule</span>
                                        Berlaku: <strong class="text-slate-700">{{ $item->berlaku_mulai->translatedFormat('d F Y') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @if($item->file_pdf)
                                <button
                                    @click="openDoc('{{ $item->file_pdf_url }}')"
                                    class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 font-headline text-xs font-bold text-white shadow-sm transition hover:bg-primary_container hover:shadow"
                                >
                                    <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">visibility</span>
                                    <span>Pelajari Naskah Pararem (PDF)</span>
                                </button>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-black/[0.08] bg-white p-12 text-center shadow-subtle">
                        <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">menu_book</span>
                        <h3 class="font-serif_display text-xl font-bold text-primary">Ketetapan Pararem Belum Diterbitkan</h3>
                        <p class="mt-1 text-xs text-on_surface_variant">Belum ada dokumen ketetapan pararem yang terunggah dalam sistem digital. Hasil paruman akan diperbarui berkala.</p>
                    </div>
                @endforelse
            </div>
        </section>

        @include('public.partials.pdf-viewer')
    </main>
@endsection
