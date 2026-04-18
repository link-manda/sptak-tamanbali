<?php

namespace App\Filament\Resources\TimelineDesas\Pages;

use App\Filament\Resources\TimelineDesas\TimelineDesaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTimelineDesa extends EditRecord
{
    protected static string $resource = TimelineDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
