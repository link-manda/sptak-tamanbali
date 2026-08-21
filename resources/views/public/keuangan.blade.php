@extends('public.layout')

@section('title', 'Transparansi Keuangan - Desa Adat Tamanbali')

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
                        Akuntabilitas Dana Punia &amp; Kas Adat
                    </span>
                </div>
                <h1 class="mb-5 font-serif_display text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                    Keterbukaan Kas Desa Adat
                </h1>
                <p class="mx-auto max-w-2xl text-base sm:text-lg leading-relaxed text-primary_fixed_dim/90 font-body">
                    Wujud ketulusan dan tanggung jawab prajuru dalam memelihara kepercayaan krama — mencatat setiap penerimaan punia dan pengeluaran ayahan upakara secara terbuka dan seksama.
                </p>
            </div>

            <div class="absolute bottom-0 left-0 z-10 w-full h-24 bg-gradient-to-t from-surface to-transparent pointer-events-none"></div>
        </section>

        <!-- 2. Scope Filter Pills -->
        <section class="relative z-20 -mt-8 mx-auto max-w-5xl px-6">
            <div class="flex flex-wrap items-center justify-center gap-3 rounded-2xl border border-black/[0.08] bg-white p-3 shadow-hover_card">
                <a href="{{ route('keuangan', ['scope' => 'rkt', 'tahun' => $tahun]) }}"
                    class="rounded-xl px-6 py-3 font-headline text-xs font-bold uppercase tracking-wider transition duration-200 {{ $scope === 'rkt' ? 'bg-primary text-white shadow-sm' : 'text-slate-600 hover:bg-surface_container_low hover:text-primary' }}">
                    Rencana Kegiatan Tahunan (RKT)
                </a>
                <a href="{{ route('keuangan', ['scope' => 'catur-wulan', 'tahun' => $tahun]) }}"
                    class="rounded-xl px-6 py-3 font-headline text-xs font-bold uppercase tracking-wider transition duration-200 {{ $scope === 'catur-wulan' ? 'bg-primary text-white shadow-sm' : 'text-slate-600 hover:bg-surface_container_low hover:text-primary' }}">
                    Laporan Catur Wulan
                </a>
                <a href="{{ route('keuangan', ['scope' => 'realisasi', 'tahun' => $tahun]) }}"
                    class="rounded-xl px-6 py-3 font-headline text-xs font-bold uppercase tracking-wider transition duration-200 {{ $scope === 'realisasi' ? 'bg-primary text-white shadow-sm' : 'text-slate-600 hover:bg-surface_container_low hover:text-primary' }}">
                    Realisasi Kegiatan
                </a>
            </div>
        </section>

        <!-- 3. Financial Overview Bento Grid -->
        <section class="mx-auto max-w-7xl px-6 py-14">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                
                <!-- Card 1: Saldo Kas & Mini Chart (2 Cols) -->
                <div class="rounded-2xl border border-black/[0.08] bg-white p-7 shadow-subtle lg:col-span-2 flex flex-col justify-between">
                    <div>
                        <div class="flex flex-wrap items-start justify-between gap-4">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">Saldo Kas Bersih Desa</span>
                                <div class="mt-2 font-headline text-3xl sm:text-5xl font-extrabold text-primary tabular-nums tracking-tight">
                                    Rp {{ number_format($saldoKas, 0, ',', '.') }}
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 rounded-full px-3.5 py-1.5 font-headline text-xs font-bold border {{ $totalPemasukan >= $totalPengeluaran ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-red-50 text-red-800 border-red-200' }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $totalPemasukan >= $totalPengeluaran ? 'bg-emerald-600' : 'bg-red-600' }}"></span>
                                {{ $totalPemasukan >= $totalPengeluaran ? 'Surplus Anggaran' : 'Defisit Anggaran' }}
                            </span>
                        </div>

                        <!-- Pill Rincian In & Out -->
                        <div class="mt-5 flex flex-wrap gap-3 text-xs">
                            <div class="flex items-center gap-2 rounded-xl bg-surface_container_low px-4 py-2 text-slate-700">
                                <span class="material-symbols-outlined text-emerald-600 text-base">arrow_downward</span>
                                <span>Penerimaan Punia: <strong class="text-emerald-700 font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2 rounded-xl bg-surface_container_low px-4 py-2 text-slate-700">
                                <span class="material-symbols-outlined text-amber-700 text-base">arrow_upward</span>
                                <span>Belanja Ayahan: <strong class="text-amber-800 font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></span>
                            </div>
                        </div>

                        <!-- Grafik Arus Kas Sederhana & Ramah Warga -->
                        <div class="mt-8" x-data="{ activeMonth: null }">
                            <div class="mb-3 flex flex-wrap items-center justify-between gap-2 border-b border-black/[0.04] pb-2">
                                <span class="font-headline text-xs font-bold uppercase tracking-wider text-slate-500">
                                    Dinamika Pemasukan &amp; Belanja Ayahan (6 Bulan Terakhir)
                                </span>
                                <!-- Legend Sederhana -->
                                <div class="flex items-center gap-4 text-[11px] font-semibold">
                                    <div class="flex items-center gap-1.5 text-emerald-700">
                                        <span class="h-2.5 w-2.5 rounded-sm bg-emerald-500"></span>
                                        <span>Penerimaan Punia</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-amber-800">
                                        <span class="h-2.5 w-2.5 rounded-sm bg-amber-600"></span>
                                        <span>Belanja Ayahan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Box Container -->
                            <div class="relative rounded-2xl bg-surface_container_low/60 p-4 sm:p-5">
                                <div class="grid grid-cols-6 gap-2 sm:gap-4 h-36 items-end">
                                    @foreach ($grafikKas as $item)
                                        <div class="group relative flex flex-col items-center justify-end h-full cursor-pointer"
                                             @mouseenter="activeMonth = {{ $loop->index }}"
                                             @mouseleave="activeMonth = null"
                                             @click="activeMonth = (activeMonth === {{ $loop->index }} ? null : {{ $loop->index }})">
                                            
                                            <!-- Floating Tooltip Box -->
                                            <div x-show="activeMonth === {{ $loop->index }}"
                                                 x-cloak
                                                 x-transition:enter="transition ease-out duration-150"
                                                 x-transition:enter-start="opacity-0 translate-y-1"
                                                 x-transition:enter-end="opacity-100 translate-y-0"
                                                 class="absolute -top-20 z-30 pointer-events-none min-w-[135px] rounded-xl bg-charcoal p-2.5 text-left text-[11px] text-white shadow-xl ring-1 ring-white/10">
                                                <div class="font-bold border-b border-white/10 pb-1 text-heritage_gold_light">
                                                    {{ $item['bulan_full'] }}
                                                </div>
                                                <div class="mt-1 flex items-center justify-between text-emerald-400">
                                                    <span>Masuk:</span>
                                                    <span class="font-bold tabular-nums">{{ $item['pemasukan_rp'] }}</span>
                                                </div>
                                                <div class="flex items-center justify-between text-amber-300">
                                                    <span>Keluar:</span>
                                                    <span class="font-bold tabular-nums">{{ $item['pengeluaran_rp'] }}</span>
                                                </div>
                                            </div>

                                            <!-- Dual Bars (Pemasukan & Pengeluaran) -->
                                            <div class="flex w-full items-end justify-center gap-1 sm:gap-1.5 h-full pb-1">
                                                <!-- Bar Pemasukan (Hijau) -->
                                                <div class="w-1/2 max-w-[16px] rounded-t-md bg-emerald-500 transition-all duration-300 group-hover:bg-emerald-400 group-hover:brightness-110 shadow-xs"
                                                     style="height: {{ $item['height_in'] }}%"
                                                     title="Pemasukan: {{ $item['pemasukan_rp'] }}"></div>
                                                <!-- Bar Pengeluaran (Amber/Merah) -->
                                                <div class="w-1/2 max-w-[16px] rounded-t-md bg-amber-600 transition-all duration-300 group-hover:bg-amber-500 group-hover:brightness-110 shadow-xs"
                                                     style="height: {{ $item['height_out'] }}%"
                                                     title="Pengeluaran: {{ $item['pengeluaran_rp'] }}"></div>
                                            </div>

                                            <!-- Label Nama Bulan -->
                                            <span class="mt-1 font-headline text-xs font-bold transition-colors"
                                                  :class="activeMonth === {{ $loop->index }} ? 'text-primary' : 'text-slate-500'">
                                                {{ $item['bulan_label'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-black/[0.06] pt-4 text-xs">
                        <span class="text-slate-400 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-sm">schedule</span>
                            Update Terakhir: <strong class="text-slate-600">{{ $latestUpdate ? \Carbon\Carbon::parse($latestUpdate)->translatedFormat('d F Y') : '-' }}</strong>
                        </span>
                        <a href="#riwayat-anggaran" class="flex items-center gap-1 font-bold text-primary hover:underline">
                            <span>Rincian Buku Kas</span>
                            <span class="material-symbols-outlined text-sm">arrow_downward</span>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Dana Punia & Hibah (1 Col) -->
                <div class="relative flex flex-col justify-between overflow-hidden rounded-2xl bg-primary p-7 text-white shadow-subtle">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/10 text-secondary_fixed_dim backdrop-blur-md">
                                <span class="material-symbols-outlined text-2xl">volunteer_activism</span>
                            </div>
                            <span class="rounded-full border border-white/15 bg-white/10 px-3 py-1 font-headline text-[10px] font-bold uppercase tracking-wider text-heritage_gold_light">
                                Sumber Bantuan
                            </span>
                        </div>

                        <div class="my-6">
                            <span class="text-xs font-bold uppercase tracking-[0.2em] text-primary_fixed_dim/80">Dana Punia &amp; Hibah</span>
                            <div class="mt-2 font-headline text-3xl sm:text-4xl font-extrabold text-white tabular-nums tracking-tight">
                                Rp {{ number_format($hibahDonasi, 0, ',', '.') }}
                            </div>
                            <p class="mt-3 text-xs leading-relaxed text-primary_fixed_dim">
                                Total perolehan punia sukarela krama adat serta dana hibah dari instansi pemerintah/lembaga yang dialokasikan khusus untuk kelangsungan upakara dan operasional desa.
                            </p>
                        </div>
                    </div>

                    <div class="relative z-10 border-t border-white/10 pt-4 text-xs text-primary_fixed_dim flex items-center justify-between">
                        <span>Pencatatan Buku Kas Khusus</span>
                        <span class="material-symbols-outlined text-sm text-secondary_fixed_dim">verified</span>
                    </div>

                    <div class="absolute -bottom-12 -right-12 h-44 w-44 rounded-full bg-secondary/15 blur-3xl pointer-events-none"></div>
                </div>

            </div>
        </section>

        <!-- 4. Riwayat & Laporan Anggaran -->
        <section id="riwayat-anggaran" class="mx-auto max-w-7xl px-6 pb-24" x-data="{ activeCW: '{{ $caturWulanData[0]['id'] ?? '' }}' }">
            
            <!-- Section Header Bar -->
            <div class="mb-8 flex flex-col gap-4 border-b border-black/[0.06] pb-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap items-center gap-4">
                    <div>
                        <span class="font-headline text-xs font-bold uppercase tracking-[0.2em] text-heritage_gold">Buku Kas Desa</span>
                        <h2 class="mt-1 font-serif_display text-2xl sm:text-3xl font-bold text-primary">
                            {{ $scope === 'catur-wulan' ? 'Laporan Berkala Catur Wulan' : ($scope === 'realisasi' ? 'Laporan Realisasi Anggaran' : 'Rencana Kegiatan Tahunan') }}
                        </h2>
                    </div>

                    <!-- Year Selector Form -->
                    @if($availableYears->isNotEmpty())
                        <form action="{{ route('keuangan') }}" method="GET" class="relative">
                            <input type="hidden" name="scope" value="{{ $scope }}">
                            <select name="tahun" onchange="this.form.submit()"
                                class="cursor-pointer appearance-none rounded-xl border border-black/[0.08] bg-white py-2 pl-4 pr-9 font-headline text-xs font-bold text-primary shadow-subtle transition hover:border-primary/40 focus:ring-2 focus:ring-primary">
                                @foreach($availableYears as $y)
                                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>Tahun Anggaran {{ $y }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-primary">
                                <span class="material-symbols-outlined text-base">expand_more</span>
                            </div>
                        </form>
                    @endif
                </div>

                <!-- Action Button for Realisasi (PDF Viewer) -->
                @if($scope === 'realisasi')
                    <div class="flex items-center gap-3">
                        <button
                            @click="openDoc('{{ route('keuangan.laporan', ['tahun' => $tahun, 'aksi' => 'preview'], false) }}')"
                            class="inline-flex items-center gap-2 rounded-full bg-primary px-5 py-2.5 font-headline text-xs font-bold text-white shadow-sm transition hover:bg-primary_container hover:shadow">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">visibility</span>
                            <span>Preview Laporan PDF</span>
                        </button>
                    </div>
                @endif
            </div>

            <!-- View 1: Catur Wulan View (Accordion) -->
            @if($scope === 'catur-wulan')
                <div class="space-y-5">
                    @forelse($caturWulanData as $cw)
                        <div class="overflow-hidden rounded-2xl border border-black/[0.08] bg-white shadow-subtle transition-all duration-200">
                            <!-- Accordion Header Button -->
                            <button @click="activeCW = (activeCW === '{{ $cw['id'] }}' ? '' : '{{ $cw['id'] }}')"
                                class="flex w-full items-center justify-between p-6 text-left transition duration-200"
                                :class="activeCW === '{{ $cw['id'] }}' ? 'bg-primary text-white' : 'hover:bg-surface_container_low/50'">
                                
                                <div class="flex items-center gap-4">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl transition-colors"
                                        :class="activeCW === '{{ $cw['id'] }}' ? 'bg-white/20 text-white' : 'bg-primary/5 text-primary'">
                                        <span class="material-symbols-outlined text-lg">calendar_month</span>
                                    </div>
                                    <div>
                                        <div class="font-serif_display text-lg sm:text-xl font-bold transition-colors">
                                            {{ $cw['label'] }}
                                        </div>
                                        <div class="text-[10px] font-semibold uppercase tracking-wider opacity-75">
                                            {{ $cw['items']->count() }} Transaksi Tercatat
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-6">
                                    <div class="hidden sm:flex items-center gap-6 text-right text-xs">
                                        <div>
                                            <p class="text-[10px] uppercase opacity-70">Pengeluaran</p>
                                            <p class="font-bold tabular-nums">Rp {{ number_format($cw['totals']['pengeluaran'], 0, ',', '.') }}</p>
                                        </div>
                                        <div class="h-6 w-px bg-current opacity-20"></div>
                                        <div>
                                            <p class="text-[10px] uppercase opacity-70">Saldo CW</p>
                                            <p class="font-extrabold tabular-nums transition-colors"
                                                :class="{
                                                    'text-white': activeCW === '{{ $cw['id'] }}',
                                                    'text-emerald-600': activeCW !== '{{ $cw['id'] }}' && {{ $cw['totals']['saldo'] }} >= 0,
                                                    'text-red-600': activeCW !== '{{ $cw['id'] }}' && {{ $cw['totals']['saldo'] }} < 0
                                                }">
                                                Rp {{ number_format($cw['totals']['saldo'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined transition-transform duration-300"
                                        :class="activeCW === '{{ $cw['id'] }}' ? 'rotate-180 text-white' : 'text-primary'">
                                        expand_more
                                    </span>
                                </div>
                            </button>

                            <!-- Accordion Body Table -->
                            <div x-show="activeCW === '{{ $cw['id'] }}'" x-cloak x-collapse class="border-t border-black/[0.06]">
                                <div class="overflow-x-auto">
                                    <table class="w-full border-collapse text-left text-sm">
                                        <thead>
                                            <tr class="bg-surface_container_low/60 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                                <th class="px-6 py-3.5">Keterangan Kegiatan</th>
                                                <th class="px-6 py-3.5">Kategori</th>
                                                <th class="px-6 py-3.5 text-right">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-black/[0.04]">
                                            @foreach ($cw['items'] as $row)
                                                <tr class="hover:bg-slate-50/70 transition">
                                                    <td class="px-6 py-4">
                                                        <div class="font-semibold text-primary">{{ $row->keterangan }}</div>
                                                        <div class="text-[11px] text-slate-400">
                                                            {{ \Carbon\Carbon::parse($row->tanggal_transaksi)->translatedFormat('d F Y') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 text-xs font-medium text-slate-600">
                                                        {{ $row->kategori->nama_kategori ?? '-' }}
                                                    </td>
                                                    <td class="px-6 py-4 text-right font-bold tabular-nums {{ $row->jenis === 'pemasukan' ? 'text-emerald-700' : 'text-amber-800' }}">
                                                        {{ $row->jenis === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($row->nominal, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="border-t-2 border-black/[0.08] bg-surface_container_low/40">
                                                <td colspan="2" class="px-6 py-4 text-xs font-bold text-slate-700 text-right uppercase tracking-wider">
                                                    Saldo Akhir Periode
                                                </td>
                                                <td class="px-6 py-4 text-right font-extrabold text-primary tabular-nums">
                                                    Rp {{ number_format($cw['totals']['saldo'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-black/[0.08] bg-white p-12 text-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300 mb-3 block">account_balance_wallet</span>
                            <h3 class="font-serif_display text-xl font-bold text-primary">Belum Ada Mutasi Transaksi Kas</h3>
                            <p class="mt-1 text-xs text-on_surface_variant">Belum ada mutasi transaksi kas yang tercatat untuk tahun anggaran {{ $tahun }}. Pembukuan akan diperbarui berkala oleh Patengen Desa.</p>
                        </div>
                    @endforelse
                </div>

            <!-- View 2: Standar RKT & Realisasi View (Table) -->
            @else
                <div class="overflow-hidden rounded-2xl border border-black/[0.08] bg-white shadow-subtle">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-left text-sm">
                            <thead>
                                <tr class="bg-surface_container_low/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                    <th class="px-6 py-4">Keterangan Kegiatan</th>
                                    <th class="px-6 py-4">Kategori Anggaran</th>
                                    <th class="px-6 py-4 text-right">Jumlah (Rp)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-black/[0.04]">
                                @forelse ($riwayatAnggaran as $row)
                                    <tr class="hover:bg-slate-50/70 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-primary">{{ $row->keterangan }}</div>
                                            <div class="text-[11px] text-slate-400">
                                                {{ \Carbon\Carbon::parse($row->tanggal_transaksi)->translatedFormat('d F Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-xs font-medium text-slate-600">
                                            {{ $row->kategori->nama_kategori ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-right font-bold tabular-nums {{ $row->jenis === 'pemasukan' ? 'text-emerald-700' : 'text-amber-800' }}">
                                            {{ $row->jenis === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($row->nominal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-xs text-slate-500">
                                            Belum ada data transaksi yang tercatat untuk periode ini. Laporan pembukuan akan diperbarui secara berkala oleh Patengen Desa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </section>

        @include('public.partials.pdf-viewer')
    </main>
@endsection
