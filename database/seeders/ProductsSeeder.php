<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plantes = Category::where('name', 'Plantes')->first(); // get the first result after running the where query
        $graines = Category::where('name', 'Graines')->first();
        $outils = Category::where('name', 'Outils')->first();

        // Create some products for Plantes
        Product::create([
            'name' => 'Basilic',
            'description' => 'Plante aromatique parfaite pour la cuisine',
            'price' => 5.99,
            'stock' => 20,
            'image_url' => 'https://via.placeholder.com/400x400/90EE90/000000?text=Basilic',
            'category_id' => $plantes->id,
        ]);

        Product::create([
            'name' => 'Lavande',
            'description' => 'Belle plante violette très parfumée',
            'price' => 8.50,
            'stock' => 15,
            'image_url' => 'https://via.placeholder.com/400x400/9370DB/000000?text=Lavande',
            'category_id' => $plantes->id,
        ]);

        Product::create([
            'name' => 'Tomate Cerise',
            'description' => 'Plant de tomates cerises bio',
            'price' => 12.00,
            'stock' => 10,
            'image_url' => 'https://via.placeholder.com/400x400/FF6347/000000?text=Tomate',
            'category_id' => $plantes->id,
        ]);

        // Create some products for Graines
        Product::create([
            'name' => 'Graines de Tournesol',
            'description' => 'Graines bio pour cultiver de beaux tournesols',
            'price' => 3.50,
            'stock' => 50,
            'image_url' => 'https://via.placeholder.com/400x400/FFD700/000000?text=Tournesol',
            'category_id' => $graines->id,
        ]);

        Product::create([
            'name' => 'Graines de Carottes',
            'description' => 'Graines de carottes biologiques',
            'price' => 2.99,
            'stock' => 40,
            'image_url' => 'https://via.placeholder.com/400x400/FF8C00/000000?text=Carottes',
            'category_id' => $graines->id,
        ]);

        Product::create([
            'name' => 'Graines de Radis',
            'description' => 'Graines de radis à croissance rapide',
            'price' => 2.50,
            'stock' => 35,
            'image_url' => 'https://via.placeholder.com/400x400/DC143C/000000?text=Radis',
            'category_id' => $graines->id,
        ]);

        // Create some products for Outils
        Product::create([
            'name' => 'Pelle de Jardin',
            'description' => 'Pelle ergonomique en acier inoxydable',
            'price' => 25.00,
            'stock' => 12,
            'image_url' => 'https://via.placeholder.com/400x400/808080/000000?text=Pelle',
            'category_id' => $outils->id,
        ]);

        Product::create([
            'name' => 'Arrosoir 5L',
            'description' => 'Arrosoir écologique en plastique recyclé',
            'price' => 18.50,
            'stock' => 8,
            'image_url' => 'https://via.placeholder.com/400x400/00CED1/000000?text=Arrosoir',
            'category_id' => $outils->id,
        ]);

        Product::create([
            'name' => 'Gants de Jardinage',
            'description' => 'Gants résistants et confortables',
            'price' => 9.99,
            'stock' => 25,
            'image_url' => 'https://via.placeholder.com/400x400/228B22/000000?text=Gants',
            'category_id' => $outils->id,
        ]);

        Product::create([
            'name' => 'Râteau',
            'description' => 'Râteau léger pour entretenir votre jardin',
            'price' => 15.00,
            'stock' => 10,
            'image_url' => 'https://via.placeholder.com/400x400/A52A2A/000000?text=Rateau',
            'category_id' => $outils->id,
        ]);
    }
}
