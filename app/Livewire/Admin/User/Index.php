<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Index extends Component
{
    use WithPagination, Toast;

    // public array $sortBy = ['column' => 'id', 'direction' => 'desc'];


    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Nome'],
        ['key' => 'email', 'label' => 'Email'],
        ['key' => 'role', 'label' => 'Role'],
    ];

    #[Computed()]
    public function users()
    {
        return User::query()
                        ->latest()
                        ->paginate(10);
    }
    public function render()
    {
        return view('livewire.admin.user.index');
    }
}
