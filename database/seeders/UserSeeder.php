<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Buat roles jika belum ada
         $roles = ['admin', 'user'];
         foreach ($roles as $roleName) {
             Role::firstOrCreate(['name' => $roleName]);
         }
 
         // Buat 10 user biasa
         for ($i = 1; $i <= 10; $i++) {
             $user = User::create([
                 'name' => "User $i",
                 'email' => "user$i@example.com",
                 'password' => bcrypt('password'), // Ganti dengan password yang aman
             ]);
 
             // Assign role user ke user
             $user->assignRole('user');
         }
    }
}
