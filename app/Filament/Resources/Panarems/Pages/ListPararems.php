<?php

namespace App\Filament\Resources\Panarems\Pages;

use App\Filament\Resources\Panarems\PanaremResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPararems extends ListRecords
{
    protected static string $resource = PanaremResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
