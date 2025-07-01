<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::query()->count() !== 0) {
            return;
        }

        User::query()->create([
            'name'     => 'Admin',
            'email'    => 'admin@domain.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
