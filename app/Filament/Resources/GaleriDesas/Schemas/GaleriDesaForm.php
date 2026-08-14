<?php

namespace App\Filament\Resources\GaleriDesas\Schemas;

use App\Models\GaleriDesa;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GaleriDesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Dokumentasi')
                    ->placeholder('contoh: Upacara Karya Piodalan di Pura Kahyangan Tiga')
                    ->columnSpanFull(),

                Select::make('kategori')
                    ->options(GaleriDesa::kategoriOptions())
                    ->default(GaleriDesa::CAT_UPAKARA)
                    ->required()
                    ->label('Kategori Kegiatan'),

                DatePicker::make('tanggal_kegiatan')
                    ->label('Tanggal Kegiatan')
                    ->native(false)
                    ->placeholder('Pilih tanggal upacara/kegiatan...'),

                FileUpload::make('foto')
                    ->image()
                    ->disk('public')
                    ->directory('galeri-desa')
                    ->visibility('public')
                    ->maxSize(3072)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imagePreviewHeight('180')
                    ->fetchFileInformation(false)
                    ->required()
                    ->label('File Foto')
                    ->helperText('Format: JPG, PNG, atau WebP. Maksimal 3 MB.')
                    ->columnSpanFull(),

                Textarea::make('deskripsi')
                    ->rows(3)
                    ->maxLength(600)
                    ->label('Deskripsi / Cerita Foto')
                    ->placeholder('Keterangan singkat mengenai prosesi upacara, kehadiran krama, atau latar belakang kegiatan...')
                    ->columnSpanFull(),

                TextInput::make('urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->label('Urutan Tampil')
                    ->helperText('Angka lebih kecil akan tampil lebih awal.'),

                Toggle::make('is_aktif')
                    ->label('Tampilkan di Publik')
                    ->default(true)
                    ->helperText('Nonaktifkan jika foto ini ingin diarsipkan sementara.'),
            ]);
    }
}
