<?php

namespace App\Filament\Resources\ProgramPrioritas\Tables;

use App\Models\ProgramPrioritas;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProgramPrioritasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')
                    ->label('#')
                    ->sortable()
                    ->width('50px'),

                ImageColumn::make('foto')
                    ->disk('public')
                    ->circular()
                    ->label('Foto'),

                TextColumn::make('nama_program')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->label('Nama Program Strategis'),

                TextColumn::make('bidang')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'parahyangan' => 'Parahyangan',
                        'pawongan' => 'Pawongan',
                        'palemahan' => 'Palemahan',
                        'tata_kelola' => 'Tata Kelola',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'parahyangan' => 'warning',
                        'pawongan' => 'info',
                        'palemahan' => 'success',
                        'tata_kelola' => 'primary',
                        default => 'gray',
                    })
                    ->label('Bidang'),

                TextColumn::make('persentase_progress')
                    ->suffix('%')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 100 => 'success',
                        $state > 0 => 'warning',
                        default => 'gray',
                    })
                    ->label('Progress'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => ProgramPrioritas::statusOptions()[$state] ?? ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'selesai' => 'success',
                        'berjalan' => 'warning',
                        'direncanakan' => 'info',
                        default => 'danger',
                    })
                    ->label('Status'),

                TextColumn::make('estimasi_anggaran')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->label('Alokasi Anggaran'),

                TextColumn::make('tahun_anggaran')
                    ->sortable()
                    ->label('Tahun'),

                ToggleColumn::make('is_tampil_beranda')
                    ->label('Beranda'),

                ToggleColumn::make('is_aktif')
                    ->label('Aktif'),

                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('urutan')
            ->filters([
                SelectFilter::make('bidang')
                    ->options(ProgramPrioritas::bidangOptions())
                    ->label('Filter Bidang'),

                SelectFilter::make('status')
                    ->options(ProgramPrioritas::statusOptions())
                    ->label('Filter Status'),

                SelectFilter::make('tahun_anggaran')
                    ->options(fn () => ProgramPrioritas::distinct()->pluck('tahun_anggaran', 'tahun_anggaran')->toArray())
                    ->label('Tahun Anggaran'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
