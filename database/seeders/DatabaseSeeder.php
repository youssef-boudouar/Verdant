<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Youssef Boudouar',
            'email' => 'youssefboudouar771@gmail.com',
            'role' => 'admin'
        ]);

        $this->call([
            CategorySeeder::class,
            ProductsSeeder::class,
        ]);
    }
}

