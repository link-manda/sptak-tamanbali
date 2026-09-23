<?php

namespace App\Filament\Resources\Kramas\Schemas;

use App\Models\Banjar;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class KramaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('banjar_id')
                    ->relationship('banjar', 'nama_banjar')
                    ->getOptionLabelFromRecordUsing(fn (Banjar $record) => "{$record->nama_banjar} [{$record->kode_banjar}]")
                    ->searchable(['nama_banjar', 'kode_banjar'])
                    ->preload()
                    ->label('Banjar')
                    ->required()
                    ->native(false),

                TextInput::make('nama_lengkap')
                    ->required(),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                Toggle::make('status_aktif')
                    ->required(),
            ]);
    }
}
