<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //buat role
        $role_admin = Role::create(['name' => 'admin']); // buar role admin
        $role_user = Role::create(['name' => 'user']);   // buat role user

        //buat permission
        $permission_crud_product = Permission::create(['name' =>  'crud produk']);    // buat permission crud product
        $permission_crud_category = Permission::create(['name' => 'crud category']); // buat permission crud category
        $permission_buy_product = Permission::create(['name' => 'buy product']);     // buat permission crud beli produk
        $permission_review = Permission::create(['name' => 'review product']);               // buat permission review product


        // masukkan permission ke role
        $permission_crud_product->givePermissionTo($role_admin);   // berikan permission crud produk ke role admin
        $permission_crud_category->givePermissionTo($role_admin);  // berikan permission crud categori ke role admin
        $permission_buy_product->givePermissionTo($role_user);     // berikan permission beli produk ke role user
        $permission_review->givePermissionTo($role_user);          // berikan permission review produk ke role user

        //buat Admin
        $admin =  User::create([
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);

        $admin->assignRole('admin');  // berikan role admin ke administrator
    }
}
