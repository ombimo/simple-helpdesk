<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\TicketResource;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
