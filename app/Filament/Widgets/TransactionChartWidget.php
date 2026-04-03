<?php

namespace App\Filament\Widgets;

use App\Models\Transaksi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionChartWidget extends ChartWidget
{
    protected ?string $heading = 'Trend Transaksi 12 Bulan';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Get transaction data grouped by month for past 12 months
        $data = Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, jenis, SUM(nominal) as total')
            ->whereRaw('YEAR(tanggal_transaksi) = YEAR(NOW())')
            ->groupBy('bulan', 'jenis')
            ->orderBy('bulan')
            ->get();

        // Initialize arrays for pemasukan and pengeluaran
        $pemasukan = array_fill(0, 12, 0);
        $pengeluaran = array_fill(0, 12, 0);

        // Fill data with bounds checking
        foreach ($data as $item) {
            $index = (int) $item->bulan - 1;

            // Bounds check untuk mencegah array overflow
            if ($index < 0 || $index >= 12) {
                continue;
            }

            if ($item->jenis === 'pemasukan') {
                $pemasukan[$index] = (float) $item->total;
            } elseif ($item->jenis === 'pengeluaran') {
                $pengeluaran[$index] = (float) $item->total;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukan,
                    'backgroundColor' => 'rgb(34, 197, 94)',
                    'borderColor' => 'rgba(34, 197, 94, 0.5)',
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaran,
                    'backgroundColor' => 'rgb(239, 68, 68)',
                    'borderColor' => 'rgba(239, 68, 68, 0.5)',
                ],
            ],
            'labels' => $monthNames,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
