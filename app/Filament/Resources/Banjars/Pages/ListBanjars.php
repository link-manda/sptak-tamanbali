<?php

namespace App\Filament\Resources\Banjars\Pages;

use App\Filament\Resources\Banjars\BanjarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBanjars extends ListRecords
{
    protected static string $resource = BanjarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
