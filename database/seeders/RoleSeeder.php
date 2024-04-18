<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar roles
        $clientRole = Role::create(['name' => 'Cliente']);
        $employeeRole = Role::create(['name' => 'Funcionário']);
        $managerRole = Role::create(['name' => 'Gerente']);
        $superAdminRole = Role::create(['name' => 'Super Admin']);

        // Criar permissões
        $verTicketsPermission = Permission::create(['name' => 'Ver Tickets']);
        $editarTicketsPermission = Permission::create(['name' => 'Editar Tickets']);
        $gerenciarFuncionariosPermission = Permission::create(['name' => 'Gerenciar Funcionários']);
        $atribuirFuncoesPermission = Permission::create(['name' => 'Atribuir Funções']);

        // Atribuir permissões para cada role
        $clientRole->permissions()->attach([$verTicketsPermission->id]);
        $employeeRole->permissions()->attach([$verTicketsPermission->id, $editarTicketsPermission->id]);
        $managerRole->permissions()->attach([$verTicketsPermission->id, $editarTicketsPermission->id, $gerenciarFuncionariosPermission->id, $atribuirFuncoesPermission->id]);
        $superAdminRole->permissions()->attach([$verTicketsPermission->id, $editarTicketsPermission->id, $gerenciarFuncionariosPermission->id, $atribuirFuncoesPermission->id]);
    }
}
