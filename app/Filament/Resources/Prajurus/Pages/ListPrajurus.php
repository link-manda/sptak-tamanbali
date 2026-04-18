<?php

namespace App\Filament\Resources\Prajurus\Pages;

use App\Filament\Resources\Prajurus\PrajuruResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrajurus extends ListRecords
{
    protected static string $resource = PrajuruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
