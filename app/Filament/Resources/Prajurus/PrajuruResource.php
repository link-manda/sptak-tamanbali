<?php

namespace App\Filament\Resources\Prajurus;

use App\Filament\Resources\Prajurus\Pages\CreatePrajuru;
use App\Filament\Resources\Prajurus\Pages\EditPrajuru;
use App\Filament\Resources\Prajurus\Pages\ListPrajurus;
use App\Filament\Resources\Prajurus\Schemas\PrajuruForm;
use App\Filament\Resources\Prajurus\Tables\PrajurusTable;
use App\Models\Prajuru;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrajuruResource extends Resource
{
    protected static ?string $model = Prajuru::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Susunan Prajuru';

    protected static ?string $pluralModelLabel = 'Susunan Prajuru';

    protected static string | \UnitEnum | null $navigationGroup = 'Administrasi Desa';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    public static function form(Schema $schema): Schema
    {
        return PrajuruForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrajurusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPrajurus::route('/'),
            'create' => CreatePrajuru::route('/create'),
            'edit'   => EditPrajuru::route('/{record}/edit'),
        ];
    }
}
