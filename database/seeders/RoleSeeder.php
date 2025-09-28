<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Создаём роли
        $moderator = Role::firstOrCreate(['name' => 'moderator']); // id = 1
        $reader    = Role::firstOrCreate(['name' => 'reader']);    // id = 2

        // Создаём модератора
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role_id' => $moderator->id,
        ]);
    }
}
