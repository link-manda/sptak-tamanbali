<?php

namespace App\Filament\Resources\TimelineDesas;

use App\Filament\Resources\TimelineDesas\Pages\CreateTimelineDesa;
use App\Filament\Resources\TimelineDesas\Pages\EditTimelineDesa;
use App\Filament\Resources\TimelineDesas\Pages\ListTimelineDesas;
use App\Filament\Resources\TimelineDesas\Schemas\TimelineDesaForm;
use App\Filament\Resources\TimelineDesas\Tables\TimelineDesasTable;
use App\Models\TimelineDesa;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TimelineDesaResource extends Resource
{
    protected static ?string $model = TimelineDesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Sejarah & Timeline';

    protected static string | \UnitEnum | null $navigationGroup = 'Konten Desa';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return TimelineDesaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TimelineDesasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListTimelineDesas::route('/'),
            'create' => CreateTimelineDesa::route('/create'),
            'edit'   => EditTimelineDesa::route('/{record}/edit'),
        ];
    }
}
