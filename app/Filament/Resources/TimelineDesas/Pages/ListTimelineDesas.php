<?php

namespace App\Filament\Resources\TimelineDesas\Pages;

use App\Filament\Resources\TimelineDesas\TimelineDesaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTimelineDesas extends ListRecords
{
    protected static string $resource = TimelineDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
