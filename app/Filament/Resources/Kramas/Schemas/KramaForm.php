<?php

namespace App\Filament\Resources\Kramas\Schemas;

use App\Models\Krama;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
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
                        if (blank($get('kode_krama')) && filled($state)) {
                            $set('kode_krama', Krama::generateUniqueCode($state));
                        }
                    }),

                TextInput::make('kode_krama')
                    ->label('Kode Unik Krama')
                    ->required()
                    ->maxLength(25)
                    ->placeholder('Contoh: KJ-KRM-10294')
                    ->helperText('Otomatis dibuat saat memilih banjar. Anda dapat mengubahnya atau menekan tombol generate ulang.')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('kode_krama', strtoupper(trim((string) $state))))
                    ->regex('/^[A-Za-z0-9\-]+$/')
                    ->unique(table: Krama::class, column: 'kode_krama', ignoreRecord: true)
                    ->suffixAction(
                        Action::make('generateCode')
                            ->icon('heroicon-m-sparkles')
                            ->tooltip('Ganti / Generate Kode Baru')
                            ->action(function (Get $get, Set $set) {
                                $banjarId = $get('banjar_id');
                                $set('kode_krama', Krama::generateUniqueCode($banjarId));
                                Notification::make()
                                    ->title('Kode krama baru berhasil dibuat')
                                    ->success()
                                    ->send();
                            })
                    ),

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
