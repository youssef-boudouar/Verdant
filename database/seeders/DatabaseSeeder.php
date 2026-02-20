<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@verdant.com',
            'password' => 'password',
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Client',
            'email'    => 'client@verdant.com',
            'password' => 'password',
            'role'     => 'client',
        ]);

        $this->call([
            CategorySeeder::class,
            ProductsSeeder::class,
        ]);
    }
}
