<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name_category' => 'HP', 'created_at' => now(), 'updated_at' => now()],
            ['name_category' => 'Kamera', 'created_at' => now(), 'updated_at' => now()],
            ['name_category' => 'Laptop', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
