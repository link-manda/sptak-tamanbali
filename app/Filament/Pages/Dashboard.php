<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DocumentStatsWidget;
use App\Filament\Widgets\MemberStatsWidget;
use App\Filament\Widgets\TransactionChartWidget;
use App\Filament\Widgets\TransactionSummaryWidget;
use App\Filament\Widgets\WelcomeWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        $user = auth()->user();

        // Fallback jika user tidak authenticated (edge case)
        if (!$user) {
            return [
                TransactionSummaryWidget::class,
                MemberStatsWidget::class,
            ];
        }

        $widgets = [];

        // Welcome widget untuk semua user (paling atas)
        $widgets[] = WelcomeWidget::class;

        // Widget untuk semua user
        $widgets[] = TransactionSummaryWidget::class;
        $widgets[] = MemberStatsWidget::class;

        // Widget untuk admin dan staf_keuangan (dapat melihat detail keuangan)
        if (in_array($user->role, ['admin', 'staf_keuangan'])) {
            $widgets[] = TransactionChartWidget::class;
        }

        // Widget untuk admin dan staf_admin (dapat melihat dokumen)
        if (in_array($user->role, ['admin', 'staf_admin'])) {
            $widgets[] = DocumentStatsWidget::class;
        }

        return $widgets;
    }
}
