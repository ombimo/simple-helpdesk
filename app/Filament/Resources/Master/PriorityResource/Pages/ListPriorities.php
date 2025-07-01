<?php

namespace App\Filament\Resources\Master\PriorityResource\Pages;

use App\Filament\Resources\Master\PriorityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriorities extends ListRecords
{
    protected static string $resource = PriorityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
