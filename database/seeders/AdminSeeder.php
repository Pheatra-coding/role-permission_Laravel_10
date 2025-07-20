<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $admin = User::firstOrCreate([
            'email' => 'pheaktra@gmail.com',
        ], [
            'name' => 'Pheaktra',
            'password' => bcrypt('password'),
            'image' => 'default.jpg',
        ]);

        $admin->assignRole($adminRole);
    }
}