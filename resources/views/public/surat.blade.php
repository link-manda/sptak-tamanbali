@extends('public.layout')

@section('title', 'Layanan Persuratan - Desa Adat Tamanbali')

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
                        Administrasi &amp; Registri Dokumen Adat
                    </span>
                </div>
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Layanan Persuratan Desa
                </h1>
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    Akses digital terbuka untuk penelusuran arsip surat masuk, permohonan surat keterangan, dan korespondensi resmi krama Desa Adat Tamanbali.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Quick Access Bento Cards (Surat Masuk vs Surat Keluar) -->
        <section class="relative z-20 -mt-10 mx-auto max-w-6xl px-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Card Surat Masuk -->
                <a href="{{ route('surat', ['jenis' => 'surat-masuk']) }}"
                    class="group relative flex flex-col justify-between rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-hover_card {{ $jenis === 'surat-masuk' ? 'ring-2 ring-primary' : '' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                            <span class="material-symbols-outlined text-3xl">move_to_inbox</span>
                        </div>
                        <span class="inline-flex items-center gap-1 text-xs font-bold text-primary group-hover:translate-x-1 transition-transform">
                            <span>Buka Arsip</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                    </div>

                    <div class="my-5">
                        <h3 class="font-serif_display text-2xl font-bold text-primary">Surat Masuk</h3>
                        <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                            Daftar surat dinas resmi, permohonan kelembagaan, pengumuman banjar, serta undangan kedinasan yang diterima oleh Prajuru Desa.
                        </p>
                    </div>

                    <div class="flex items-center justify-between border-t border-black/[0.06] pt-3 text-[11px] font-semibold uppercase tracking-wider text-heritage_gold">
                        <span>Registri Masuk</span>
                        <span class="material-symbols-outlined text-base">inbox</span>
                    </div>
                </a>

                <!-- Card Surat Keluar -->
                <a href="{{ route('surat', ['jenis' => 'surat-keluar']) }}"
                    class="group relative flex flex-col justify-between rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-hover_card {{ $jenis === 'surat-keluar' ? 'ring-2 ring-primary' : '' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/5 text-primary transition group-hover:bg-primary group-hover:text-white">
                            <span class="material-symbols-outlined text-3xl">outbox</span>
                        </div>
                        <span class="inline-flex items-center gap-1 text-xs font-bold text-primary group-hover:translate-x-1 transition-transform">
                            <span>Buka Arsip</span>
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                    </div>

                    <div class="my-5">
                        <h3 class="font-serif_display text-2xl font-bold text-primary">Surat Keluar</h3>
                        <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                            Dokumen keputusan paruman, surat keterangan adat bagi krama, surat perizinan, dan korespondensi resmi yang diterbitkan desa.
                        </p>
                    </div>

                    <div class="flex items-center justify-between border-t border-black/[0.06] pt-3 text-[11px] font-semibold uppercase tracking-wider text-heritage_gold">
                        <span>Registri Keluar</span>
                        <span class="material-symbols-outlined text-base">send</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- 3. Filter & Search Docket -->
        <section class="mx-auto mt-10 max-w-6xl px-6">
            <form class="rounded-2xl border border-black/[0.08] bg-white p-6 shadow-subtle" method="GET" action="{{ route('surat') }}">
                <div class="mb-4 flex items-center justify-between border-b border-black/[0.06] pb-3">
                    <span class="font-headline text-xs font-bold uppercase tracking-[0.2em] text-heritage_gold">Filter &amp; Penelusuran Dokumen</span>
                    @if($jenis || $startDate || $endDate || $search)
                        <a href="{{ route('surat') }}" class="text-xs font-semibold text-error hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">restart_alt</span>
                            <span>Reset Filter</span>
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Search Input -->
                    <div class="sm:col-span-2 lg:col-span-1">
                        <label class="mb-1.5 block text-xs font-bold text-slate-600">Kata Kunci / Perihal</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                            <input type="text" name="q" value="{{ $search }}"
                                placeholder="Cari nomor / perihal..."
                                class="w-full rounded-xl border border-black/[0.08] bg-surface_container_low/40 py-2.5 pl-9 pr-3 text-xs text-slate-800 placeholder-slate-400 transition focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary" />
                        </div>
                    </div>

                    <!-- Jenis Surat Select -->
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-600">Jenis Dokumen</label>
                        <select name="jenis"
                            class="w-full rounded-xl border border-black/[0.08] bg-surface_container_low/40 py-2.5 px-3 text-xs text-slate-800 transition focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary">
                            <option value="">Semua Dokumen</option>
                            <option value="surat-masuk" @selected($jenis === 'surat-masuk')>Surat Masuk</option>
                            <option value="surat-keluar" @selected($jenis === 'surat-keluar')>Surat Keluar</option>
                        </select>
                    </div>

                    <!-- Dari Tanggal -->
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-600">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate?->toDateString() }}"
                            class="w-full rounded-xl border border-black/[0.08] bg-surface_container_low/40 py-2 px-3 text-xs text-slate-800 transition focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary" />
                    </div>

                    <!-- Sampai Tanggal & Submit Button -->
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-600">Sampai Tanggal</label>
                        <div class="flex gap-2">
                            <input type="date" name="end_date" value="{{ $endDate?->toDateString() }}"
                                class="w-full rounded-xl border border-black/[0.08] bg-surface_container_low/40 py-2 px-3 text-xs text-slate-800 transition focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary" />
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-primary_container">
                                <span class="material-symbols-outlined text-base">search</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <!-- 4. Arsip Digital Showcase -->
        <section class="mx-auto mt-12 max-w-6xl px-6 pb-24">
            <div class="mb-8 flex items-center justify-between border-b border-black/[0.06] pb-4">
                <div>
                    <span class="font-headline text-xs font-bold uppercase tracking-[0.2em] text-heritage_gold">Daftar Arsip</span>
                    <h2 class="mt-1 font-serif_display text-2xl sm:text-3xl font-bold text-primary">
                        Dokumen &amp; Registri Korespondensi
                    </h2>
                </div>
                <span class="rounded-full bg-surface_container_low px-3.5 py-1.5 text-xs font-bold text-primary border border-black/[0.06]">
                    Total: <strong>{{ $arsipDokumen->count() }} Dokumen</strong>
                </span>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Featured Document (2 Cols) -->
                <div class="rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle lg:col-span-2 flex flex-col justify-between">
                    @if ($featuredDocument)
                        <div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-[11px] font-bold uppercase tracking-wider {{ $featuredDocument['jenis'] === 'surat-masuk' ? 'bg-blue-50 text-blue-800 border border-blue-200' : 'bg-amber-50 text-amber-800 border border-amber-200' }}">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $featuredDocument['jenis'] === 'surat-masuk' ? 'bg-blue-600' : 'bg-amber-600' }}"></span>
                                    {{ $featuredDocument['jenis'] === 'surat-masuk' ? 'Surat Masuk' : 'Surat Keluar' }}
                                </span>
                                <span class="text-xs text-slate-400 font-medium flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                                    {{ $featuredDocument['tanggal_surat']->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="my-6">
                                <h3 class="font-serif_display text-2xl sm:text-3xl font-bold text-primary leading-snug">
                                    {{ $featuredDocument['perihal'] }}
                                </h3>
                                <div class="mt-4 rounded-xl bg-surface_container_low/60 p-4 text-xs space-y-1.5 text-slate-700">
                                    <div>Nomor Registri: <strong class="font-mono text-slate-900">{{ $featuredDocument['nomor_surat'] }}</strong></div>
                                    <div>Asal / Tujuan: <strong class="text-slate-900">{{ $featuredDocument['asal_tujuan'] }}</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4 border-t border-black/[0.06] pt-5">
                            @if ($featuredDocument['file_surat'])
                                <button
                                    @click="openDoc('{{ '/storage/' . ltrim($featuredDocument['file_surat'], '/') }}')"
                                    class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 font-headline text-xs font-bold text-white shadow-sm transition hover:bg-primary_container hover:shadow">
                                    <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">visibility</span>
                                    <span>Preview Dokumen Lampiran</span>
                                </button>
                            @else
                                <span class="text-xs italic text-slate-400">Lampiran fisik tersimpan di kantor desa</span>
                            @endif
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-800 border border-emerald-200">
                                {{ $featuredDocument['status'] ?: 'Terarsip Digital' }}
                            </span>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center p-12 text-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300 mb-3">folder_off</span>
                            <h4 class="font-serif_display text-xl font-bold text-primary">Tidak Ada Dokumen Sesuai Filter</h4>
                            <p class="mt-1 text-xs text-on_surface_variant">Silakan ubah rentang tanggal atau kata kunci pencarian Anda.</p>
                        </div>
                    @endif
                </div>

                <!-- Recent Documents Stream (1 Col) -->
                <div class="space-y-4">
                    <span class="block text-xs font-bold uppercase tracking-[0.15em] text-slate-500">Arsip Terkait Lainnya</span>
                    
                    @forelse ($recentDocuments as $document)
                        <div class="rounded-2xl border border-black/[0.08] bg-white p-5 shadow-subtle transition duration-200 hover:border-primary/30 hover:shadow-hover_card">
                            <div class="flex items-start gap-3.5">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/5 text-primary">
                                    <span class="material-symbols-outlined text-lg">description</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-headline text-xs font-bold text-primary truncate" title="{{ $document['perihal'] }}">
                                        {{ $document['perihal'] }}
                                    </h4>
                                    <div class="mt-1 flex items-center gap-2 text-[11px] text-slate-400">
                                        <span>{{ $document['tanggal_surat']->translatedFormat('d M Y') }}</span>
                                        <span>&bull;</span>
                                        <span class="capitalize text-slate-500 font-medium">{{ str_replace('-', ' ', $document['jenis']) }}</span>
                                    </div>
                                    @if ($document['file_surat'])
                                        <button
                                            @click="openDoc('{{ '/storage/' . ltrim($document['file_surat'], '/') }}')"
                                            class="mt-3 inline-flex items-center gap-1 rounded-full border border-primary/20 bg-primary/5 px-3 py-1 text-[11px] font-bold text-primary transition hover:bg-primary hover:text-white">
                                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">visibility</span>
                                            <span>Lihat Surat</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-black/[0.08] bg-white p-6 text-center text-xs text-slate-400">
                            Tidak ada dokumen tambahan untuk ditampilkan.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        @include('public.partials.pdf-viewer')
    </main>
@endsection
