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

        <section id="riwayat-anggaran" class="mx-auto max-w-7xl px-6 pb-24">
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h3 class="font-headline text-3xl font-extrabold tracking-tight text-on_surface">Riwayat Anggaran Terbaru
                </h3>
                <div class="flex gap-4">
                    <a class="rounded-lg bg-surface_container_high px-4 py-2 text-sm font-semibold text-on_surface"
                        href="{{ route('keuangan', ['scope' => $scope]) }}">Filter</a>
                    <a class="rounded-lg bg-surface_container_high px-4 py-2 text-sm font-semibold text-on_surface"
                        href="{{ route('keuangan', ['scope' => $scope]) }}">Unduh PDF</a>
                </div>
            </div>
            <div class="overflow-hidden rounded-[28px] bg-white shadow-sky">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-surface_container_high">
                            <th class="px-8 py-4 text-sm font-bold">Keterangan Kegiatan</th>
                            <th class="px-8 py-4 text-sm font-bold">Kategori</th>
                            <th class="px-8 py-4 text-sm font-bold text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayatAnggaran as $row)
                            @php
                                $status =
                                    $row->jenis === 'pemasukan'
                                        ? 'Selesai'
                                        : (\Carbon\Carbon::parse($row->tanggal_transaksi)->diffInDays(now()) <= 21
                                            ? 'Proses'
                                            : 'Tercairkan');
                                $statusClass =
                                    $status === 'Proses'
                                        ? 'bg-yellow-50 text-yellow-700'
                                        : 'bg-green-50 text-green-700';
                            @endphp
                            <tr class="border-t border-slate-100 align-top odd:bg-white even:bg-surface_container_low/30">
                                <td class="px-8 py-5">
                                    <div class="font-semibold text-primary">{{ $row->keterangan }}</div>
                                    <div class="text-xs text-slate-400">
                                        {{ \Carbon\Carbon::parse($row->tanggal_transaksi)->translatedFormat('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm italic text-slate-600">
                                    {{ $row->kategori->nama_kategori ?? '-' }}</td>
                                <td
                                    class="px-8 py-5 text-right text-sm font-bold {{ $row->jenis === 'pemasukan' ? 'text-green-600' : 'text-error' }}">
                                    {{ $row->jenis === 'pemasukan' ? '+' : '-' }} Rp
                                    {{ number_format($row->nominal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-8 py-8 text-sm text-slate-500" colspan="4">Belum ada data anggaran untuk
                                    periode ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
