<?php

namespace App\Filament\Resources\Panarems\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PanaremsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_pararem')
                    ->label('Nomor')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->label('Judul'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'aktif'       => 'success',
                        'evaluasi'    => 'warning',
                        'tidak_aktif' => 'danger',
                        default       => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'aktif'       => 'Aktif',
                        'evaluasi'    => 'Evaluasi Tahunan',
                        'tidak_aktif' => 'Tidak Aktif',
                        default       => ucfirst($state),
                    })
                    ->sortable(),

                TextColumn::make('tanggal_ditetapkan')
                    ->date('d M Y')
                    ->label('Ditetapkan')
                    ->sortable()
                    ->placeholder('—'),

                IconColumn::make('file_pdf')
                    ->label('PDF')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-text')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'aktif'       => 'Aktif',
                        'evaluasi'    => 'Evaluasi Tahunan',
                        'tidak_aktif' => 'Tidak Aktif',
                    ]),
            ])
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
