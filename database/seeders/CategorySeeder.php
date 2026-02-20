<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(
            ['name' => 'Plantes'],
            ['description' => 'dsbjhbchxnxijcdnokwodkwpe']
        );

        Category::firstOrCreate(
            ['name' => 'Graines'],
            ['description' => 'dsiudsffsdfcsdcsdccd']
        );

        Category::firstOrCreate(
            ['name' => 'Outils'],
            ['description' => 'dsddddddddcxcxvxcvflpokdvpo']
        );
    }
}
