<?php

namespace App\Filament\Resources\ProfilDesas\Pages;

use App\Filament\Resources\ProfilDesas\ProfilDesaResource;
use App\Models\ProfilDesa;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

/**
 * List page khusus singleton — jika record sudah ada, tombol "Edit" akan muncul.
 * Jika belum ada, tombol "Buat Profil" akan muncul.
 */
class ListProfilDesas extends ListRecords
{
    protected static string $resource = ProfilDesaResource::class;

    protected function getHeaderActions(): array
    {
        $hasRecord = ProfilDesa::exists();

        return $hasRecord ? [] : [CreateAction::make()->label('Buat Profil Desa')];
    }
}
