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

        <!-- 4. Struktur Wilayah Banjar Adat -->
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
