<?php

namespace App\Livewire\Admin\Ticket;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;


class Index extends Component
{
    use WithPagination;

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
        // dd('oi');
        $ticket->update([
            'finished_by' => Auth::user()->id,
            'status' => 'in_progress'
        ]);
        $this->dispatch('start::ticket');
    }

    public function finish(Ticket $ticket)
    {
        // dd($this->solution);
        $ticket->update([
            'solution' => $this->solution,
            'status' => 'finished',
            'finished' => true
        ]);
        $this->dispatch('finish::ticket');
    }

    public function stop(Ticket $ticket)
    {
        $ticket->update([
            'finished_by' => null,
            'solution' => null,
            'status' => 'open',
            'finished' => false
        ]);
        $this->dispatch('stop::ticket');
    }

    #[On('start::ticket')]
    #[On('stop::ticket')]
    #[On('finish::ticket')]
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
