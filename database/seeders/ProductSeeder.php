<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $image =  file_get_contents('https://p lacehold.co/800x600');
        $imageName = Str::random(10) . '.png';
        Storage::disk('public')->put('products/' . $imageName, $image);

        $category_1 = Category::create([
            'name_category' => 'eletronik'
        ]);
        $category_2 = Category::create([
            'name_category' => 'keyboard'
        ]);


        // produk 1
        $product_1 =  Product::create(
            [
                'name_product' => 'Keyboard Rgb',
                'description_product' => 'keyboard mechanical',
                'stock_product' => 10,
                'price_product' => 200000, // 20.000
                'category_id' => $category_2->id,
                'image_product' => 'products/' . $imageName,
            ]
        );
        // produk 2
        $product_2 =  Product::create(
            [
                'name_product' => 'Laptop Asus',
                'description_product' => 'Asus gaming',
                'stock_product' => 10,
                'price_product' => 10000000, // 10.000.000
                'category_id' => $category_1->id,
                'image_product' => 'products/' . $imageName,
            ]
        );
    }
}
