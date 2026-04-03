<?php

namespace App\Filament\Resources\Banjars;

use App\Filament\Resources\Banjars\Pages\CreateBanjar;
use App\Filament\Resources\Banjars\Pages\EditBanjar;
use App\Filament\Resources\Banjars\Pages\ListBanjars;
use App\Filament\Resources\Banjars\Schemas\BanjarForm;
use App\Filament\Resources\Banjars\Tables\BanjarsTable;
use App\Models\Banjar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BanjarResource extends Resource
{
    protected static ?string $model = Banjar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $recordTitleAttribute = 'Banjar';

    public static function form(Schema $schema): Schema
    {
        return BanjarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BanjarsTable::configure($table);
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
            'index' => ListBanjars::route('/'),
            'create' => CreateBanjar::route('/create'),
            'edit' => EditBanjar::route('/{record}/edit'),
        ];
    }
}
