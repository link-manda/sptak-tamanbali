<?php

namespace App\Filament\Resources\Banjars\Schemas;

use App\Models\Banjar;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class BanjarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_banjar')
                    ->label('Nama Banjar')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                        if (blank($get('kode_banjar')) && filled($state)) {
                            $set('kode_banjar', Banjar::generateUniqueCode($state));
                        }
                    }),

                TextInput::make('kode_banjar')
                    ->label('Kode Unik Banjar')
                    ->required()
                    ->maxLength(20)
                    ->placeholder('Contoh: GG-99281')
                    ->helperText('Otomatis disarankan dari nama banjar. Anda dapat mengubahnya atau menekan tombol generate ulang.')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('kode_banjar', strtoupper(trim((string) $state))))
                    ->regex('/^[A-Za-z0-9\-]+$/')
                    ->unique(table: Banjar::class, column: 'kode_banjar', ignoreRecord: true)
                    ->suffixAction(
                        Action::make('generateCode')
                            ->icon('heroicon-m-sparkles')
                            ->tooltip('Kocok / Generate Kode Baru')
                            ->action(function (Get $get, Set $set) {
                                $nama = $get('nama_banjar');
                                $set('kode_banjar', Banjar::generateUniqueCode($nama));
                                Notification::make()
                                    ->title('Kode banjar baru berhasil dibuat')
                                    ->success()
                                    ->send();
                            })
                    ),

                TextInput::make('kelian_banjar')
                    ->label('Kelian Banjar')
                    ->required(),
            ]);
    }
}
