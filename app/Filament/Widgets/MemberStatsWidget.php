<?php

namespace App\Filament\Widgets;

use App\Models\Krama;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MemberStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalKrama = Krama::count();
        $aktivKrama = Krama::where('status_aktif', true)->count();
        $tidakAktifKrama = $totalKrama - $aktivKrama;

        return [
            Stat::make('Total Anggota', $totalKrama)
                ->description('Seluruh anggota desa adat')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Anggota Aktif', $aktivKrama)
                ->description('Anggota yang masih aktif')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Anggota Tidak Aktif', $tidakAktifKrama)
                ->description('Anggota yang tidak aktif')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('warning'),
        ];
    }
}
