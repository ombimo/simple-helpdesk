<?php

namespace App\Filament\Widgets;

use App\Models\TicketStatus;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketStatusStatsWidget extends BaseWidget
{
    public static function getSort(): int
    {
        return config('widget-sort.dashboard.ticket-stats');
    }

    protected function getStats(): array
    {
        $dataTicketStatuses = TicketStatus::query()
            ->where('is_show_widget', true)
            ->orderBy('sort_order')
            ->withCount('tickets')
            ->get();

        $stats = [];
        foreach ($dataTicketStatuses as $status) {
            $stats[] = Stat::make($status->name, $status->tickets_count);
        }

        return $stats;
    }
}
