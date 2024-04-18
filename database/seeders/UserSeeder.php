<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Criar usuários
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => 'admin',
            'role_id' => 4,
        ]);

        $gabriel = User::create([
            'name' => 'Gabriel',
            'email' => 'gabriel@test',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        $diego = User::create([
            'name' => 'Diego',
            'email' => 'diego@test',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        $eduardo = User::create([
            'name' => 'Eduardo',
            'email' => 'eduardo@test',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);
    }
}
