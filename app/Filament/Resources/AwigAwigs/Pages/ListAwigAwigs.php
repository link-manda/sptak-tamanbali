<?php

namespace App\Filament\Resources\AwigAwigs\Pages;

use App\Filament\Resources\AwigAwigs\AwigAwigResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAwigAwigs extends ListRecords
{
    protected static string $resource = AwigAwigResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
