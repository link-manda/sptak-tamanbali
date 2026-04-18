<?php

namespace App\Filament\Resources\AwigAwigs;

use App\Filament\Resources\AwigAwigs\Pages\CreateAwigAwig;
use App\Filament\Resources\AwigAwigs\Pages\EditAwigAwig;
use App\Filament\Resources\AwigAwigs\Pages\ListAwigAwigs;
use App\Filament\Resources\AwigAwigs\Schemas\AwigAwigForm;
use App\Filament\Resources\AwigAwigs\Tables\AwigAwigsTable;
use App\Models\AwigAwig;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AwigAwigResource extends Resource
{
    protected static ?string $model = AwigAwig::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Awig-Awig';

    protected static ?string $pluralModelLabel = 'Awig-Awig';

    protected static string | \UnitEnum | null $navigationGroup = 'Regulasi Adat';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return AwigAwigForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AwigAwigsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListAwigAwigs::route('/'),
            'create' => CreateAwigAwig::route('/create'),
            'edit'   => EditAwigAwig::route('/{record}/edit'),
        ];
    }
}
