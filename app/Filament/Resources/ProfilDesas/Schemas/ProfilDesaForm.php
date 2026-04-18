<?php

namespace App\Filament\Resources\ProfilDesas\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProfilDesaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('narasi_singkat')
                    ->required()
                    ->rows(3)
                    ->label('Narasi Singkat')
                    ->helperText('Teks yang ditampilkan di hero section halaman Profil Desa.')
                    ->placeholder('Ruang hidup adat yang menjaga keseimbangan antara tradisi...'),

                Textarea::make('narasi_panjang')
                    ->required()
                    ->rows(5)
                    ->label('Narasi Panjang')
                    ->helperText('Deskripsi lengkap yang tampil di bagian utama halaman.')
                    ->placeholder('Desa Adat Tamanbali membangun tata kelola...'),

                Textarea::make('visi')
                    ->rows(3)
                    ->label('Visi Desa')
                    ->nullable()
                    ->placeholder('Menjadi desa adat yang...'),

                Textarea::make('misi')
                    ->rows(5)
                    ->label('Misi Desa')
                    ->nullable()
                    ->placeholder('1. Memperkuat nilai-nilai adat...\n2. Meningkatkan transparansi...'),
            ]);
    }
}
