<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionSummaryWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung total pemasukan
        $pemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');

        // Menghitung total pengeluaran
        $pengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');

        // Menghitung saldo akhir
        $saldo = $pemasukan - $pengeluaran;

        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($pemasukan, 0, ',', '.'))
                ->description('Seluruh pemasukan desa adat')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Total Pengeluaran', 'Rp ' . number_format($pengeluaran, 0, ',', '.'))
                ->description('Seluruh pengeluaran desa adat')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Saldo Kas', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description('Saldo kas saat ini')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($saldo >= 0 ? 'success' : 'danger'),
        ];
    }
}
