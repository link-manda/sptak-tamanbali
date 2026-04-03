<?php

namespace App\Filament\Widgets;

use App\Models\DashboardDocument;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DocumentStatsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $unionQuery = SuratMasuk::query()
            ->selectRaw("id, nomor_surat, tanggal_surat, perihal, created_at, 'masuk' as jenis")
            ->unionAll(
                SuratKeluar::query()
                    ->selectRaw("id, nomor_surat, tanggal_surat, perihal, created_at, 'keluar' as jenis")
            );

        // Use fromSub on an Eloquent builder so Filament receives the expected Builder type.
        $query = DashboardDocument::query()
            ->fromSub($unionQuery, 'dashboard_documents')
            ->select('dashboard_documents.*')
            ->orderByDesc('created_at')
            ->limit(10);

        return $table
            ->paginated(false)
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('nomor_surat')
                    ->label('Nomor Surat'),

                Tables\Columns\TextColumn::make('tanggal_surat')
                    ->label('Tanggal')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('perihal')
                    ->label('Perihal')
                    ->limit(40),

                Tables\Columns\BadgeColumn::make('jenis')
                    ->label('Jenis')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->colors([
                        'primary' => 'masuk',
                        'secondary' => 'keluar',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}