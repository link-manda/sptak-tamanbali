@extends('public.layout')

@section('title', 'Keuangan - Desa Adat Tamanbali')

@section('content')
    <main>
        <section class="relative flex h-[450px] items-center overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover opacity-20 grayscale"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpkzzwEGC1EnzqF-7wpMN7RH41QiC69dplcVoThwFbpSdq1AGEfPJfmspKhtMNad0l9jhbboViDmufgoKOE9o1U-GmM0rfFxv3RJB3uWDeg-QK-E3M-pZ2AxgemuE7jEF0Xv-DwFxgLFgLQXBqk0IEv-YJTWezlHh3ckcblDsSlbyygWa9q5yehYV8I1UREVLnGxsXEhf6seH5ouk31ep_jmISdyg0aBfHHYevLEibDLmocIpp6tt93sXO9FE4eGRaRwdpcM9CUkU"
                alt="Pola tradisional Tamanbali" />
            <div class="hero-overlay absolute inset-0"></div>
            <div class="relative z-10 mx-auto w-full max-w-7xl px-6">
                <div class="max-w-2xl">
                    <span
                        class="mb-4 block text-xs font-bold uppercase tracking-[0.28em] text-secondary_fixed_dim">Transparansi
                        Publik</span>
                    <h1 class="mb-6 font-headline text-5xl font-extrabold tracking-tight text-white">Keuangan Digital Desa
                        Adat Tamanbali</h1>
                    <p class="text-lg leading-8 text-primary_fixed_dim">Akses informasi pengelolaan dana desa secara terbuka,
                        akuntabel, dan profesional demi mewujudkan tata kelola banjar yang mandiri.</p>
                </div>
            </div>
        </section>

        <section class="relative z-20 mx-auto -mt-12 max-w-7xl px-6">
            <div class="glass-card flex flex-wrap justify-center gap-4 rounded-[28px] p-4 shadow-sky">
                <a class="{{ $scope === 'rkt' ? 'bg-primary text-white' : 'bg-white text-primary' }} rounded-full px-8 py-4 font-headline text-sm font-bold transition"
                    href="{{ route('keuangan', ['scope' => 'rkt']) }}">RKT (Rencana Kegiatan Tahunan)</a>
                <a class="{{ $scope === 'catur-wulan' ? 'bg-primary text-white' : 'bg-white text-primary' }} rounded-full px-8 py-4 font-headline text-sm font-bold transition"
                    href="{{ route('keuangan', ['scope' => 'catur-wulan']) }}">Catur Wulan</a>
                <a class="{{ $scope === 'realisasi' ? 'bg-primary text-white' : 'bg-white text-primary' }} rounded-full px-8 py-4 font-headline text-sm font-bold transition"
                    href="{{ route('keuangan', ['scope' => 'realisasi']) }}">Realisasi Kegiatan</a>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 py-16">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="glass-card rounded-[28px] border border-outline_variant/10 p-8 shadow-sky md:col-span-2">
                    <div class="mb-8 flex items-start justify-between gap-6">
                        <div>
                            <p class="mb-1 font-medium text-slate-500">Total Kas Desa Saat Ini</p>
                            <h2 class="font-headline text-4xl font-extrabold tracking-tight text-primary">Rp
                                {{ number_format($saldoKas, 0, ',', '.') }}</h2>
                        </div>
                        <span
                            class="rounded-full bg-tertiary_container px-3 py-1 text-xs font-bold text-tertiary_fixed">{{ $totalPemasukan > $totalPengeluaran ? '+' : '-' }}{{ number_format((abs($totalPemasukan - $totalPengeluaran) / max($totalPemasukan ?: 1, 1)) * 100, 0) }}%
                            saldo</span>
                    </div>
                    <div class="mb-4 flex h-32 items-end gap-2">
                        @foreach ($grafikKas as $value)
                            @php
                                $height = max(
                                    22,
                                    min(100, $saldoKas > 0 ? intval(($value / max($saldoKas, 1)) * 100) : 22),
                                );
                            @endphp
                            <div class="w-full rounded-t-xl {{ $loop->last ? 'bg-primary' : 'bg-blue-200' }}"
                                style="height: {{ $height }}%"></div>
                        @endforeach
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-400">Update Terakhir:
                            {{ $latestUpdate ? \Carbon\Carbon::parse($latestUpdate)->translatedFormat('d M Y') : '-' }}</span>
                        <a class="flex items-center gap-1 font-bold text-primary" href="#riwayat-anggaran">Lihat Detail
                            <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[28px] bg-primary p-8 text-white shadow-sky">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined mb-4 text-4xl text-secondary_fixed_dim"
                            style="font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 24;">account_balance</span>
                        <h3 class="mb-2 font-headline text-2xl font-bold">Dana Hibah &amp; Donasi</h3>
                        <p class="text-sm leading-6 text-primary_fixed_dim">Dana terkumpul dari punia krama dan bantuan
                            lembaga pendukung tata kelola desa adat.</p>
                        <div class="mt-10 font-headline text-4xl font-extrabold">Rp
                            {{ number_format($hibahDonasi, 0, ',', '.') }}</div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>
                </div>
            </div>
        </section>

        <section id="riwayat-anggaran" class="mx-auto max-w-7xl px-6 pb-24" x-data="{ activeCW: '{{ $caturWulanData[0]['id'] ?? '' }}' }">
            <div class="mb-8 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap items-center gap-4">
                    <h3 class="font-headline text-3xl font-extrabold tracking-tight text-on_surface">
                        {{ $scope === 'catur-wulan' ? 'Laporan Catur Wulan' : 'Riwayat Anggaran Terbaru' }}
                    </h3>
                    
                    {{-- Dropdown Pemilihan Tahun --}}
                    @if($availableYears->isNotEmpty())
                        <div class="relative inline-block text-left">
                            <form action="{{ route('keuangan') }}" method="GET" class="relative">
                                <input type="hidden" name="scope" value="{{ $scope }}">
                                <select name="tahun" onchange="this.form.submit()" 
                                    class="cursor-pointer appearance-none rounded-xl border-none bg-surface_container_high py-2 pl-4 pr-10 text-sm font-bold text-primary shadow-sm focus:ring-2 focus:ring-primary">
                                    @foreach($availableYears as $y)
                                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-primary">
                                    <span class="material-symbols-outlined text-sm">expand_more</span>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="flex gap-4">
                    <button class="rounded-lg bg-surface_container_high px-4 py-2 text-sm font-semibold text-on_surface hover:bg-surface_container_highest transition">Filter</button>
                    <button class="rounded-lg bg-surface_container_high px-4 py-2 text-sm font-semibold text-on_surface hover:bg-surface_container_highest transition">Unduh PDF</button>
                </div>
            </div>

            @if($scope === 'catur-wulan')
                <div class="space-y-6">
                    @forelse($caturWulanData as $cw)
                        <div class="overflow-hidden rounded-[28px] bg-white shadow-sky transition-all duration-300 border border-outline_variant/5">
                            {{-- Accordion Header --}}
                            <button @click="activeCW = (activeCW === '{{ $cw['id'] }}' ? '' : '{{ $cw['id'] }}')"
                                class="flex w-full items-center justify-between p-6 text-left transition"
                                :class="activeCW === '{{ $cw['id'] }}' ? 'bg-primary text-white' : 'bg-white text-on_surface hover:bg-surface_container_low/50'">
                                
                                <div class="flex items-center gap-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full transition-colors"
                                        :class="activeCW === '{{ $cw['id'] }}' ? 'bg-white/20' : 'bg-primary/10'">
                                        <span class="material-symbols-outlined text-sm">calendar_month</span>
                                    </div>
                                    <div>
                                        <span class="font-headline text-xl font-bold transition-colors">{{ $cw['label'] }}</span>
                                        <div class="text-[10px] font-medium uppercase tracking-wider opacity-70 transition-colors"
                                            :class="activeCW === '{{ $cw['id'] }}' ? 'text-white' : 'text-slate-500'">
                                            {{ $cw['items']->count() }} Transaksi Tercatat
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-8">
                                    <div class="hidden lg:flex items-center gap-6">
                                        <div class="text-right">
                                            <p class="text-[10px] uppercase opacity-70">Pengeluaran</p>
                                            <p class="font-bold">Rp {{ number_format($cw['totals']['pengeluaran'], 0, ',', '.') }}</p>
                                        </div>
                                        <div class="h-8 w-px bg-current opacity-20"></div>
                                        <div class="text-right">
                                            <p class="text-[10px] uppercase opacity-70">Saldo CW</p>
                                            <p class="font-bold transition-colors"
                                               :class="{
                                                   'text-white': activeCW === '{{ $cw['id'] }}',
                                                   'text-green-600': activeCW !== '{{ $cw['id'] }}' && {{ $cw['totals']['saldo'] }} >= 0,
                                                   'text-error': activeCW !== '{{ $cw['id'] }}' && {{ $cw['totals']['saldo'] }} < 0
                                               }">
                                                Rp {{ number_format($cw['totals']['saldo'], 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined transition-transform duration-300" 
                                        :class="activeCW === '{{ $cw['id'] }}' ? 'rotate-180 text-white' : 'text-primary'">
                                        keyboard_arrow_down
                                    </span>
                                </div>
                            </button>

                            {{-- Accordion Content (Table) --}}
                            <div x-show="activeCW === '{{ $cw['id'] }}'" 
                                x-cloak
                                x-collapse
                                class="border-t border-slate-100">
                                <div class="overflow-x-auto">
                                    <table class="w-full border-collapse text-left">
                                        <thead>
                                            <tr class="bg-surface_container_low/50">
                                                <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Kegiatan</th>
                                                <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-slate-500">Kategori</th>
                                                <th class="px-8 py-4 text-right text-xs font-bold uppercase tracking-widest text-slate-500">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cw['items'] as $row)
                                                <tr class="border-t border-slate-100 align-top hover:bg-slate-50/50 transition">
                                                    <td class="px-8 py-5">
                                                        <div class="font-semibold text-primary">{{ $row->keterangan }}</div>
                                                        <div class="text-[10px] text-slate-400">
                                                            {{ \Carbon\Carbon::parse($row->tanggal_transaksi)->translatedFormat('d M Y') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-8 py-5 text-sm text-slate-600">
                                                        {{ $row->kategori->nama_kategori ?? '-' }}
                                                    </td>
                                                    <td class="px-8 py-5 text-right text-sm font-bold {{ $row->jenis === 'pemasukan' ? 'text-green-600' : 'text-error' }}">
                                                        {{ $row->jenis === 'pemasukan' ? '+' : '-' }} Rp
                                                        {{ number_format($row->nominal, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-surface_container_low/20 border-t-2 border-slate-100">
                                                <td colspan="2" class="px-8 py-4 text-sm font-bold text-slate-700 text-right">Total Akhir Periode</td>
                                                <td class="px-8 py-4 text-right text-sm font-extrabold text-primary">
                                                    Rp {{ number_format($cw['totals']['saldo'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-[28px] bg-surface_container_low/30 p-12 text-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300 mb-4">account_balance_wallet</span>
                            <p class="text-slate-500">Belum ada catatan transaksi untuk tahun {{ $tahun }}.</p>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="overflow-hidden rounded-[28px] bg-white shadow-sky border border-outline_variant/5">
                    <table class="w-full border-collapse text-left">
                        <thead class="bg-surface_container_high">
                            <tr>
                                <th class="px-8 py-4 text-sm font-bold">Keterangan Kegiatan</th>
                                <th class="px-8 py-4 text-sm font-bold">Kategori</th>
                                <th class="px-8 py-4 text-sm font-bold text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayatAnggaran as $row)
                                <tr class="border-t border-slate-100 align-top odd:bg-white even:bg-surface_container_low/30 hover:bg-slate-50 transition">
                                    <td class="px-8 py-5">
                                        <div class="font-semibold text-primary">{{ $row->keterangan }}</div>
                                        <div class="text-xs text-slate-400">
                                            {{ \Carbon\Carbon::parse($row->tanggal_transaksi)->translatedFormat('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm italic text-slate-600">
                                        {{ $row->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-8 py-5 text-right text-sm font-bold {{ $row->jenis === 'pemasukan' ? 'text-green-600' : 'text-error' }}">
                                        {{ $row->jenis === 'pemasukan' ? '+' : '-' }} Rp
                                        {{ number_format($row->nominal, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-8 py-12 text-center text-sm text-slate-500" colspan="3">
                                        Belum ada data anggaran untuk periode ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>
@endsection
