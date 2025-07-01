<?php

namespace App\Filament\Resources\Master\CategoryResource\Pages;

use App\Filament\Resources\Master\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
