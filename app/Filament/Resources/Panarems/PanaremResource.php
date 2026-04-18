<?php

namespace App\Filament\Resources\Panarems;

use App\Filament\Resources\Panarems\Pages\CreatePararem;
use App\Filament\Resources\Panarems\Pages\EditPararem;
use App\Filament\Resources\Panarems\Pages\ListPararems;
use App\Filament\Resources\Panarems\Schemas\PanaremForm;
use App\Filament\Resources\Panarems\Tables\PanaremsTable;
use App\Models\Pararem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PanaremResource extends Resource
{
    protected static ?string $model = Pararem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static ?string $navigationLabel = 'Pararem';

    protected static string | \UnitEnum | null $navigationGroup = 'Regulasi Adat';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return PanaremForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PanaremsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPararems::route('/'),
            'create' => CreatePararem::route('/create'),
            'edit'   => EditPararem::route('/{record}/edit'),
        ];
    }
}
