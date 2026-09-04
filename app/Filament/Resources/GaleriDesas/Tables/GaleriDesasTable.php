<?php

namespace App\Filament\Resources\GaleriDesas\Tables;

use App\Models\GaleriDesa;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class GaleriDesasTable
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

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->limit(45)
                    ->label('Judul Dokumentasi'),

                TextColumn::make('kategori')
                    ->badge()
                    ->formatStateUsing(fn ($state) => GaleriDesa::kategoriOptions()[$state] ?? ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'upakara' => 'warning',
                        'paruman' => 'info',
                        'ngayah' => 'success',
                        'situs' => 'primary',
                        default => 'gray',
                    })
                    ->label('Kategori'),

                TextColumn::make('tanggal_kegiatan')
                    ->date('d M Y')
                    ->sortable()
                    ->label('Tanggal Kegiatan'),

                ToggleColumn::make('is_aktif')
                    ->label('Status Aktif'),

                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('urutan')
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
