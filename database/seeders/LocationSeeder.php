<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Location::query()->count() !== 0) {
            return;
        }

        foreach ($this->data() as $item) {
            Location::query()->create($item);
        }
    }

    public function data(): array
    {
        return [
            ['name' => 'Pusat'],
        ];
    }
}
