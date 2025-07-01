<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\TicketStatus;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null       => Tab::make('All'),
            ...TicketStatus::query()
                ->where('is_show_tab', true)
                ->orderBy('sort_order')
                ->get()
                ->map(function (TicketStatus $status) {
                    return Tab::make($status->name)
                        ->query(fn ($query) => $query->where('ticket_status_id', $status->id));
                })->toArray(),
        ];
    }
}
