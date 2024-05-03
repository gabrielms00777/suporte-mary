<?php

namespace App\Livewire\Admin\Unlock;

use App\Models\Unlock;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Index extends Component
{
    use WithPagination, Toast;

    public array $headers = [
        ['key' => 'rep.serial_number.business_name', 'label' => 'Empresa'],
        ['key' => 'rep.serial_number', 'label' => 'Nº Serie'],
        ['key' => 'rep.serial_number', 'label' => 'Nº Desbloqueios'],
        ['key' => 'name', 'label' => 'Responsavel'],
        ['key' => 'email', 'label' => 'Data'],
        ['key' => 'roles.name', 'label' => 'Tecnico'],
        ['key' => 'roles.name', 'label' => 'Emergecial'],
    ];

    #[Computed()]
    public function unlocks()
    {
        return Unlock::query()
                        ->with('rep.client')
                        ->latest()
                        ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.unlock.index');
    }
}
