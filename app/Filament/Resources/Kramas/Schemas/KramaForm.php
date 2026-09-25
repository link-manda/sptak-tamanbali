<?php

namespace App\Filament\Resources\Kramas\Schemas;

use App\Models\Krama;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class KramaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('banjar_id')
                    ->relationship('banjar', 'nama_banjar')
                    ->searchable()
                    ->preload()
                    ->label('Banjar')
                    ->required()
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set, ?int $state) {
                        $current = (string) $get('kode_krama');
                        $set('kode_krama', Krama::formatKodeKrama($state, $current));
                    }),

                TextInput::make('kode_krama')
                    ->label('Kode Unik Krama')
                    ->required()
                    ->maxLength(25)
                    ->placeholder('Contoh: KJ-KRM-001')
                    ->helperText('Prefix banjar dibuat otomatis. Silakan masukkan nomor urut/identitas krama (contoh: KJ-KRM-001).')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        $set('kode_krama', Krama::formatKodeKrama($get('banjar_id'), $state));
                    })
                    ->regex('/^[A-Z]{2}-KRM-[0-9A-Za-z]+$/')
                    ->validationMessages([
                        'regex' => 'Nomor krama wajib diisi setelah prefix banjar (contoh: KJ-KRM-001).',
                    ])
                    ->unique(table: Krama::class, column: 'kode_krama', ignoreRecord: true),

                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required(),
                Textarea::make('alamat')
                    ->label('Alamat')
                    ->columnSpanFull(),
                Toggle::make('status_aktif')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
