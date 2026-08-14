@extends('public.layout')

@section('title', 'Program Prioritas - Desa Adat Tamanbali')

@section('content')
    <main
        x-data="{
            selectedBidang: 'all',
            selectedStatus: 'all',
            activeModal: false,
            modalData: {},
            openDetail(item) {
                this.modalData = item;
                this.activeModal = true;
                document.body.style.overflow = 'hidden';
            },
            closeDetail() {
                this.activeModal = false;
                document.body.style.overflow = '';
            }
        }"
        @keydown.escape.window="closeDetail()"
        class="bg-surface"
    >
        <!-- 1. Hero Section (Harmonized Master Header) -->
        <section class="relative flex min-h-[440px] items-center justify-center overflow-hidden bg-primary px-6 pt-16 pb-24 text-white">
            <div class="absolute inset-0 h-full w-full opacity-40 mix-blend-luminosity"
                style="background-image: url('{{ asset('images/batik_patern.jpeg') }}'); background-repeat: repeat; background-size: 420px;"></div>
            
            <div class="hero-overlay absolute inset-0 opacity-85"></div>

            <div class="relative z-10 mx-auto max-w-4xl text-center">
                <!-- Pulse Badge -->
                <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-1.5 backdrop-blur-md shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-heritage_gold animate-pulse"></span>
                    <span class="font-headline text-[11px] font-bold uppercase tracking-[0.25em] text-heritage_gold_light">
                        Inisiasi Strategis Desa
                    </span>
                </div>

                <!-- Main Title -->
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Program Prioritas &amp; Capaian
                </h1>

                <!-- Narrative Subtitle -->
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    Pengejawantahan komitmen prajuru dalam mewujudkan tata kelola desa adat yang berkelanjutan berlandaskan falsafah <em>Tri Hita Karana</em> (Parahyangan, Pawongan, dan Palemahan).
                </p>

                <!-- Year Selector Pill Bar -->
                @if(count($availableYears) > 1)
                    <div class="mt-6 inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/10 p-1.5 backdrop-blur-md shadow-sm">
                        <span class="text-xs font-headline font-semibold text-white/80 pl-3">Tahun Anggaran:</span>
                        @foreach ($availableYears as $yr)
                            <a href="{{ route('program', ['tahun' => $yr]) }}"
                               class="rounded-xl px-4 py-1.5 font-headline text-xs font-bold transition duration-200 {{ $selectedYear == $yr ? 'bg-heritage_gold text-slate-950 shadow-sm' : 'text-white hover:bg-white/10' }}">
                                {{ $yr }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Fade to Surface Transition -->
            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Data Tape / Key Metrics Ribbon -->
        <section class="relative z-20 -mt-12 mx-auto max-w-7xl px-5">
            <div class="rounded-2xl border border-black/[0.08] bg-white p-6 sm:p-8 shadow-hover_card">
                <div class="grid grid-cols-2 gap-6 divide-y sm:divide-y-0 sm:divide-x divide-black/[0.06] lg:grid-cols-4">
                    <!-- Metric 1: Total Program -->
                    <div class="px-2 text-center">
                        <div class="font-headline text-3xl sm:text-4xl font-extrabold text-primary tabular-nums">
                            {{ $bukuProgram['total_program'] }}
                        </div>
                        <div class="mt-1 font-headline text-[11px] font-bold uppercase tracking-[0.15em] text-on_surface_variant">
                            Total Program ({{ $selectedYear }})
                        </div>
                    </div>

                    <!-- Metric 2: Rata-Rata Capaian -->
                    <div class="px-2 text-center pt-4 sm:pt-0">
                        <div class="inline-flex items-baseline gap-1 font-headline text-3xl sm:text-4xl font-extrabold text-emerald-600 tabular-nums">
                            {{ $bukuProgram['avg_progress'] }}<span class="text-lg font-bold">%</span>
                        </div>
                        <div class="mt-1 font-headline text-[11px] font-bold uppercase tracking-[0.15em] text-on_surface_variant">
                            Rata-Rata Kemajuan
                        </div>
                    </div>

                    <!-- Metric 3: Alokasi Anggaran -->
                    <div class="px-2 text-center pt-4 lg:pt-0">
                        <div class="font-headline text-xl sm:text-2xl font-extrabold text-primary tabular-nums tracking-tight">
                            Rp {{ number_format($bukuProgram['total_estimasi'], 0, ',', '.') }}
                        </div>
                        <div class="mt-1 font-headline text-[11px] font-bold uppercase tracking-[0.15em] text-on_surface_variant">
                            Total Alokasi Biaya
                        </div>
                    </div>

                    <!-- Metric 4: Realisasi Terpakai -->
                    <div class="px-2 text-center pt-4 lg:pt-0">
                        <div class="font-headline text-xl sm:text-2xl font-extrabold text-heritage_gold tabular-nums tracking-tight">
                            Rp {{ number_format($bukuProgram['total_realisasi'], 0, ',', '.') }}
                        </div>
                        <div class="mt-1 font-headline text-[11px] font-bold uppercase tracking-[0.15em] text-on_surface_variant">
                            Realisasi Terserap
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Katalog Program Prioritas & Filter Interaktif -->
        <section class="mx-auto max-w-7xl px-6 py-16">
            <!-- Filter Section Toolbar -->
            <div class="mb-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6 border-b border-black/[0.06] pb-6">
                <!-- Bidang Tabs (Tri Hita Karana) -->
                <div class="flex flex-wrap items-center gap-2">
                    <button
                        @click="selectedBidang = 'all'"
                        class="rounded-full px-4 py-2 font-headline text-xs font-bold transition duration-200"
                        :class="selectedBidang === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-surface_container_low text-on_surface_variant hover:bg-surface_container border border-black/[0.06]'"
                    >
                        Semua Bidang ({{ $programs->count() }})
                    </button>
                    @foreach ($bidangOptions as $bKey => $bLabel)
                        @php $bCount = $programs->where('bidang', $bKey)->count(); @endphp
                        @if($bCount > 0)
                            <button
                                @click="selectedBidang = '{{ $bKey }}'"
                                class="inline-flex items-center gap-1.5 rounded-full px-4 py-2 font-headline text-xs font-bold transition duration-200"
                                :class="selectedBidang === '{{ $bKey }}' ? 'bg-primary text-white shadow-sm' : 'bg-surface_container_low text-on_surface_variant hover:bg-surface_container border border-black/[0.06]'"
                            >
                                <span class="material-symbols-outlined text-sm">{{ match($bKey) {
                                    'parahyangan' => 'temple_hindu',
                                    'pawongan'    => 'groups',
                                    'palemahan'   => 'park',
                                    default       => 'account_balance'
                                } }}</span>
                                <span>{{ match($bKey) {
                                    'parahyangan' => 'Parahyangan',
                                    'pawongan'    => 'Pawongan',
                                    'palemahan'   => 'Palemahan',
                                    default       => ucfirst($bKey)
                                } }} ({{ $bCount }})</span>
                            </button>
                        @endif
                    @endforeach
                </div>

                <!-- Status Filter Pills -->
                <div class="flex items-center gap-2 text-xs font-headline">
                    <span class="text-on_surface_variant font-semibold">Status:</span>
                    <button
                        @click="selectedStatus = 'all'"
                        class="rounded-lg px-2.5 py-1 transition"
                        :class="selectedStatus === 'all' ? 'bg-slate-800 text-white font-bold' : 'text-slate-500 hover:text-slate-800'"
                    >
                        Semua
                    </button>
                    <button
                        @click="selectedStatus = 'berjalan'"
                        class="rounded-lg px-2.5 py-1 transition"
                        :class="selectedStatus === 'berjalan' ? 'bg-amber-600 text-white font-bold' : 'text-amber-800 hover:bg-amber-50'"
                    >
                        Berjalan ({{ $bukuProgram['berjalan_count'] }})
                    </button>
                    <button
                        @click="selectedStatus = 'selesai'"
                        class="rounded-lg px-2.5 py-1 transition"
                        :class="selectedStatus === 'selesai' ? 'bg-emerald-700 text-white font-bold' : 'text-emerald-800 hover:bg-emerald-50'"
                    >
                        Selesai ({{ $bukuProgram['selesai_count'] }})
                    </button>
                    <button
                        @click="selectedStatus = 'direncanakan'"
                        class="rounded-lg px-2.5 py-1 transition"
                        :class="selectedStatus === 'direncanakan' ? 'bg-blue-600 text-white font-bold' : 'text-blue-800 hover:bg-blue-50'"
                    >
                        Direncanakan ({{ $bukuProgram['rencana_count'] }})
                    </button>
                </div>
            </div>

            <!-- Program Card Grid -->
            @if($programs->isEmpty())
                <div class="rounded-2xl border border-black/[0.08] bg-white p-16 text-center shadow-subtle">
                    <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">assignment</span>
                    <h3 class="font-serif_display text-2xl font-bold text-primary">Belum Ada Program di Tahun Ini</h3>
                    <p class="mt-2 text-xs text-on_surface_variant max-w-md mx-auto">
                        Program kerja strategis untuk tahun anggaran {{ $selectedYear }} sedang dalam tahap perumusan paruman prajuru desa adat.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($programs as $prog)
                        <article
                            x-show="(selectedBidang === 'all' || selectedBidang === '{{ $prog->bidang }}') && (selectedStatus === 'all' || selectedStatus === '{{ $prog->status }}')"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            @click="openDetail({
                                nama: '{{ addslashes($prog->nama_program) }}',
                                bidang: '{{ $prog->bidang_label }}',
                                bidang_short: '{{ $prog->bidang_short_label }}',
                                bidang_key: '{{ $prog->bidang }}',
                                status: '{{ $prog->status_label }}',
                                status_key: '{{ $prog->status }}',
                                progress: {{ $prog->persentase_progress }},
                                estimasi: '{{ $prog->estimasi_anggaran_rp }}',
                                realisasi: '{{ $prog->realisasi_anggaran_rp }}',
                                output: '{{ addslashes($prog->target_output ?? 'Tercapainya sasaran program kerja desa') }}',
                                pj: '{{ addslashes($prog->penanggung_jawab ?? 'Prajuru Desa Adat') }}',
                                target: '{{ $prog->target_selesai ? $prog->target_selesai->translatedFormat('d F Y') : 'Sesuai RKT' }}',
                                mulai: '{{ $prog->tanggal_mulai ? $prog->tanggal_mulai->translatedFormat('d F Y') : '-' }}',
                                deskripsi: '{{ addslashes($prog->deskripsi ?? 'Program strategis dalam rangka memperkuat tata kelola dan kelestarian Desa Adat Tamanbali.') }}',
                                foto: '{{ $prog->foto_url ?? '' }}',
                                tahun: {{ $prog->tahun_anggaran }}
                            })"
                            class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-black/[0.08] bg-white shadow-subtle transition duration-300 hover:-translate-y-1 hover:border-primary/30 hover:shadow-hover_card cursor-pointer"
                        >
                            <!-- Top Photo / Banner (If Exists) -->
                            @if($prog->foto_url)
                                <div class="relative h-44 w-full overflow-hidden bg-slate-900">
                                    <img src="{{ $prog->foto_url }}" alt="{{ $prog->nama_program }}" loading="lazy"
                                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                    <div class="absolute bottom-3 left-4 right-4 flex items-center justify-between">
                                        <span class="rounded-full bg-black/60 px-3 py-1 font-headline text-[10px] font-bold uppercase tracking-wider text-white backdrop-blur-md border border-white/20">
                                            {{ $prog->bidang_short_label }}
                                        </span>
                                        <span class="font-headline text-xs font-bold text-heritage_gold_light drop-shadow-sm">
                                            {{ $prog->persentase_progress }}% Selesai
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <!-- Badges Ribbon (If no photo) -->
                                    @if(!$prog->foto_url)
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="rounded-full px-3 py-1 font-headline text-[10px] font-bold uppercase tracking-wider border {{ match($prog->bidang) {
                                                'parahyangan' => 'bg-amber-50 text-amber-900 border-amber-200',
                                                'pawongan'    => 'bg-blue-50 text-blue-900 border-blue-200',
                                                'palemahan'   => 'bg-emerald-50 text-emerald-900 border-emerald-200',
                                                default       => 'bg-slate-100 text-slate-800 border-slate-200'
                                            } }}">
                                                {{ $prog->bidang_short_label }}
                                            </span>

                                            <span class="rounded-full px-2.5 py-0.5 font-headline text-[10px] font-bold {{ match($prog->status) {
                                                'selesai'      => 'bg-emerald-100 text-emerald-800',
                                                'berjalan'     => 'bg-amber-100 text-amber-800',
                                                'direncanakan' => 'bg-blue-100 text-blue-800',
                                                default        => 'bg-slate-100 text-slate-800'
                                            } }}">
                                                {{ $prog->status_label }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Program Title -->
                                    <h3 class="font-serif_display text-xl font-bold text-primary leading-snug group-hover:text-primary_container transition">
                                        {{ $prog->nama_program }}
                                    </h3>

                                    @if($prog->target_output)
                                        <div class="mt-2.5 flex items-start gap-2 text-xs text-on_surface_variant font-body">
                                            <span class="material-symbols-outlined text-sm text-heritage_gold shrink-0 mt-0.5">track_changes</span>
                                            <span class="line-clamp-2 leading-relaxed">{{ $prog->target_output }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Progress Bar Component -->
                                <div class="mt-6 pt-4 border-t border-black/[0.04]">
                                    <div class="flex items-center justify-between text-xs font-headline mb-1.5">
                                        <span class="text-on_surface_variant font-semibold">Progress Capaian</span>
                                        <span class="font-bold {{ $prog->persentase_progress == 100 ? 'text-emerald-700' : ($prog->persentase_progress > 0 ? 'text-amber-700' : 'text-slate-500') }}">
                                            {{ $prog->persentase_progress }}%
                                        </span>
                                    </div>
                                    <div class="h-2 w-full overflow-hidden rounded-full bg-slate-100">
                                        <div
                                            class="h-full rounded-full transition-all duration-500 {{ $prog->persentase_progress == 100 ? 'bg-emerald-600' : ($prog->persentase_progress > 0 ? 'bg-amber-500' : 'bg-slate-300') }}"
                                            style="width: {{ $prog->persentase_progress }}%"
                                        ></div>
                                    </div>

                                    <!-- Budget Snippet -->
                                    <div class="mt-4 flex items-center justify-between text-xs text-on_surface_variant pt-3 border-t border-black/[0.04]">
                                        <div>
                                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Alokasi Biaya</span>
                                            <strong class="font-headline text-slate-900">{{ $prog->estimasi_anggaran_rp }}</strong>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Target Waktu</span>
                                            <strong class="font-headline text-slate-700">{{ $prog->target_selesai ? $prog->target_selesai->translatedFormat('M Y') : 'Tahun ' . $prog->tahun_anggaran }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Ribbon -->
                            <div class="bg-surface_container_low px-6 py-3 flex items-center justify-between text-[11px] font-semibold text-slate-500 border-t border-black/[0.06]">
                                <span class="truncate max-w-[200px] flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-slate-400">person</span>
                                    <span>{{ $prog->penanggung_jawab ?: 'Prajuru Terkait' }}</span>
                                </span>
                                <span class="font-bold text-primary group-hover:underline flex items-center gap-0.5">
                                    Detail <span class="material-symbols-outlined text-xs">arrow_forward</span>
                                </span>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- 4. Interactive Detail Modal (Alpine.js) -->
        <div
            x-show="activeModal"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 sm:p-6 backdrop-blur-md"
            @click.self="closeDetail()"
        >
            <div
                x-show="activeModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                class="relative max-w-3xl w-full max-h-[90vh] overflow-y-auto rounded-2xl bg-white shadow-2xl border border-black/10 flex flex-col"
            >
                <!-- Modal Header Bar -->
                <div class="sticky top-0 z-20 flex items-center justify-between border-b border-black/[0.06] bg-white/95 px-6 py-4 backdrop-blur-md">
                    <div class="flex items-center gap-2">
                        <span class="rounded-full bg-primary/10 px-3 py-0.5 font-headline text-xs font-bold text-primary"
                              x-text="modalData.bidang_short"></span>
                        <span class="rounded-full px-3 py-0.5 font-headline text-xs font-bold"
                              :class="modalData.progress === 100 ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'"
                              x-text="modalData.status"></span>
                    </div>
                    <button
                        @click="closeDetail()"
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 transition"
                    >
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>

                <!-- Modal Body Content -->
                <div class="p-6 sm:p-8">
                    <!-- Photo If Exists -->
                    <template x-if="modalData.foto">
                        <div class="mb-6 overflow-hidden rounded-2xl bg-slate-900 max-h-72">
                            <img :src="modalData.foto" :alt="modalData.nama" class="h-full w-full object-cover" />
                        </div>
                    </template>

                    <!-- Title -->
                    <h2 class="font-serif_display text-2xl sm:text-3xl font-bold text-primary leading-snug"
                        x-text="modalData.nama"></h2>

                    <!-- Progress Section -->
                    <div class="mt-6 rounded-2xl bg-surface_container_low p-5 border border-black/[0.06]">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-headline text-xs font-bold uppercase tracking-wider text-slate-500">Kemajuan Realisasi</span>
                            <span class="font-headline text-lg font-extrabold text-primary" x-text="modalData.progress + '%'"></span>
                        </div>
                        <div class="h-3 w-full overflow-hidden rounded-full bg-white border border-black/[0.06]">
                            <div
                                class="h-full rounded-full transition-all duration-500"
                                :class="modalData.progress === 100 ? 'bg-emerald-600' : 'bg-amber-500'"
                                :style="'width: ' + modalData.progress + '%'"
                            ></div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-xl border border-black/[0.06] bg-white p-4">
                            <span class="text-[10px] font-headline font-bold uppercase tracking-wider text-slate-400 block">Alokasi Anggaran</span>
                            <strong class="font-headline text-lg text-primary" x-text="modalData.estimasi"></strong>
                        </div>
                        <div class="rounded-xl border border-black/[0.06] bg-white p-4">
                            <span class="text-[10px] font-headline font-bold uppercase tracking-wider text-slate-400 block">Realisasi Anggaran</span>
                            <strong class="font-headline text-lg text-heritage_gold" x-text="modalData.realisasi"></strong>
                        </div>
                        <div class="rounded-xl border border-black/[0.06] bg-white p-4">
                            <span class="text-[10px] font-headline font-bold uppercase tracking-wider text-slate-400 block">Penanggung Jawab</span>
                            <strong class="font-headline text-sm text-slate-800" x-text="modalData.pj"></strong>
                        </div>
                        <div class="rounded-xl border border-black/[0.06] bg-white p-4">
                            <span class="text-[10px] font-headline font-bold uppercase tracking-wider text-slate-400 block">Target Waktu Selesai</span>
                            <strong class="font-headline text-sm text-slate-800" x-text="modalData.target"></strong>
                        </div>
                    </div>

                    <!-- Target Output -->
                    <div class="mt-6 border-t border-black/[0.06] pt-5">
                        <h4 class="font-headline text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Target Sasaran &amp; Output:</h4>
                        <p class="font-body text-sm text-slate-800 leading-relaxed" x-text="modalData.output"></p>
                    </div>

                    <!-- Narrative Description -->
                    <div class="mt-4 border-t border-black/[0.06] pt-5">
                        <h4 class="font-headline text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Uraian &amp; Latar Belakang Program:</h4>
                        <div class="font-body text-sm leading-relaxed text-slate-700 whitespace-pre-line" x-text="modalData.deskripsi"></div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="border-t border-black/[0.06] bg-surface_container_low px-6 py-4 flex items-center justify-between text-xs text-on_surface_variant">
                    <span class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm text-heritage_gold">verified</span>
                        <span>Program Kerja Resmi Desa Adat Tamanbali</span>
                    </span>
                    <button
                        @click="closeDetail()"
                        class="rounded-full bg-primary px-5 py-2 font-headline text-xs font-bold text-white hover:bg-primary_container transition"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
