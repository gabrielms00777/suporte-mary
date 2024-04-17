<?php

namespace App\Livewire\Admin\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Show extends Component
{
    public Ticket $ticket;

    public array $statusOptions = [
        ['key' => 'open', 'value' => 'Aberto'],
        ['key' => 'in_progress', 'value' => 'Em Andamento'],
        ['key' => 'finished', 'value' => 'Finalizado'],
        ['key' => 'scheduled', 'value' => 'Agendado'],
    ];

    public int $user_id;
    public string $status;
    public string $solution;

    public function mount()
    {
        $this->user_id = $this->ticket->finished_by;
        $this->status = $this->ticket->status;
        $this->solution = $this->ticket->solution;
    }

    // #[Computed()]
    // public function users()
    // {
    //     return User::all(['id', 'name']);
    // }

    // public function save()
    // {
    //     $this->ticket->fill([
    //         'status',
    //         'solution',
    //         'finished_at',
    //     ]);
    // }

    public function render()
    {
        return view('livewire.admin.ticket.show',[
            'users' => User::all(['id', 'name'])
        ]);
    }
}
