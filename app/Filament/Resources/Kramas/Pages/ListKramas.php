<?php

namespace App\Filament\Resources\Kramas\Pages;

use App\Filament\Resources\Kramas\KramaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKramas extends ListRecords
{
    protected static string $resource = KramaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
