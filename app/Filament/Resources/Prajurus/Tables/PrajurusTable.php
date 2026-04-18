<?php

namespace App\Filament\Resources\Prajurus\Tables;

use App\Models\Prajuru;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PrajurusTable
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
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->nama_lengkap) . '&background=00236f&color=fff&size=64')
                    ->label('Foto'),

                TextColumn::make('nama_lengkap')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Lengkap'),

                TextColumn::make('kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Prajuru::kategoriOptions()[$state] ?? $state)
                    ->color(fn (string $state): string => match ($state) {
                        Prajuru::CAT_INTI => 'primary',
                        Prajuru::CAT_BALA_ANGKEP => 'success',
                        Prajuru::CAT_SABHA_DESA => 'info',
                        Prajuru::CAT_KERTA_DESA => 'warning',
                        default => 'gray',
                    })
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('jabatan')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->limit(60)
                    ->label('Deskripsi')
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_aktif')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('urutan')
            ->recordActions([
                EditAction::make(),
            ])
            ->filters([
                SelectFilter::make('kategori')
                    ->options(Prajuru::kategoriOptions())
                    ->label('Kategori'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
