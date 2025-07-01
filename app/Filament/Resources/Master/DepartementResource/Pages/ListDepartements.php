<?php

namespace App\Filament\Resources\Master\DepartementResource\Pages;

use App\Filament\Resources\Master\DepartementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepartements extends ListRecords
{
    protected static string $resource = DepartementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
