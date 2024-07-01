<?php

namespace App\Livewire\Admin\Ticket;

use App\Events\TicketCreatedEvent;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use Toast;
    public ?int $client_id = null;

    public ?int $contact_id = null;

    public ?Client $client;
    public ?Contact $contact;

    #[Validate(['required', 'string'])]
    public string $business_name;
    #[Validate(['required', 'string'])]
    public string $cpf_cnpj;
    #[Validate(['required', 'string'])]
    public string $client_name;
    #[Validate(['required', 'string'])]
    public string $client_phone;
    // #[Validate(['required', 'string'])]
    public bool $contract;
    #[Validate(['required', 'string'])]
    public string $reported_issue;
    #[Validate(['required', 'string'])]
    public string $system;

    // #[Validate(['nullable', 'string'])]
    // public string $scheduling_date;

    public function updatedClientId()
    {
        $this->contact_id = null;
        $this->client_name = '';
        $this->client_phone = '';

        $this->client = Client::find($this->client_id)->load('contacts');
        // dd($this->client);
        $this->business_name = $this->client->business_name ?? '';
        $this->cpf_cnpj = $this->client->cpf_cnpj ?? '';
        $this->contract = $this->client->contract;
        $this->system = $this->client->system;
    }

    public function updatedContactId()
    {
        $this->contact = Contact::query()->find($this->contact_id);
        // dd($this->contact);
        $this->client_name = $this->contact->name ?? '';
        $this->client_phone = $this->contact->phone ?? '';
    }

    public function save()
    {
        $this->validate();
        // dd($this->all());

        try {
            if($this->client_id){
                $this->client->fill($this->only(['business_name', 'cpf_cnpj', 'contract', 'system']))->save();
            }else{
                $this->client = Client::query()->create($this->only(['business_name', 'cpf_cnpj', 'contract', 'system']));
                $this->client_id = $this->client->id;
            }

            if($this->contact_id){
                $this->contact->fill([
                    'name' => $this->client_name,
                    'phone' => $this->client_phone,
                ])->save();
            }else{
                $this->contact = Contact::query()->create([
                    'client_id' => $this->client_id,
                    'name' => $this->client_name,
                    'phone' => $this->client_phone,
                ]);
                $this->contact_id = $this->contact->id;
            }

            Ticket::create(array_merge(
                // $this->only(['client_id', 'reported_issue', 'client_name', 'client_phone', 'scheduling_date']),
                $this->only(['client_id', 'reported_issue', 'client_name', 'client_phone']),
                 ['created_by' => Auth::user()->id]
            ));
            broadcast(new TicketCreatedEvent)->toOthers();
            // TicketCreatedEvent::dispatch();
            $this->success('ticket criado com sucesso!!!', redirectTo:route('ticket.index'));
        } catch (\Exception $e) {
            $this->error($e->getMessage())->send();
        }
    }

    #[Computed()]
    public function contacts()
    {
        return Contact::query()->where('client_id', $this->client->id ?? 0)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.ticket.create',[
            'clients' => Client::query()->get()
        ]);
    }
}
