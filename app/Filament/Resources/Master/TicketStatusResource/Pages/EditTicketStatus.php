<?php

namespace App\Filament\Resources\Master\TicketStatusResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\Master\TicketStatusResource;
use Filament\Resources\Pages\EditRecord;

class EditTicketStatus extends EditRecord
{
    protected static string $resource = TicketStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
