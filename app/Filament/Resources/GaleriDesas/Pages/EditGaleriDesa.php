<?php

namespace App\Filament\Resources\GaleriDesas\Pages;

use App\Filament\Resources\GaleriDesas\GaleriDesaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGaleriDesa extends EditRecord
{
    protected static string $resource = GaleriDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
