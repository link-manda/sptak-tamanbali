<?php

namespace App\Filament\Resources\ProgramPrioritas\Pages;

use App\Filament\Resources\ProgramPrioritas\ProgramPrioritasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramPrioritas extends EditRecord
{
    protected static string $resource = ProgramPrioritasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
