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

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Data Banjar';

    protected static ?string $pluralModelLabel = 'Data Banjar';

    protected static string | \UnitEnum | null $navigationGroup = 'Administrasi Desa';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'nama_banjar';

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
