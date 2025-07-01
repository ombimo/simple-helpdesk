<?php

namespace App\Filament\Resources\Master\CategoryResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\Master\CategoryResource;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
