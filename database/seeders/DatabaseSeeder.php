<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@verdant.com'],
            ['name' => 'Admin', 'password' => 'password', 'role' => 'admin']
        );

        User::firstOrCreate(
            ['email' => 'client@verdant.com'],
            ['name' => 'Client', 'password' => 'password', 'role' => 'client']
        );

        $this->call([
            CategorySeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
