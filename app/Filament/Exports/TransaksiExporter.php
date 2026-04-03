<?php

namespace App\Filament\Exports;

use App\Models\Transaksi;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class TransaksiExporter extends Exporter
{
    protected static ?string $model = Transaksi::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('tanggal_transaksi')
                ->label('Tanggal'),
            ExportColumn::make('kategori.nama_kategori')
                ->label('Kategori Transaksi'),
            ExportColumn::make('jenis')
                ->label('Jenis (Pemasukan/Pengeluaran)'),
            ExportColumn::make('nominal')
                ->label('Nominal (Rp)'),
            ExportColumn::make('keterangan')
                ->label('Keterangan'),
            ExportColumn::make('user.name')
                ->label('Dicatat Oleh'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ekspor Laporan Transaksi telah selesai dan sebanyak ' . number_format($export->successful_rows) . ' baris telah diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' Namun, ada ' . number_format($failedRowsCount) . ' baris yang gagal diekspor.';
        }

        return $body;
    }
}