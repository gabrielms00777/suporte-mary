<div>
    <x-header title="Tickets" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Buscar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" badge="0" responsive icon="o-funnel" />
            <x-button label="Cadastrar" class="btn-primary" icon="o-plus" :link="route('ticket.create')" />
            <x-button label="Deletar" class="btn-error" icon="o-trash" :link="route('ticket.create')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$this->rows" expandable with-pagination wire:model="expanded"
            @row-selection="console.log($event.detail)">

            @scope('expansion', $ticket)
                {{-- @dump($ticket) --}}
                <div class="grid grid-cols-2 p-4 font-bold bg-base-200">
                    <ul>
                        <li>CNPJ: {{ $ticket->client->cpf_cnpj }}</li>
                        <li>Telefone: {{ $ticket->client_phone }}</li>
                        <li>Motivo: {{ $ticket->reported_issue }}</li>
                    </ul>
                    <ul>
                        <li>Tecnico: {{ $ticket->finishedBy->name ?? '' }}</li>
                        <li>Finalizado: {{ $ticket->finished }}</li>
                        <li>Solução: {{ $ticket->solution }}</li>


                    </ul>
                </div>
            @endscope

            @scope('cell_status', $ticket)
                @if ($ticket->status == 'open')
                    <x-badge value="Aberto" class="badge-primary" />
                @elseif ($ticket->status == 'in_progress')
                    <x-badge value="Em Progresso" class="badge-warning" />
                @elseif ($ticket->status == 'finished')
                    <x-badge value="Finalizado" class="badge-success" />
                @elseif ($ticket->status == 'scheduled')
                    <x-badge value="Finalizado" class="badge-info" />
                @else
                    <x-badge value="Error" class="badge-error" />
                @endif
            @endscope

            @scope('actions', $ticket)
                <div class="flex gap-1">
                    @if (!$ticket->finished)
                        @if ($ticket->created_by && $ticket->status == 'in_progress')
                            <x-button icon="o-pause" wire:click="stop({{ $ticket->id }})" spinner
                                class="text-black bg-yellow-500 btn-sm hover:bg-yellow-600" />
                            <x-button icon="o-check" onclick="modal_{{ $ticket->id }}.showModal()" spinner
                                class="text-black bg-yellow-500 btn-sm hover:bg-yellow-600" />

                            <x-modal id="modal_{{ $ticket->id }}" title="Solução">
                                <x-textarea label="Solução" wire:model="solution" placeholder="Descreva o que voçê fez..."
                                    rows="5" />

                                <x-slot:actions>
                                    {{-- Notice `onclick` is HTML --}}
                                    <x-button label="Cancel" onclick="modal_{{ $ticket->id }}.close()" />
                                    <x-button label="Confirm" wire:click="finish({{ $ticket->id }})"
                                        class="btn-primary" />
                                </x-slot:actions>
                            </x-modal>
                        @else
                            <x-button icon="o-play" wire:click="start({{ $ticket->id }})" spinner
                                class="text-black bg-green-500 btn-sm hover:bg-green-600" />
                        @endif
                    @endif

                    <x-button icon="o-pencil-square" wire:click="delete({{ $ticket->id }})" spinner
                        class="text-black bg-blue-500 btn-sm hover:bg-blue-600" />
                    <x-button icon="o-trash" wire:click="delete({{ $ticket->id }})"
                        wire:confirm="Tem certeza que deletar esse chamado?" spinner
                        class="text-black bg-red-500 btn-sm hover:bg-red-600" />


                </div>
            @endscope
        </x-table>

    </x-card>
    <x-button icon="o-pencil-square" wire:click="test" spinner
        class="text-black bg-blue-500 btn-sm hover:bg-blue-600" />
</div>
