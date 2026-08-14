@extends('public.layout')

@section('title', 'Profil & Sejarah - Desa Adat Tamanbali')

@section('content')
    <main>
        <!-- 1. Hero Section -->
        <section class="relative flex min-h-[440px] items-center justify-center overflow-hidden bg-primary px-6 pt-16 pb-24 text-white">
            <div class="absolute inset-0 h-full w-full opacity-40 mix-blend-luminosity"
                style="background-image: url('{{ asset('images/batik_patern.jpeg') }}'); background-repeat: repeat; background-size: 420px;"></div>
            
            <div class="hero-overlay absolute inset-0 opacity-85"></div>

            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-heritage_gold animate-pulse"></span>
                    <span class="font-headline text-[11px] font-bold uppercase tracking-[0.25em] text-heritage_gold_light">
                        Identitas &amp; Sejarah Luhur
                    </span>
                </div>
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Mengenal Desa Adat Tamanbali
                </h1>
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    {{ $profil->narasi_singkat ?: 'Ruang hidup adat yang menjaga keharmonisan tradisi Tri Hita Karana, pelayanan masyarakat, dan keterbukaan tata kelola di Kabupaten Bangli.' }}
                </p>
            </div>

            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Metric Ribbon (Data Tape) -->
        <section class="relative z-20 -mt-10 mx-auto max-w-5xl px-6">
            <div class="rounded-2xl border border-black/[0.08] bg-white p-6 shadow-hover_card">
                <div class="grid grid-cols-1 divide-y divide-black/[0.06] sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ $profileStats['banjar'] }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Banjar Adat Terdaftar
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ number_format($profileStats['krama']) }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Total Krama Tercatat
                        </div>
                    </div>
                    <div class="px-4 py-3 sm:py-0 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums tracking-tight">
                            {{ number_format($profileStats['aktif']) }}
                        </div>
                        <div class="mt-1 font-headline text-xs font-semibold uppercase tracking-[0.15em] text-on_surface_variant">
                            Krama Mipil / Aktif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Narasi Sejarah, Visi Misi & Timeline -->
        <section class="mx-auto max-w-7xl px-6 py-20">
            <div class="grid gap-12 lg:grid-cols-12">
                
                <!-- Left: Narasi & Visi Misi (7 Cols) -->
                <div class="lg:col-span-7 space-y-8">
                    <article class="rounded-2xl border border-black/[0.08] bg-white p-8 sm:p-10 shadow-subtle">
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Filosofi &amp; Tata Kelola</span>
                        <h2 class="mt-2 font-serif_display text-3xl sm:text-4xl font-bold text-primary leading-snug">
                            Desa yang Hidup dalam Musyawarah &amp; Keterbukaan
                        </h2>
                        
                        <div class="mt-6 space-y-4 text-sm leading-relaxed text-slate-700 font-body">
                            @if ($profil->narasi_panjang)
                                <p>{{ $profil->narasi_panjang }}</p>
                            @else
                                <p>
                                    Desa Adat Tamanbali membangun tata kelola yang menempatkan paruman sebagai pusat pengambilan keputusan tertinggi. Nilai-nilai Tri Hita Karana diwujudkan secara nyata dalam hubungan harmonis krama dengan Ida Sang Hyang Widhi Wasa, sesama warga adat, dan lingkungan palemahan.
                                </p>
                                <p>
                                    Transformasi digital di Desa Adat Tamanbali hadir bukan untuk menggantikan tradisi leluhur, melainkan untuk memperkuat akuntabilitas administrasi, mempermudah pelacakan dokumen korespondensi, dan memastikan transparansi keuangan kas desa dapat diakses secara terbuka oleh krama.
                                </p>
                            @endif
                        </div>

                        <!-- Visi & Misi Box -->
                        @if ($profil->visi || $profil->misi)
                            <div class="mt-8 pt-8 border-t border-black/[0.06] space-y-6">
                                @if ($profil->visi)
                                    <div class="rounded-xl bg-surface_container_low/80 p-6 border-l-4 border-heritage_gold">
                                        <span class="font-headline text-xs font-bold uppercase tracking-widest text-heritage_gold">Visi Luhur Desa</span>
                                        <p class="mt-2 text-sm font-medium leading-relaxed text-slate-800 font-serif_display text-lg italic">
                                            "{{ $profil->visi }}"
                                        </p>
                                    </div>
                                @endif

                                @if ($profil->misi)
                                    <div class="rounded-xl bg-surface_container_low/80 p-6 border-l-4 border-primary">
                                        <span class="font-headline text-xs font-bold uppercase tracking-widest text-primary">Misi Pelaksanaan</span>
                                        <div class="mt-2 text-xs leading-relaxed text-slate-700 whitespace-pre-line">
                                            {{ $profil->misi }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </article>
                </div>

                <!-- Right: Timeline Sejarah (5 Cols) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="border-b border-black/[0.06] pb-3">
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.2em] text-heritage_gold">Kronik Perjalanan</span>
                        <h3 class="mt-1 font-serif_display text-2xl font-bold text-primary">
                            Timeline Sejarah Desa
                        </h3>
                    </div>

                    <div class="space-y-4">
                        @forelse ($timeline as $item)
                            <article class="relative rounded-2xl border border-black/[0.08] bg-white p-6 shadow-subtle transition duration-200 hover:border-primary/30 hover:shadow-hover_card">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="rounded-full bg-heritage_gold/10 px-3 py-0.5 font-headline text-xs font-bold text-heritage_gold">
                                        {{ $item->tahun_label }}
                                    </span>
                                    <span class="material-symbols-outlined text-sm text-slate-300">history</span>
                                </div>
                                <h4 class="mt-3 font-serif_display text-xl font-bold text-primary">
                                    {{ $item->judul }}
                                </h4>
                                <p class="mt-2 text-xs leading-relaxed text-on_surface_variant">
                                    {{ $item->deskripsi }}
                                </p>
                            </article>
                        @empty
                            <div class="rounded-2xl border border-black/[0.08] bg-white p-8 text-center text-xs text-on_surface_variant italic">
                                Timeline kronik sejarah belum tercatat di sistem.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>

        <!-- 4. Galeri & Dokumentasi Adat (The Heritage Visual Archive) -->
        <section class="bg-surface px-6 py-20 border-t border-black/[0.06]"
            x-data="{
                selectedCat: 'all',
                activeModal: false,
                modalData: { foto: '', judul: '', deskripsi: '', tanggal: '', kategori: '' },
                openPhoto(item) {
                    this.modalData = item;
                    this.activeModal = true;
                    document.body.style.overflow = 'hidden';
                },
                closeModal() {
                    this.activeModal = false;
                    document.body.style.overflow = '';
                }
            }"
            @keydown.escape.window="closeModal()"
        >
            <div class="mx-auto max-w-7xl">
                <!-- Section Header -->
                <div class="mb-10 flex flex-col sm:flex-row sm:items-end justify-between gap-6 border-b border-black/[0.06] pb-5">
                    <div>
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Dokumentasi &amp; Warisan Adat</span>
                        <h2 class="mt-1 font-serif_display text-3xl sm:text-4xl font-bold text-primary">
                            Galeri Kegiatan &amp; Jejak Budaya
                        </h2>
                        <p class="mt-1 text-xs text-on_surface_variant">Rekam visual pelaksanaan yadnya, musyawarah paruman, gotong royong krama, dan palemahan desa.</p>
                    </div>

                    <!-- Category Filter Tabs -->
                    @if($galeris->isNotEmpty())
                        <div class="flex flex-wrap items-center gap-2">
                            <button
                                @click="selectedCat = 'all'"
                                class="rounded-full px-3.5 py-1.5 font-headline text-xs font-bold transition duration-200"
                                :class="selectedCat === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-surface_container_low text-on_surface_variant hover:bg-surface_container border border-black/[0.06]'"
                            >
                                Semua ({{ $galeris->count() }})
                            </button>
                            @foreach ($kategoriGaleri as $catKey => $catLabel)
                                @php
                                    $catCount = $galeris->where('kategori', $catKey)->count();
                                @endphp
                                @if($catCount > 0)
                                    <button
                                        @click="selectedCat = '{{ $catKey }}'"
                                        class="rounded-full px-3.5 py-1.5 font-headline text-xs font-bold transition duration-200"
                                        :class="selectedCat === '{{ $catKey }}' ? 'bg-primary text-white shadow-sm' : 'bg-surface_container_low text-on_surface_variant hover:bg-surface_container border border-black/[0.06]'"
                                    >
                                        {{ $catLabel }} ({{ $catCount }})
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Gallery Content -->
                @if($galeris->isEmpty())
                    <div class="rounded-2xl border border-black/[0.08] bg-white p-12 text-center shadow-subtle">
                        <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">photo_library</span>
                        <h3 class="font-serif_display text-xl font-bold text-primary">Dokumentasi Belum Diunggah</h3>
                        <p class="mt-1 text-xs text-on_surface_variant">Arsip foto kegiatan desa adat akan ditampilkan di sini setelah diperbarui oleh prajuru.</p>
                    </div>
                @else
                    <!-- Bento Mosaic Photo Grid -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($galeris as $item)
                            <article
                                x-show="selectedCat === 'all' || selectedCat === '{{ $item->kategori }}'"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                @click="openPhoto({
                                    foto: '{{ $item->foto_url }}',
                                    judul: '{{ addslashes($item->judul) }}',
                                    deskripsi: '{{ addslashes($item->deskripsi ?? '') }}',
                                    tanggal: '{{ $item->tanggal_kegiatan ? $item->tanggal_kegiatan->translatedFormat('d F Y') : '' }}',
                                    kategori: '{{ $item->kategori_label }}'
                                })"
                                class="group relative aspect-[4/3] cursor-pointer overflow-hidden rounded-2xl border border-black/[0.08] bg-charcoal shadow-subtle transition duration-300 hover:border-primary/40 hover:shadow-hover_card {{ $loop->first ? 'sm:col-span-2 sm:row-span-2 aspect-auto sm:min-h-[380px]' : '' }}"
                            >
                                <img
                                    src="{{ $item->foto_url }}"
                                    alt="{{ $item->judul }}"
                                    loading="lazy"
                                    decoding="async"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />

                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-90 transition duration-300 group-hover:opacity-95"></div>

                                <!-- Text Overlay -->
                                <div class="absolute inset-x-0 bottom-0 p-5 text-white flex flex-col justify-end">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="rounded-full bg-heritage_gold/90 px-2.5 py-0.5 font-headline text-[10px] font-bold uppercase tracking-wider text-slate-950 backdrop-blur-xs">
                                            {{ $item->kategori_label }}
                                        </span>
                                        @if($item->tanggal_kegiatan)
                                            <span class="text-[11px] text-white/80 font-medium flex items-center gap-1">
                                                <span class="material-symbols-outlined text-xs">event</span>
                                                {{ $item->tanggal_kegiatan->translatedFormat('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-serif_display font-bold text-white leading-snug drop-shadow-sm {{ $loop->first ? 'text-xl sm:text-2xl' : 'text-lg line-clamp-2' }}">
                                        {{ $item->judul }}
                                    </h3>
                                    @if($item->deskripsi && $loop->first)
                                        <p class="mt-2 text-xs text-white/80 line-clamp-2 hidden sm:block font-body">
                                            {{ $item->deskripsi }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Hover Inspect Icon -->
                                <div class="absolute top-4 right-4 h-9 w-9 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center opacity-0 transition duration-200 group-hover:opacity-100">
                                    <span class="material-symbols-outlined text-lg">fullscreen</span>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Fullscreen Lightbox Modal (Alpine.js) -->
            <div
                x-show="activeModal"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 p-4 sm:p-6 backdrop-blur-md"
                @click.self="closeModal()"
            >
                <div
                    x-show="activeModal"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="relative max-w-5xl w-full max-h-[92vh] overflow-hidden rounded-2xl bg-white shadow-2xl border border-white/15 flex flex-col md:flex-row"
                >
                    <!-- Close Button -->
                    <button
                        @click="closeModal()"
                        class="absolute top-4 right-4 z-20 flex h-10 w-10 items-center justify-center rounded-full bg-black/50 text-white backdrop-blur-md transition hover:bg-black/80"
                    >
                        <span class="material-symbols-outlined text-2xl">close</span>
                    </button>

                    <!-- Left: Large Image Container -->
                    <div class="bg-charcoal flex items-center justify-center md:w-3/5 overflow-hidden max-h-[50vh] md:max-h-[85vh]">
                        <img
                            :src="modalData.foto"
                            :alt="modalData.judul"
                            class="max-h-full max-w-full object-contain"
                        />
                    </div>

                    <!-- Right: Info Panel -->
                    <div class="flex flex-col justify-between p-6 sm:p-8 md:w-2/5 overflow-y-auto max-h-[40vh] md:max-h-[85vh] bg-surface">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="rounded-full bg-surface_container_low px-3 py-1 font-headline text-xs font-bold uppercase tracking-wider text-heritage_gold border border-black/[0.06]"
                                      x-text="modalData.kategori"></span>
                                <span class="text-xs text-on_surface_variant font-medium" x-text="modalData.tanggal" x-show="modalData.tanggal"></span>
                            </div>

                            <h3 class="font-serif_display text-2xl font-bold text-primary leading-snug"
                                x-text="modalData.judul"></h3>

                            <div class="mt-4 border-t border-black/[0.06] pt-4 text-xs sm:text-sm leading-relaxed text-slate-700 font-body whitespace-pre-line"
                                 x-text="modalData.deskripsi || 'Dokumentasi resmi kegiatan Desa Adat Tamanbali.'">
                            </div>
                        </div>

                        <div class="mt-8 border-t border-black/[0.06] pt-4 flex items-center justify-between text-xs text-on_surface_variant">
                            <span class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-sm text-heritage_gold">verified</span>
                                <span>Arsip Resmi Desa Adat</span>
                            </span>
                            <button
                                @click="closeModal()"
                                class="font-headline font-bold text-primary hover:underline"
                            >
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Struktur Wilayah Banjar Adat -->
        <section class="bg-surface_container_low px-6 py-20 border-t border-black/[0.06]">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10 border-b border-black/[0.06] pb-4 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div>
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.25em] text-heritage_gold">Kewilayahan Adat</span>
                        <h2 class="mt-1 font-serif_display text-3xl font-bold text-primary">
                            Struktur Banjar Adat Tamanbali
                        </h2>
                    </div>
                    <p class="text-xs text-on_surface_variant">Kesatuan banjar yang membentuk ikatan krama Desa Adat Tamanbali.</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($banjars as $banjar)
                        <article class="rounded-2xl border border-black/[0.06] bg-white p-7 shadow-subtle transition duration-200 hover:border-primary/30 hover:shadow-hover_card flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between">
                                    <h3 class="font-serif_display text-2xl font-bold text-primary">
                                        {{ $banjar->nama_banjar }}
                                    </h3>
                                    <span class="rounded-full bg-primary/5 px-3 py-1 font-headline text-xs font-bold text-primary">
                                        {{ $banjar->kramas_count }} Krama
                                    </span>
                                </div>
                                <div class="mt-3 text-xs text-on_surface_variant">
                                    Kelian Banjar: <strong class="text-slate-800 font-semibold">{{ $banjar->kelian_banjar ?: 'Prajuru Terkait' }}</strong>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between border-t border-black/[0.04] pt-3 text-[11px] font-semibold text-slate-400">
                                <span>Status: Terdaftar Aktif</span>
                                <span class="material-symbols-outlined text-sm text-emerald-600">check_circle</span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
