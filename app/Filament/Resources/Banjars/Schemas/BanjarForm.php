<?php

namespace App\Filament\Resources\Banjars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BanjarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_banjar')
                    ->required(),
                TextInput::make('kelian_banjar')
                    ->required(),
            ]);
    }
}
