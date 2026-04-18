<?php

namespace App\Filament\Resources\TimelineDesas\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TimelineDesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tahun_label')
                    ->required()
                    ->maxLength(100)
                    ->label('Label Tahun')
                    ->placeholder('contoh: Awal 1900-an, Era Pembaruan, 2024'),

                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul'),

                Textarea::make('deskripsi')
                    ->required()
                    ->rows(4)
                    ->label('Deskripsi'),

                TextInput::make('urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->label('Urutan Tampil')
                    ->helperText('Angka kecil tampil lebih dulu.'),
            ]);
    }
}
