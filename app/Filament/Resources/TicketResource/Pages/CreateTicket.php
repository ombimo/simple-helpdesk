<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Category;
use App\Services\TicketService;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $ticketService = app(TicketService::class);
        $category = Category::query()->find($data['category_id']);
        $data['periode'] = now()->format('Y-m-01');
        $data['no'] = $ticketService->generateTicketNumber($category?->prefix_no ?? 'GEN', $data['periode']);

        return $data;
    }
}
