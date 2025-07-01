<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Departement::query()->count() !== 0) {
            return;
        }

        foreach ($this->data() as $item) {
            Departement::query()->create($item);
        }
    }

    public function data(): array
    {
        return [
            ['name' => 'IT'],
            ['name' => 'HR'],
            ['name' => 'Finance'],
            ['name' => 'Marketing'],
            ['name' => 'Sales'],
            ['name' => 'Customer Support'],
            ['name' => 'Legal'],
            ['name' => 'Procurement'],
            ['name' => 'Operations'],
            ['name' => 'R&D'],
            ['name' => 'General Affairs'],
            ['name' => 'Quality Assurance'],
            ['name' => 'Compliance'],
            ['name' => 'Project Management Office'],
        ];
    }
}
