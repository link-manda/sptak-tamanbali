<?php

namespace App\Filament\Resources\GaleriDesas;

use App\Filament\Resources\GaleriDesas\Pages\CreateGaleriDesa;
use App\Filament\Resources\GaleriDesas\Pages\EditGaleriDesa;
use App\Filament\Resources\GaleriDesas\Pages\ListGaleriDesas;
use App\Filament\Resources\GaleriDesas\Schemas\GaleriDesaForm;
use App\Filament\Resources\GaleriDesas\Tables\GaleriDesasTable;
use App\Models\GaleriDesa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GaleriDesaResource extends Resource
{
    protected static ?string $model = GaleriDesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Galeri & Dokumentasi';

    protected static ?string $pluralModelLabel = 'Galeri & Dokumentasi';

    protected static string|\UnitEnum|null $navigationGroup = 'Konten Desa';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return GaleriDesaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GaleriDesasTable::configure($table);
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
            'index' => ListGaleriDesas::route('/'),
            'create' => CreateGaleriDesa::route('/create'),
            'edit' => EditGaleriDesa::route('/{record}/edit'),
        ];
    }
}
