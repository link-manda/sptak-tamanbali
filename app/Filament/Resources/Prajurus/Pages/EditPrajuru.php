<?php

namespace App\Filament\Resources\Prajurus\Pages;

use App\Filament\Resources\Prajurus\PrajuruResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrajuru extends EditRecord
{
    protected static string $resource = PrajuruResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
