<?php

namespace App\Livewire\Admin\Ticket;

use App\Models\Ticket;
use Livewire\Component;

class Show extends Component
{
    public Ticket $ticket;

    public function render()
    {
        return view('livewire.admin.ticket.show');
    }
}
