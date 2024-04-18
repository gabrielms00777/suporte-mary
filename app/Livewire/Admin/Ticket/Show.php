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
        if($this->status != $this->ticket->status){
            switch ($this->status) {
                case 'open':
                    $this->ticket->update([
                        'finished_by' => null,
                        'solution' => null,
                        'status' => 'open',
                        'finished_at' => null
                    ]);
                    break;
                case 'finished':
                    $this->validate([
                        'finished_by' => 'required',
                        'solution' => 'required',
                    ]);
                    $this->ticket->update([
                        'solution' => $this->solution,
                        'status' => 'finished',
                        'finished_at' => now(),
                        'finished_by' => $this->finished_by
                    ]);
                    break;
                case 'in_progress':
                    $this->validate([
                        'finished_by' => 'required',
                    ]);
                    $this->ticket->update([
                        'solution' => null,
                        'status' => 'in_progress',
                        'finished_at' => null,
                        'finished_by' => $this->finished_by
                    ]);
                    break;
                case 'scheduled':
                    break;
                default:
                    # code...
                    break;
            }
        }else{
            $this->ticket->update($this->all());
        }
        broadcast(new TicketEditedEvent)->toOthers();
        $this->success('Ticket atualizado com sucesso!');
        $this->finished_by = $this->ticket->finished_by ?? 0;
        $this->status = $this->ticket->status;
        $this->solution = $this->ticket->solution ?? '';
        $this->observation = $this->ticket->observation ?? '';
    }

    public function render()
    {
        return view('livewire.admin.ticket.show',[
            'users' => User::all(['id', 'name'])
        ]);
    }
}
