<?php

namespace App\Filament\Resources\TimelineDesas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimelineDesasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')
                    ->label('#')
                    ->sortable()
                    ->width('50px'),

                TextColumn::make('tahun_label')
                    ->label('Tahun')
                    ->badge()
                    ->color('warning')
                    ->sortable(),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('deskripsi')
                    ->limit(80)
                    ->label('Deskripsi'),

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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
