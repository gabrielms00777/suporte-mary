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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class
        ]);

        // Criar clientes
    $client1 = Client::create([
        'created_by' => 1,
        'business_name' => 'Tomodachi Bar',
        'cpf_cnpj' => '14.035.284/0001-66',
        'contract' => true,
        'system' => 'Secullum Web Pro',
    ]);
    Contact::create([
        'client_id' => $client1->id,
        'phone' => '16 99195-7828',
        'name' => 'Débora',
    ]);

    $client2 = Client::create([
        'created_by' => 1,
        'business_name' => 'AJSR MONTAGEM',
        'cpf_cnpj' => '23.063.771/0001-23',
        'contract' => true,
        'system' => 'Secullum Offline',
    ]);
    Contact::create([
        'client_id' => $client2->id,
        'phone' => '16 99700-6977',
        'name' => 'Otavio',
    ]);

    $client3 = Client::create([
        'created_by' => 1,
        'business_name' => 'Escola Guarup',
        'cpf_cnpj' => '03.237.094/0001-05',
        'contract' => true,
        'system' => 'Secullum Offline',
    ]);
    Contact::create([
        'client_id' => $client3->id,
        'phone' => '16 3945-1945',
        'name' => 'Joice',
    ]);

    $client4 = Client::create([
        'created_by' => 1,
        'business_name' => 'Quali Saude',
        'cpf_cnpj' => '50.270.398/0001-54',
        'contract' => true,
        'system' => 'ATEC',
    ]);
    Contact::create([
        'client_id' => $client4->id,
        'phone' => '16 98221-6666',
        'name' => 'Ronaldo',
    ]);

    $client5 = Client::create([
        'created_by' => 1,
        'business_name' => 'Sandubao Lanches',
        'cpf_cnpj' => '12.028.444/0001-14',
        'contract' => false,
        'system' => 'Nao tem contrato',
    ]);
    Contact::create([
        'client_id' => $client5->id,
        'phone' => '16 98213-6762',
        'name' => 'Amanda',
    ]);

        // Client::factory()
        //         ->count(10)
        //         ->has(Contact::factory()->count(3))
        //         ->has(Ticket::factory()->count(3))
        //         ->create();
    }
}
