<?php

namespace App\Filament\Resources\Kramas;

use App\Filament\Resources\Kramas\Pages\CreateKrama;
use App\Filament\Resources\Kramas\Pages\EditKrama;
use App\Filament\Resources\Kramas\Pages\ListKramas;
use App\Filament\Resources\Kramas\Schemas\KramaForm;
use App\Filament\Resources\Kramas\Tables\KramasTable;
use App\Models\Krama;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KramaResource extends Resource
{
    protected static ?string $model = Krama::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'Krama';

    public static function form(Schema $schema): Schema
    {
        return KramaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KramasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKramas::route('/'),
            'create' => CreateKrama::route('/create'),
            'edit' => EditKrama::route('/{record}/edit'),
        ];
    }
}
