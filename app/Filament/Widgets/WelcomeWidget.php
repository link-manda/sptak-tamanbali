<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class WelcomeWidget extends Widget
{
    protected string $view = 'filament.widgets.welcome-widget';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $user = Auth::user();
        $hour = now()->hour;

        if ($hour >= 4 && $hour < 11) {
            $greeting = 'Selamat Pagi';
            $icon = 'heroicon-m-sun';
            $gradientColors = '#fbb117, #f97316'; // amber-400 to orange-500
            $subText = 'Semoga harimu menyenangkan dan penuh berkah.';
        } elseif ($hour >= 11 && $hour < 15) {
            $greeting = 'Selamat Siang';
            $icon = 'heroicon-m-sun';
            $gradientColors = '#38bdf8, #3b82f6'; // sky-400 to blue-500
            $subText = 'Terus semangat menjalankan tugas pengabdian desa.';
        } elseif ($hour >= 15 && $hour < 18) {
            $greeting = 'Selamat Sore';
            $icon = 'heroicon-m-sun';
            $gradientColors = '#fb923c, #f43f5e'; // orange-400 to rose-500
            $subText = 'Waktunya merangkum pencapaian hari ini.';
        } else {
            $greeting = 'Selamat Malam';
            $icon = 'heroicon-m-moon';
            $gradientColors = '#6366f1, #7e22ce'; // indigo-500 to purple-700
            $subText = 'Istirahat yang cukup untuk persiapan besok.';
        }

        return [
            'greeting' => $greeting,
            'userName' => $user?->name ?? 'Pengguna',
            'userRole' => $user?->role_label ?? '-',
            'icon' => $icon,
            'gradientColors' => $gradientColors,
            'subText' => $subText,
            'currentTime' => now()->translatedFormat('l, d F Y • H:i'),
        ];
    }
}
