<?php

namespace App\Livewire\Admin\Ticket;

use App\Events\TicketEditedEvent;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Index extends Component
{
    use WithPagination, Toast;

    // public array $sortBy = ['column' => 'id', 'direction' => 'desc'];

    public array $expanded = [];

    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'created_at', 'label' => 'Data'],
        ['key' => 'client.business_name', 'label' => 'Empresa'],
        ['key' => 'client.contact_person', 'label' => 'Contato'],
        ['key' => 'client.contract', 'label' => 'Contrato'],
        ['key' => 'status', 'label' => 'Status'],
        ['key' => 'finishedBy.name', 'label' => 'Tecnico']
    ];

    public string $solution;

    public function start(Ticket $ticket)
    {
        broadcast(new TicketEditedEvent)->toOthers();
        $ticket->update([
            'finished_by' => Auth::user()->id,
            'status' => 'in_progress'
        ]);
        $this->dispatch('start::ticket');
    }

    public function finish(Ticket $ticket)
    {
        broadcast(new TicketEditedEvent)->toOthers();
        $ticket->update([
            'solution' => $this->solution,
            'status' => 'finished',
            'finished_at' => now()
        ]);
        $this->dispatch('finish::ticket');
    }

    public function stop(Ticket $ticket)
    {
        broadcast(new TicketEditedEvent)->toOthers();
        $ticket->update([
            'finished_by' => null,
            'solution' => null,
            'status' => 'open',
            'finished' => false
        ]);
        $this->dispatch('stop::ticket');
    }

    public function delete(Ticket $ticket)
    {
        broadcast(new TicketEditedEvent)->toOthers();
        $ticket->delete();
        $this->dispatch('deleted::ticket');
    }

    #[On('echo:tickets,TicketCreatedEvent')]
    public function ticketCreatedEvent()
    {
        $this->warning('Chamado novo criado!');
        $this->rows();
    }

    #[On('echo:tickets,TicketEditedEvent')]
    public function ticketEditedEvent()
    {
        $this->warning('Um chamado foi editado editado!');
        $this->rows();
    }

    #[On('start::ticket')]
    #[On('stop::ticket')]
    #[On('finish::ticket')]
    #[On('deleted::ticket')]
    #[Computed()]
    public function rows()
    {
        return Ticket::query()
                        ->with(['client', 'finishedBy'])
                        // ->orderBy(...array_values($this->sortBy))
                        // ->whereDate('created_at', Carbon::now())
                        // ->orderBy('status', 'desc')
                        // ->orderBy('scheduling_date')
                        ->latest()
                        ->paginate(10);
    }

    public function render()
    {
        return view('livewire.admin.ticket.index');
    }
}
