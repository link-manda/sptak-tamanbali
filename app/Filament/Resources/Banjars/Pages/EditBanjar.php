<?php

namespace App\Filament\Resources\Banjars\Pages;

use App\Filament\Resources\Banjars\BanjarResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBanjar extends EditRecord
{
    protected static string $resource = BanjarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
