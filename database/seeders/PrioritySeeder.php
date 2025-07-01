<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Priority::query()->count() !== 0) {
            return;
        }

        foreach ($this->data() as $item) {
            Priority::query()->create($item);
        }
    }

    public function data(): array
    {
        return [[
            'name'       => 'Low',
            'text_color' => '#00FF00',
        ], [
            'name'       => 'Medium',
            'text_color' => '#FFFF00',
        ], [
            'name'       => 'High',
            'text_color' => '#FFA500',
        ], [
            'name'       => 'Urgent',
            'text_color' => '#FF0000',
        ], ];
    }
}
