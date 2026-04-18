<?php

namespace App\Filament\Resources\ProfilDesas\Pages;

use App\Filament\Resources\ProfilDesas\ProfilDesaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfilDesa extends EditRecord
{
    protected static string $resource = ProfilDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada tombol delete — singleton tidak boleh dihapus
        ];
    }
}
