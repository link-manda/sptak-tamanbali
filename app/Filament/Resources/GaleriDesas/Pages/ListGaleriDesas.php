<?php

namespace App\Filament\Resources\GaleriDesas\Pages;

use App\Filament\Resources\GaleriDesas\GaleriDesaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGaleriDesas extends ListRecords
{
    protected static string $resource = GaleriDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
