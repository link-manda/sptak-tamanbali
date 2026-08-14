<?php

namespace App\Filament\Resources\ProgramPrioritas\Pages;

use App\Filament\Resources\ProgramPrioritas\ProgramPrioritasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramPrioritas extends ListRecords
{
    protected static string $resource = ProgramPrioritasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
