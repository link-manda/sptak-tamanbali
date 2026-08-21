@extends('public.layout')

@section('title', 'Awig-Awig - Desa Adat Tamanbali')

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
                        Sukreta &amp; Hukum Adat
                    </span>
                </div>
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Awig-Awig Desa Adat Tamanbali
                </h1>
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    Pijakan hukum adat tertinggi yang menata hak, kewajiban, dan keharmonisan hidup krama Desa Adat Tamanbali.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Katalog Pasal Awig-Awig -->
        <section class="bg-surface px-6 py-20">
            <div class="mx-auto max-w-7xl">
                <div class="mb-12 border-b border-black/[0.06] pb-5 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div>
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Ketentuan Pokok</span>
                        <h2 class="mt-1 font-serif_display text-3xl sm:text-4xl font-bold text-primary">
                            Pedoman &amp; Pasal-Pasal Adat
                        </h2>
                    </div>
                    <span class="rounded-full bg-surface_container_low px-3.5 py-1.5 text-xs font-bold text-primary border border-black/[0.06]">
                        Total: <strong>{{ $principles->count() }} Pasal Terdata</strong>
                    </span>
                </div>

                @if($principles->isEmpty())
                    <div class="rounded-2xl border border-black/[0.08] bg-white p-12 text-center shadow-subtle">
                        <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">gavel</span>
                        <h3 class="font-serif_display text-xl font-bold text-primary">Naskah Awig-Awig Belum Tersedia</h3>
                        <p class="mt-1 text-xs text-on_surface_variant">Belum ada pasal awig-awig yang terunggah dalam sistem digital saat ini.</p>
                    </div>
                @else
                    <div class="grid gap-8 lg:grid-cols-2">
                        @foreach ($principles as $principle)
                            <article class="flex flex-col justify-between rounded-2xl border border-black/[0.08] bg-white p-8 shadow-subtle transition duration-300 hover:border-primary/30 hover:shadow-hover_card">
                                <div>
                                    <div class="mb-4 flex items-center justify-between gap-4 border-b border-black/[0.06] pb-3">
                                        <span class="rounded-full bg-heritage_gold/10 px-3 py-1 font-headline text-xs font-bold uppercase tracking-wider text-heritage_gold">
                                            {{ $principle->nomor_pasal ?: 'Prinsip ' . $loop->iteration }}
                                        </span>
                                        @if($principle->tanggal_ditetapkan)
                                            <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                                <span class="material-symbols-outlined text-sm">event</span>
                                                {{ $principle->tanggal_ditetapkan->translatedFormat('d F Y') }}
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="font-serif_display text-2xl font-bold text-primary leading-snug">
                                        {{ $principle->judul }}
                                    </h3>
                                    
                                    <p class="mt-4 text-xs sm:text-sm leading-relaxed text-slate-700 font-body">
                                        {{ $principle->deskripsi }}
                                    </p>
                                </div>

                                @if($principle->file_pdf)
                                    <div class="mt-6 border-t border-black/[0.06] pt-4">
                                        <button
                                            @click="openDoc('{{ $principle->file_pdf_url }}')"
                                            class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 font-headline text-xs font-bold text-white shadow-sm transition hover:bg-primary_container hover:shadow"
                                        >
                                            <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">visibility</span>
                                            <span>Pelajari Naskah Asli (PDF)</span>
                                        </button>
                                    </div>
                                @endif
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- 3. Catatan Filosofis Transparansi -->
        <section class="bg-surface_container_low px-6 py-20 border-t border-black/[0.06]">
            <div class="mx-auto max-w-4xl rounded-2xl border border-primary/20 bg-white p-8 sm:p-12 shadow-subtle text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/5 text-primary">
                    <span class="material-symbols-outlined text-3xl text-heritage_gold">balance</span>
                </div>
                <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Nilai Luhur</span>
                <h3 class="mt-2 font-serif_display text-2xl sm:text-3xl font-bold text-primary">
                    Awig-Awig sebagai Pondasi Tata Kelola &amp; Ketulusan Ngayah
                </h3>
                <p class="mt-4 text-sm leading-relaxed text-slate-700 font-body text-pretty">
                    Dalam kerangka sistem informasi digital ini, awig-awig dipedomani bukan sekadar aturan hukum adat tertulis semata, melainkan sebagai komitmen moral atas keterbukaan informasi publik, ketertiban administrasi krama, dan kejujuran pertanggungjawaban pengelolaan dana desa kepada Ida Sang Hyang Widhi Wasa serta seluruh Krama Desa Adat Tamanbali.
                </p>
            </div>
        </section>

        @include('public.partials.pdf-viewer')
    </main>
@endsection
