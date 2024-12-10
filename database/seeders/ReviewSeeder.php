<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data untuk tabel reviews
        $reviews = [];
        $productIds = DB::table('products')->pluck('id')->toArray(); // Ambil semua ID produk
        $userIds = range(1, 5); // ID user dari 1 sampai 5

        // Buat 20 review secara acak
        for ($i = 0; $i < 20; $i++) {
            $reviews[] = [
                'product_id' => $productIds[array_rand($productIds)], // Pilih ID produk secara acak
                'user_id' => $userIds[array_rand($userIds)], // Pilih ID user secara acak
                'rating' => rand(1, 5), // Rating acak dari 1 sampai 5
                'comment' => fake()->sentence(10), // Komentar acak menggunakan fake data
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert data ke tabel reviews
        DB::table('reviews')->insert($reviews);
    }
}
