<?php

namespace App\Filament\Resources\Admin\UserResource\Pages;

use App\Filament\Actions;
use App\Filament\Resources\Admin\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteActionWithCatch::make(),
        ];
    }
}
