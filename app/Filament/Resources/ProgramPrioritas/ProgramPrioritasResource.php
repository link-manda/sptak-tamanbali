<?php

namespace App\Filament\Resources\ProgramPrioritas;

use App\Filament\Resources\ProgramPrioritas\Pages\CreateProgramPrioritas;
use App\Filament\Resources\ProgramPrioritas\Pages\EditProgramPrioritas;
use App\Filament\Resources\ProgramPrioritas\Pages\ListProgramPrioritas;
use App\Filament\Resources\ProgramPrioritas\Schemas\ProgramPrioritasForm;
use App\Filament\Resources\ProgramPrioritas\Tables\ProgramPrioritasTable;
use App\Models\ProgramPrioritas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProgramPrioritasResource extends Resource
{
    protected static ?string $model = ProgramPrioritas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static ?string $navigationLabel = 'Program Prioritas';

    protected static ?string $pluralModelLabel = 'Program Prioritas';

    protected static string|\UnitEnum|null $navigationGroup = 'Tata Kelola & Program';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nama_program';

    public static function form(Schema $schema): Schema
    {
        return ProgramPrioritasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramPrioritasTable::configure($table);
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
            'index' => ListProgramPrioritas::route('/'),
            'create' => CreateProgramPrioritas::route('/create'),
            'edit' => EditProgramPrioritas::route('/{record}/edit'),
        ];
    }
}
