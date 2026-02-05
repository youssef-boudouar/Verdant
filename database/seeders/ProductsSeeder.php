<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Fetch Categories to get their IDs
        $plantes = Category::where('name', 'Plantes')->first()->id;
        $graines = Category::where('name', 'Graines')->first()->id;
        $outils  = Category::where('name', 'Outils')->first()->id;

        // 2. Define ALL products with 'image_url'
        $products = [
            // --- PLANTES (French) ---
            [
                'name' => 'Basilic',
                'description' => 'Plante aromatique parfaite pour la cuisine',
                'price' => 5.99,
                'stock' => 20,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=800&q=80',
            ],
            [
                'name' => 'Lavande',
                'description' => 'Belle plante violette très parfumée',
                'price' => 8.50,
                'stock' => 15,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1498579809087-ef1e558fd1da?w=800&q=80',
            ],
            [
                'name' => 'Tomate Cerise',
                'description' => 'Plant de tomates cerises bio',
                'price' => 12.00,
                'stock' => 10,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=800&q=80',
            ],

            // --- PLANTES (English / Modern) ---
            [
                'name' => 'Monstera Deliciosa',
                'description' => 'Large tropical plant with iconic split leaves. Perfect for bright, indirect light.',
                'price' => 45.99,
                'stock' => 15,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?w=800&q=80',
            ],
            [
                'name' => 'Fiddle Leaf Fig',
                'description' => 'Stunning statement plant with large violin-shaped leaves.',
                'price' => 65.00,
                'stock' => 8,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1593482892290-e5ebf4e01c3c?w=800&q=80',
            ],
            [
                'name' => 'Snake Plant',
                'description' => 'Nearly indestructible plant perfect for beginners. Great air purifier.',
                'price' => 28.50,
                'stock' => 25,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1593482892290-16b0ca71c9b1?w=800&q=80',
            ],
            [
                'name' => 'Pothos Golden',
                'description' => 'Fast-growing trailing plant with heart-shaped leaves.',
                'price' => 22.00,
                'stock' => 30,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1614594895304-fe7116ac3b2d?w=800&q=80',
            ],
            [
                'name' => 'Peace Lily',
                'description' => 'Elegant plant with white flowers. Thrives in low to medium light.',
                'price' => 35.00,
                'stock' => 12,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1593691509543-c55fb32d8de5?w=800&q=80',
            ],
            [
                'name' => 'Rubber Plant',
                'description' => 'Bold plant with glossy burgundy leaves. Easy care.',
                'price' => 38.99,
                'stock' => 10,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1614594975525-e45190c55d0b?w=800&q=80',
            ],
            [
                'name' => 'ZZ Plant',
                'description' => 'Drought-tolerant plant with waxy, dark green leaves.',
                'price' => 32.50,
                'stock' => 18,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1632207691143-643e2f7a9361?w=800&q=80',
            ],
            [
                'name' => 'Bird of Paradise',
                'description' => 'Dramatic tropical plant with large paddle-shaped leaves.',
                'price' => 75.00,
                'stock' => 5,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1545241047-6083a3684587?w=800&q=80',
            ],
            [
                'name' => 'Spider Plant',
                'description' => 'Cascading plant with variegated leaves. Excellent for beginners.',
                'price' => 18.00,
                'stock' => 35,
                'category_id' => $plantes,
                'image_url' => 'https://images.unsplash.com/photo-1572688484438-313a6e50c333?w=800&q=80',
            ],

            // --- GRAINES (French) ---
            [
                'name' => 'Graines de Tournesol',
                'description' => 'Graines bio pour cultiver de beaux tournesols',
                'price' => 3.50,
                'stock' => 50,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1597848212624-e464c42be9e0?w=800&q=80',
            ],
            [
                'name' => 'Graines de Carottes',
                'description' => 'Graines de carottes biologiques',
                'price' => 2.99,
                'stock' => 40,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=800&q=80',
            ],
            [
                'name' => 'Graines de Radis',
                'description' => 'Graines de radis à croissance rapide',
                'price' => 2.50,
                'stock' => 35,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1560617372-b5e19747970d?w=800&q=80',
            ],

            // --- GRAINES (English) ---
            [
                'name' => 'Heirloom Tomato Seeds',
                'description' => 'Organic heirloom tomato variety. 50 seeds per packet.',
                'price' => 5.99,
                'stock' => 100,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1592841200221-a6898f307baa?w=800&q=80',
            ],
            [
                'name' => 'Basil Seeds - Sweet Genovese',
                'description' => 'Classic Italian basil. 200+ seeds. Perfect for pesto.',
                'price' => 3.50,
                'stock' => 150,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1618375569909-3c8616cf7733?w=800&q=80',
            ],
            [
                'name' => 'Sunflower Seeds - Mammoth',
                'description' => 'Giant sunflower variety growing up to 12 feet tall.',
                'price' => 4.99,
                'stock' => 80,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1597848212624-e464c42be9e0?w=800&q=80',
            ],
            [
                'name' => 'Carrot Seeds - Rainbow Mix',
                'description' => 'Colorful mix of orange, purple, and yellow carrots.',
                'price' => 4.50,
                'stock' => 120,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1598170845058-32b9d6a5da37?w=800&q=80',
            ],
            [
                'name' => 'Lavender Seeds',
                'description' => 'English lavender variety. 100 seeds. Fragrant flowers.',
                'price' => 6.50,
                'stock' => 90,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1611984224831-a46e2e2e0fbb?w=800&q=80',
            ],
            [
                'name' => 'Wildflower Seed Mix',
                'description' => 'Diverse blend of 20+ native wildflower species.',
                'price' => 8.99,
                'stock' => 75,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=800&q=80',
            ],
            [
                'name' => 'Lettuce Seeds - Buttercrunch',
                'description' => 'Tender butterhead lettuce. 500 seeds.',
                'price' => 3.99,
                'stock' => 140,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1622206151226-18ca2c9ab4a1?w=800&q=80',
            ],
            [
                'name' => 'Cucumber Seeds - Burpless',
                'description' => 'Easy-to-digest variety. 30 seeds.',
                'price' => 5.50,
                'stock' => 95,
                'category_id' => $graines,
                'image_url' => 'https://images.unsplash.com/photo-1604977042946-1eecc30f269e?w=800&q=80',
            ],

            // --- OUTILS (French) ---
            [
                'name' => 'Pelle de Jardin',
                'description' => 'Pelle ergonomique en acier inoxydable',
                'price' => 25.00,
                'stock' => 12,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1628108589710-18861d9eb46d?w=800&q=80',
            ],
            [
                'name' => 'Arrosoir 5L',
                'description' => 'Arrosoir écologique en plastique recyclé',
                'price' => 18.50,
                'stock' => 8,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1616859868770-b78f4b59523e?w=800&q=80',
            ],
            [
                'name' => 'Gants de Jardinage',
                'description' => 'Gants résistants et confortables',
                'price' => 9.99,
                'stock' => 25,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1590412629191-4e78848738df?w=800&q=80',
            ],
            [
                'name' => 'Râteau',
                'description' => 'Râteau léger pour entretenir votre jardin',
                'price' => 15.00,
                'stock' => 10,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1590234509506-61a15340156d?w=800&q=80',
            ],

            // --- OUTILS (English) ---
            [
                'name' => 'Stainless Steel Garden Trowel',
                'description' => 'Professional-grade trowel with ergonomic handle.',
                'price' => 24.99,
                'stock' => 40,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&q=80',
            ],
            [
                'name' => 'Pruning Shears - Bypass',
                'description' => 'Sharp carbon steel blades for clean cuts.',
                'price' => 32.00,
                'stock' => 25,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1617576683096-00fc8eecb3af?w=800&q=80',
            ],
            [
                'name' => 'Watering Can - Copper Finish',
                'description' => 'Elegant 2-gallon copper watering can.',
                'price' => 45.00,
                'stock' => 15,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1563467833763-86c90748c34e?w=800&q=80',
            ],
            [
                'name' => 'Garden Gloves - Premium Leather',
                'description' => 'Durable goatskin leather gloves.',
                'price' => 28.50,
                'stock' => 50,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1617634667039-8e4cb277ab46?w=800&q=80',
            ],
            [
                'name' => 'Soil pH Tester Kit',
                'description' => 'Digital pH meter with moisture and light sensors.',
                'price' => 19.99,
                'stock' => 60,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1585664811087-47f65abbad64?w=800&q=80',
            ],
            [
                'name' => 'Hand Cultivator',
                'description' => 'Three-pronged cultivator for breaking up soil.',
                'price' => 16.50,
                'stock' => 45,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1615671524827-c1fe3973b648?w=800&q=80',
            ],
            [
                'name' => 'Garden Kneeler Pad',
                'description' => 'Extra-thick foam kneeling pad. Waterproof and easy to clean.',
                'price' => 22.00,
                'stock' => 35,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
            ],
            [
                'name' => 'Hose Nozzle - 10 Spray Patterns',
                'description' => 'Heavy-duty brass nozzle with 10 adjustable patterns.',
                'price' => 18.99,
                'stock' => 55,
                'category_id' => $outils,
                'image_url' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=800&q=80',
            ],
        ];

        // 3. Loop through and create each product
        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}
