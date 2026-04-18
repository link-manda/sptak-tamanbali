<?php

namespace App\Filament\Resources\AwigAwigs\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AwigAwigsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('urutan')
                    ->label('#')
                    ->sortable()
                    ->width('50px'),

                TextColumn::make('nomor_pasal')
                    ->label('No. Pasal')
                    ->badge()
                    ->color('primary')
                    ->placeholder('—'),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->label('Judul'),

                TextColumn::make('deskripsi')
                    ->limit(70)
                    ->label('Deskripsi'),

                TextColumn::make('tanggal_ditetapkan')
                    ->date('d M Y')
                    ->label('Ditetapkan')
                    ->sortable()
                    ->placeholder('—'),

                IconColumn::make('file_pdf')
                    ->label('PDF')
                    ->icon(fn ($state) => $state ? 'heroicon-o-document-text' : 'heroicon-o-x-mark')
                    ->color(fn ($state) => $state ? 'success' : 'gray')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-mark'),

                IconColumn::make('is_aktif')
                    ->label('Publik')
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('urutan')
            ->recordActions([
                EditAction::make(),
                Action::make('unduh')
                    ->label('Unduh PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn ($record) => $record->file_pdf_url)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => (bool) $record->file_pdf),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
