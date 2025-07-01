<?php

namespace App\Filament\Resources\Master\PriorityResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\Master\PriorityResource;
use Filament\Resources\Pages\EditRecord;

class EditPriority extends EditRecord
{
    protected static string $resource = PriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
