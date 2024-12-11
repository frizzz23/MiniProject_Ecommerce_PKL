<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            // Produk untuk kategori HP
            [
                'name_product' => 'iPhone 14',
                'slug' => 'iphone-14',
                'description_product' => 'HP flagship dari Apple dengan layar Super Retina XDR.',
                'stock_product' => 20,
                'price_product' => 15000000,
                
                'category_id' => 1, // ID kategori HP
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_product' => 'Samsung Galaxy S23',
                'slug' => 'samsung-galaxy-s23',
                'description_product' => 'HP Android premium dengan kamera 200MP.',
                'stock_product' => 15,
                'price_product' => 14000000,
                
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Produk untuk kategori Kamera
            [
                'name_product' => 'Canon EOS 5D Mark IV',
                'slug' => 'canon-eos-5d-mark-iv',
                'description_product' => 'Kamera DSLR profesional dengan sensor full-frame.',
                'stock_product' => 10,
                'price_product' => 35000000,
                
                'category_id' => 2, // ID kategori Kamera
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_product' => 'Sony Alpha A7 III',
                'slug' => 'sony-alpha-a7-iii',
                'description_product' => 'Kamera mirrorless dengan kemampuan video 4K.',
                'stock_product' => 8,
                'price_product' => 28000000,
                
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Produk untuk kategori Laptop
            [
                'name_product' => 'MacBook Pro 14',
                'slug' => 'macbook-pro-14',
                'description_product' => 'Laptop high-end dari Apple dengan chip M2 Pro.',
                'stock_product' => 12,
                'price_product' => 28000000,
                
                'category_id' => 3, // ID kategori Laptop
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_product' => 'ASUS ROG Zephyrus G14',
                'slug' => 'asus-rog-zephyrus-g14',
                'description_product' => 'Laptop gaming dengan prosesor AMD Ryzen 9.',
                'stock_product' => 5,
                'price_product' => 24000000,
              
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
