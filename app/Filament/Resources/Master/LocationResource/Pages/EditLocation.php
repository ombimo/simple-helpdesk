<?php

namespace App\Filament\Resources\Master\LocationResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\Master\LocationResource;
use Filament\Resources\Pages\EditRecord;

class EditLocation extends EditRecord
{
    protected static string $resource = LocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
