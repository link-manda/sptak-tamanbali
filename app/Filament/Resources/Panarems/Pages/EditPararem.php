<?php

namespace App\Filament\Resources\Panarems\Pages;

use App\Filament\Resources\Panarems\PanaremResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPararem extends EditRecord
{
    protected static string $resource = PanaremResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
