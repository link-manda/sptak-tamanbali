<?php

namespace App\Filament\Resources\SuratKeluars\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuratKeluarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_surat')
                    ->searchable(),

                TextColumn::make('tanggal_surat')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('tujuan_surat')
                    ->label('Tujuan')
                    ->searchable(),

                TextColumn::make('perihal')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('file_surat')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => $state ? 'Ada Arsip' : 'Tidak Ada')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),

                TextColumn::make('user.name')
                    ->label('Pencatat')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('download')
                    ->label('Unduh')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => asset('storage/' . $record->file_surat))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->file_surat !== null),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
