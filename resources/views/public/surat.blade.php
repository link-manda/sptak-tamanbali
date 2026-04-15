@extends('public.layout')

@section('title', 'Surat - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative flex h-[460px] items-center justify-center overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSw8uQdg4btDg3tBcptYQRNlrwty2tCNmuDLknDL2OHcjaWva5Lwey3sTe-f_X-1im_ZTI5q0obR9ELGmSWFbnSxU9xZnh8sqXhm11EpjfRIA8YWImNdCQ2xuBfosDwQmz_R-oK0Ud0tzrSywEMKDV9pypw28IBGwKZJTgK_p_rLMUWfdkLlO_RwQUexyEppkOeVhWOxh_C82x4leC2kfyBXdSMyx-mANY9tJI1N5SYijeLbczlct_F5UU-9UhPF-zLA9DEBg3qE0"
                alt="Gerbang layanan surat" />
            <div class="hero-overlay absolute inset-0"></div>
            <div class="relative z-10 max-w-4xl px-6 text-center">
                <p class="mb-4 font-headline text-sm font-bold uppercase tracking-[0.3em] text-secondary_fixed_dim">
                    Administrasi Digital</p>
                <h1 class="mb-6 font-headline text-5xl font-extrabold tracking-tight text-white md:text-6xl">Layanan
                    Persuratan Desa</h1>
                <p class="text-lg leading-8 text-primary_fixed_dim">Akses digital untuk manajemen surat masuk dan pengajuan
                    surat keluar bagi seluruh krama Desa Adat Tamanbali secara transparan dan efisien.</p>
            </div>
        </section>

        <section class="relative z-20 mx-auto -mt-12 max-w-7xl px-6">
            <div class="flex flex-col justify-center gap-6 md:flex-row">
                <a class="max-w-md flex-1 rounded-[28px] border-b-4 border-primary bg-white p-8 shadow-sky transition hover:-translate-y-1"
                    href="{{ route('surat', ['jenis' => 'surat-masuk']) }}">
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-full bg-primary_container text-white">
                            <span class="material-symbols-outlined text-3xl">move_to_inbox</span>
                        </div>
                        <span class="material-symbols-outlined text-slate-300">arrow_forward</span>
                    </div>
                    <h3 class="mb-2 font-headline text-2xl font-bold text-primary">Surat Masuk</h3>
                    <p class="text-sm leading-6 text-on_surface_variant">Lihat daftar surat resmi, pengumuman banjar, dan
                        undangan yang diterima oleh desa.</p>
                </a>
                <a class="max-w-md flex-1 rounded-[28px] border-b-4 border-secondary bg-white p-8 shadow-sky transition hover:-translate-y-1"
                    href="{{ route('surat', ['jenis' => 'surat-keluar']) }}">
                    <div class="mb-6 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-full bg-secondary_container text-secondary">
                            <span class="material-symbols-outlined text-3xl">outbox</span>
                        </div>
                        <span class="material-symbols-outlined text-slate-300">arrow_forward</span>
                    </div>
                    <h3 class="mb-2 font-headline text-2xl font-bold text-primary">Surat Keluar</h3>
                    <p class="text-sm leading-6 text-on_surface_variant">Telusuri surat keterangan, perizinan, dan
                        korespondensi desa yang sudah dicatat secara digital.</p>
                </a>
            </div>
        </section>

        <section class="mx-auto mt-16 max-w-7xl px-6">
            <form class="rounded-[28px] bg-white p-8 shadow-sky" method="GET" action="{{ route('surat') }}">
                <h2 class="mb-6 font-headline text-lg font-extrabold text-primary">Filter Dokumen</h2>
                <div class="grid grid-cols-1 items-end gap-6 md:grid-cols-4">
                    <div>
                        <label class="mb-2 block text-xs font-semibold text-on_surface_variant">Dari Tanggal</label>
                        <input class="w-full rounded-lg border border-outline_variant/40 px-4 py-2.5" type="date"
                            name="start_date" value="{{ $startDate?->toDateString() }}" />
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-semibold text-on_surface_variant">Sampai Tanggal</label>
                        <input class="w-full rounded-lg border border-outline_variant/40 px-4 py-2.5" type="date"
                            name="end_date" value="{{ $endDate?->toDateString() }}" />
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-semibold text-on_surface_variant">Jenis Surat</label>
                        <select class="w-full rounded-lg border border-outline_variant/40 px-4 py-2.5" name="jenis">
                            <option value="">Semua</option>
                            <option value="surat-masuk" @selected($jenis === 'surat-masuk')>Surat Masuk</option>
                            <option value="surat-keluar" @selected($jenis === 'surat-keluar')>Surat Keluar</option>
                        </select>
                    </div>
                    <button
                        class="rounded-lg bg-emerald-500 py-2.5 font-bold text-white transition hover:bg-emerald-600">Filter</button>
                </div>
            </form>
        </section>

        <section class="mx-auto mt-16 max-w-7xl px-6 pb-24">
            <div class="mb-12 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="font-headline text-3xl font-extrabold tracking-tight text-primary">Arsip Digital</h2>
                    <div class="mt-2 h-1 w-20 rounded-full bg-secondary_fixed_dim"></div>
                </div>
                <form class="flex flex-col gap-4 md:flex-row md:items-center" method="GET" action="{{ route('surat') }}">
                    @if ($jenis)
                        <input type="hidden" name="jenis" value="{{ $jenis }}" />
                    @endif
                    @if ($startDate)
                        <input type="hidden" name="start_date" value="{{ $startDate->toDateString() }}" />
                    @endif
                    @if ($endDate)
                        <input type="hidden" name="end_date" value="{{ $endDate->toDateString() }}" />
                    @endif
                    <div class="relative min-w-[280px]">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                        <input class="w-full rounded-full bg-surface_container_highest py-3 pl-12 pr-4 text-sm"
                            type="text" name="q" value="{{ $search }}"
                            placeholder="Cari nomor surat atau perihal..." />
                    </div>
                    <button
                        class="rounded-full bg-surface_container_high px-4 py-3 text-primary transition hover:bg-primary hover:text-white"
                        type="submit">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="glass-card rounded-[28px] border border-outline_variant/15 p-8 shadow-sky md:col-span-2">
                    @if ($featuredDocument)
                        <div class="mb-6 flex items-start justify-between gap-4">
                            <span
                                class="rounded-full bg-tertiary_container px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-tertiary_fixed">{{ $featuredDocument['jenis'] }}</span>
                            <span
                                class="text-xs font-medium text-on_surface_variant">{{ $featuredDocument['tanggal_surat']->translatedFormat('d M Y') }}</span>
                        </div>
                        <h4 class="mb-4 font-headline text-3xl font-extrabold text-primary">
                            {{ $featuredDocument['perihal'] }}</h4>
                        <p class="mb-6 leading-7 text-on_surface_variant">Nomor surat
                            {{ $featuredDocument['nomor_surat'] }} dari/untuk {{ $featuredDocument['asal_tujuan'] }}.</p>
                        <div class="flex flex-wrap items-center gap-4">
                            @if ($featuredDocument['file_surat'])
                                <a class="rounded-lg bg-primary px-5 py-2 text-sm font-bold text-white"
                                    href="{{ asset('storage/' . $featuredDocument['file_surat']) }}" target="_blank">Unduh
                                    PDF</a>
                            @endif
                            <span class="text-sm font-bold text-primary">{{ $featuredDocument['status'] }}</span>
                        </div>
                    @else
                        <div class="text-sm text-on_surface_variant">Belum ada dokumen sesuai filter.</div>
                    @endif
                </div>

                <div class="space-y-6">
                    @forelse ($recentDocuments as $document)
                        <div class="rounded-[24px] bg-white p-6 shadow-sky">
                            <div class="flex gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-lg bg-surface_container_highest text-primary">
                                    <span class="material-symbols-outlined">description</span>
                                </div>
                                <div>
                                    <div class="font-headline text-sm font-bold leading-tight text-primary">
                                        {{ $document['perihal'] }}</div>
                                    <div class="mt-1 text-xs text-on_surface_variant">{{ $document['status'] }} •
                                        {{ $document['tanggal_surat']->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-[24px] bg-white p-6 text-sm text-on_surface_variant shadow-sky">Tidak ada
                            dokumen tambahan untuk ditampilkan.</div>
                    @endforelse
                    <div class="rounded-[24px] border-2 border-primary/10 p-4 text-center text-sm font-bold text-primary">
                        Total arsip: {{ $arsipDokumen->count() }} dokumen
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
