<div>
    <x-header title="Ticket #{{ $ticket->id }}" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Buscar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" badge="0" responsive icon="o-funnel" />
            <x-button label="Cadastrar" class="btn-primary" icon="o-plus" :link="route('ticket.create')" />
            <x-button label="Deletar" class="btn-error" icon="o-trash" :link="route('ticket.create')" />
        </x-slot:actions>
    </x-header>

    <x-card header="Detalhe do Ticket #{{ $ticket->id }}">
        <div class="mb-8 grid grid-cols-2">
            <div>
                <h2 class="text-xl font-semibold mb-2">Empresa:</h2>
                <p class=" mb-4">#{{ $ticket->client->business_name }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">CNPJ:</h2>
                <p class=" mb-4">#{{ $ticket->client->cpf_cnpj }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Status:</h2>
                <p class=" mb-4">{{ $ticket->status }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Descrição:</h2>
                <p class=" mb-4">{{ $ticket->reported_issue }}
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Data de Abertura:</h2>
                <p class=" mb-4">{{ $ticket->created_at }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Data de Finalização:</h2>
                <p class=" mb-4">{{ $ticket->finished_at }}</p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Tecnico:</h2>
                <p class=" mb-4">{{ $ticket->finishedBy->name ?? '' }}</p>

            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2">Solução:</h2>
                <p class=" mb-4">{{ $ticket->solution }}</p>
            </div>
            <div class="col-span-2">
                <h2 class="text-xl font-semibold mb-2">Observação:</h2>
                <p class=" mb-4">{{ $ticket->observation }}</p>
            </div>
        </div>

        <x-collapse>
            <x-slot:heading>
                Editar Informações
            </x-slot:heading>
            <x-slot:content>
                <x-form wire:submit="save">
                    <x-textarea wire:model="observation" label="Observação" />
                    <x-choices label="Tecnico" placeholder-value="{{ $finished_by }}" wire:model="finished_by"
                        :options="$users" single />
                    <x-choices label="Status" wire:model="status" :options="$statusOptions" option-value="key"
                        option-label="value" single />
                    <x-textarea wire:model="solution" label="Solução" />
                    <x-slot:actions>
                        <x-button label="Voltar" :link="route('ticket.index')" />
                        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
                    </x-slot:actions>
                </x-form>
            </x-slot:content>
        </x-collapse>
    </x-card>
</div>
