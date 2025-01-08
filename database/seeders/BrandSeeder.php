<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name_brand' => 'samsung','created_at' => now(), 'updated_at' => now()],
            ['name_brand' => 'oppo','created_at' => now(), 'updated_at' => now()],
            ['name_brand' => 'asus','created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
