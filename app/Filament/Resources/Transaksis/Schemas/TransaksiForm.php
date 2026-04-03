<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_transaksi_id')
                    ->relationship('kategori', 'nama_kategori') // Relasi ke tabel kategori
                    ->required()
                    ->label('Kategori Transaksi'),

                Select::make('user_id')
                    ->relationship('user', 'name') // Relasi ke pencatat (user)
                    ->default(auth()->id()) // Otomatis terisi ID user yang sedang login
                    ->required()
                    ->label('Pencatat'),

                Select::make('jenis')
                    ->options([
                        'pemasukan' => 'Pemasukan',
                        'pengeluaran' => 'Pengeluaran',
                    ])
                    ->required(),

                TextInput::make('nominal')
                    ->numeric()
                    ->required()
                    ->prefix('Rp')
                    ->minValue(0),

                DatePicker::make('tanggal_transaksi')
                    ->required()
                    ->default(now()),

                Textarea::make('keterangan')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('bukti_file')
                    ->disk('public')
                    ->visibility('public')
                    ->directory('bukti-transaksi')
                    ->label('Upload Bukti (Opsional)'),
            ]);
    }
}