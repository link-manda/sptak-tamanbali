<?php

namespace App\Filament\Resources\Panarems\Schemas;

use App\Models\Pararem;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PanaremForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Pararem'),

                TextInput::make('nomor_pararem')
                    ->maxLength(100)
                    ->label('Nomor Pararem')
                    ->nullable()
                    ->placeholder('contoh: No. 01/PA/2024'),

                Select::make('status')
                    ->options(Pararem::statusOptions())
                    ->required()
                    ->default('aktif')
                    ->label('Status'),

                TextInput::make('berlaku_mulai')
                    ->label('Berlaku Mulai (opsional)')
                    ->nullable(),

                DatePicker::make('tanggal_ditetapkan')
                    ->label('Tanggal Ditetapkan')
                    ->nullable(),

                DatePicker::make('berlaku_mulai')
                    ->label('Berlaku Mulai')
                    ->nullable(),

                Textarea::make('deskripsi')
                    ->required()
                    ->rows(5)
                    ->label('Deskripsi')
                    ->placeholder('Ringkasan isi dan tujuan pararem ini...'),

                FileUpload::make('file_pdf')
                    ->disk('public')
                    ->directory('dokumen/pararem')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240) // 10 MB
                    ->label('Upload Berkas PDF')
                    ->helperText('Format: PDF. Ukuran maks: 10MB. Dapat diunduh oleh masyarakat.')
                    ->nullable()
                    ->downloadable()
                    ->openable(),

                TextInput::make('nama_file_asli')
                    ->maxLength(255)
                    ->label('Nama File untuk Unduh')
                    ->nullable()
                    ->placeholder('contoh: Pararem-Administrasi-2024.pdf'),
            ]);
    }
}
