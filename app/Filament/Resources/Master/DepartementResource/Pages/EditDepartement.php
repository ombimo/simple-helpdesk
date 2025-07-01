<?php

namespace App\Filament\Resources\Master\DepartementResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\Master\DepartementResource;
use Filament\Resources\Pages\EditRecord;

class EditDepartement extends EditRecord
{
    protected static string $resource = DepartementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
