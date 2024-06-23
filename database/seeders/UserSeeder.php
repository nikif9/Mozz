<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'administrator')->first();
        $moderatorRole = Role::where('name', 'moderator')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->roles()->attach($adminRole);

        $moderator = User::create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password'),
        ]);
        $moderator->roles()->attach($moderatorRole);
    }
}
