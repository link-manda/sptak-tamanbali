<?php

namespace App\Filament\Resources\Kramas\Pages;

use App\Filament\Resources\Kramas\KramaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKrama extends EditRecord
{
    protected static string $resource = KramaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
