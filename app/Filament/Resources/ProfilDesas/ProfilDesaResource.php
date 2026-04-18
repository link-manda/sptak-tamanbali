<?php

namespace App\Filament\Resources\ProfilDesas;

use App\Filament\Resources\ProfilDesas\Pages\CreateProfilDesa;
use App\Filament\Resources\ProfilDesas\Pages\EditProfilDesa;
use App\Filament\Resources\ProfilDesas\Pages\ListProfilDesas;
use App\Filament\Resources\ProfilDesas\Schemas\ProfilDesaForm;
use App\Models\ProfilDesa;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfilDesaResource extends Resource
{
    protected static ?string $model = ProfilDesa::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $navigationLabel = 'Profil Desa';

    protected static ?string $pluralModelLabel = 'Profil Desa';

    protected static string | \UnitEnum | null $navigationGroup = 'Konten Desa';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ProfilDesaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('narasi_singkat')
                    ->label('Narasi Singkat')
                    ->limit(100),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListProfilDesas::route('/'),
            'create' => CreateProfilDesa::route('/create'),
            'edit'   => EditProfilDesa::route('/{record}/edit'),
        ];
    }
}
