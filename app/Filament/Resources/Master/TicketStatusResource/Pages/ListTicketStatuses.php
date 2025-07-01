<?php

namespace App\Filament\Resources\Master\TicketStatusResource\Pages;

use App\Filament\Resources\Master\TicketStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketStatuses extends ListRecords
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
