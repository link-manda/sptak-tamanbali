<?php

namespace App\Filament\Resources\AwigAwigs\Pages;

use App\Filament\Resources\AwigAwigs\AwigAwigResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAwigAwig extends EditRecord
{
    protected static string $resource = AwigAwigResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
