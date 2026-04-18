<?php

namespace App\Filament\Resources\Prajurus\Schemas;

use App\Models\Prajuru;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PrajuruForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Lengkap'),

                Select::make('kategori')
                    ->options(Prajuru::kategoriOptions())
                    ->default(Prajuru::CAT_INTI)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('jabatan', null))
                    ->label('Kelompok/Kategori'),

                Select::make('jabatan')
                    ->options(fn (Get $get) => Prajuru::jabatanOptions($get('kategori')))
                    ->required()
                    ->live()
                    ->label('Jabatan'),

                Select::make('parent_id')
                    ->label('Atasan (Khusus Juru Raksa)')
                    ->placeholder('Pilih Petengen...')
                    ->options(fn () => Prajuru::where('jabatan', 'Petengen')->pluck('nama_lengkap', 'id'))
                    ->visible(fn (Get $get) => $get('jabatan') === 'Juru Raksa')
                    ->required(fn (Get $get) => $get('jabatan') === 'Juru Raksa')
                    ->searchable()
                    ->helperText('Juru Raksa harus memiliki atasan Petengen.'),

                Textarea::make('deskripsi')
                    ->rows(3)
                    ->maxLength(500)
                    ->label('Deskripsi Singkat')
                    ->placeholder('Peran dan tanggung jawab dalam organisasi desa...'),

                FileUpload::make('foto')
                    ->image()
                    ->disk('public')
                    ->directory('foto-prajuru')
                    ->visibility('public')
                    ->imagePreviewHeight('160')
                    ->label('Foto Profil')
                    ->helperText('Format: JPG, PNG. Ukuran maks: 2MB. Resolusi yang disarankan: 300×300px.')
                    ->nullable(),

                TextInput::make('urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->label('Urutan Tampil')
                    ->helperText('Angka kecil tampil lebih dulu.'),

                Toggle::make('is_aktif')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Non-aktifkan untuk menyembunyikan dari halaman publik.'),
            ]);
    }
}
