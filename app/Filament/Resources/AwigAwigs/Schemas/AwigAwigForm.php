<?php

namespace App\Filament\Resources\AwigAwigs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AwigAwigForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul / Nama Pasal'),

                TextInput::make('nomor_pasal')
                    ->maxLength(100)
                    ->label('Nomor Pasal')
                    ->nullable()
                    ->placeholder('contoh: Pasal 1, Bab II'),

                DatePicker::make('tanggal_ditetapkan')
                    ->label('Tanggal Ditetapkan')
                    ->nullable(),

                Textarea::make('deskripsi')
                    ->required()
                    ->rows(5)
                    ->label('Deskripsi / Isi Ringkas')
                    ->placeholder('Ringkasan isi atau penjelasan prinsip yang terkandung...'),

                FileUpload::make('file_pdf')
                    ->disk('public')
                    ->directory('dokumen/awig-awig')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240) // 10 MB
                    ->label('Upload Berkas PDF')
                    ->helperText('Format: PDF. Ukuran maks: 10MB. Berkas ini dapat diunduh oleh masyarakat.')
                    ->nullable()
                    ->downloadable()
                    ->openable(),

                TextInput::make('nama_file_asli')
                    ->maxLength(255)
                    ->label('Nama File untuk Unduh')
                    ->nullable()
                    ->placeholder('contoh: Awig-Awig-Bab-I.pdf')
                    ->helperText('Kosongkan untuk menggunakan nama file asli.'),

                TextInput::make('urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->label('Urutan Tampil'),

                Toggle::make('is_aktif')
                    ->label('Tampilkan di Halaman Publik')
                    ->default(true),
            ]);
    }
}
