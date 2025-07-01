<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (TicketStatus::query()->count() !== 0) {
            return;
        }

        foreach ($this->data() as $item) {
            TicketStatus::query()->create($item);
        }
    }

    public function data(): array
    {
        return [[
            'name'           => 'Open',
            'sort_order'     => 1,
            'is_show_widget' => true,
            'is_show_tab'    => true,
            'is_default'     => true,
        ], [
            'name'           => 'In Progress',
            'sort_order'     => 2,
            'is_show_widget' => true,
            'is_show_tab'    => true,
            'is_default'     => false,
        ], [
            'name'           => 'Completed',
            'sort_order'     => 3,
            'is_show_widget' => false,
            'is_show_tab'    => true,
            'is_default'     => false,
        ], [
            'name'           => 'Closed',
            'sort_order'     => 4,
            'is_show_widget' => false,
            'is_show_tab'    => true,
            'is_default'     => false,
        ], ];
    }
}
