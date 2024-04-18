<?php

namespace App\Livewire\Admin\Ticket;

use App\Events\TicketEditedEvent;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Mary\Traits\Toast;

class Show extends Component
{
    use Toast;

    public Ticket $ticket;

    public array $statusOptions = [
        ['key' => 'open', 'value' => 'Aberto'],
        ['key' => 'in_progress', 'value' => 'Em Andamento'],
        ['key' => 'finished', 'value' => 'Finalizado'],
        ['key' => 'scheduled', 'value' => 'Agendado'],
    ];

    // public int $user_id;
    public int $finished_by;
    public string $status;
    public string $solution;
    public string $observation;

    public function mount()
    {
        $this->ticket->load(['client', 'finishedBy', 'createdBy']);
        // dd($this->ticket);
        $this->finished_by = $this->ticket->finished_by ?? 0;
        $this->status = $this->ticket->status;
        $this->solution = $this->ticket->solution ?? '';
        $this->observation = $this->ticket->observation ?? '';
    }

    public function save()
    {
        broadcast(new TicketEditedEvent)->toOthers();
        $this->ticket->update($this->all());
        $this->success('Ticket atualizado com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin.ticket.show',[
            'users' => User::all(['id', 'name'])
        ]);
    }
}
