<?php

namespace App\Filament\Resources\SuratMasuks;

use App\Filament\Resources\SuratMasuks\Pages\CreateSuratMasuk;
use App\Filament\Resources\SuratMasuks\Pages\EditSuratMasuk;
use App\Filament\Resources\SuratMasuks\Pages\ListSuratMasuks;
use App\Filament\Resources\SuratMasuks\Schemas\SuratMasukForm;
use App\Filament\Resources\SuratMasuks\Tables\SuratMasuksTable;
use App\Models\SuratMasuk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SuratMasukResource extends Resource
{
    protected static ?string $model = SuratMasuk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Inbox;

    protected static ?string $navigationLabel = 'Surat Masuk';

    protected static ?string $recordTitleAttribute = 'SuratMasuk';

    public static function form(Schema $schema): Schema
    {
        return SuratMasukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuratMasuksTable::configure($table);
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
            'index' => ListSuratMasuks::route('/'),
            'create' => CreateSuratMasuk::route('/create'),
            'edit' => EditSuratMasuk::route('/{record}/edit'),
        ];
    }
}
