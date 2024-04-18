<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => 'admin',
            'type' => UserTypeEnum::ADMIN,
        ]);

        $this->call([
            UserSeeder::class
        ]);

        Client::factory()
                ->count(10)
                ->has(Contact::factory()->count(3))
                ->has(Ticket::factory()->count(3))
                ->create();
    }
}
