<?php

namespace App\Filament\Resources\SuratMasuks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SuratMasukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_surat')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('tanggal_surat')
                    ->required()
                    ->default(now()),

                TextInput::make('asal_surat')
                    ->label('Asal Surat')
                    ->required()
                    ->maxLength(255),

                TextInput::make('perihal')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('file_surat')
                    ->label('Arsip Dokumen (PDF/JPG)')
                    ->disk('public')
                    ->visibility('public')
                    ->directory('arsip-surat-masuk')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->maxSize(5120) // Maksimal 5MB
                    ->columnSpanFull(),

                Hidden::make('user_id')
                    ->default(auth()->id()), // Otomatis mengisi ID pencatat
            ]);
    }
}