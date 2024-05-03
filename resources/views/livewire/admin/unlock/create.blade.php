<div>
    <x-header title="Desbloqueio" separator progress-indicator />

    <x-card title="Desbloqueio">
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 my-4  gap-6 sm:grid-cols-2 ">
                <x-input wire:model='client_name' wire:loading.attr="disabled" class="" label="Contato *" />
                <x-input wire:model='client_phone' wire:loading.attr="disabled" class="" label="Telefone *" />
            </div>
            <x-choices-offline searchable label="Escolha a empresa..." wire:loading.attr="disabled"
                option-label="business_name" wire:model.live="client_id" :options="$clients" single />
            <x-input label="Empresa" wire:loading.attr="disabled" wire:model="business_name" />
            <div class="grid grid-cols-1 my-3 gap-6 sm:grid-cols-3 ">
                <x-input wire:model='cpf_cnpj' wire:loading.attr="disabled" class="" label="CNPJ/CPF" />
                <x-input wire:model='system' wire:loading.attr="disabled" class="" label="Sistema" />
                <x-radio label="Contrato" wire:loading.attr="disabled" :options="[['key' => 1, 'value' => 'Sim'], ['key' => 0, 'value' => 'Não']]" option-value="key"
                    option-label="value" wire:model="contract" />
            </div>
            <x-menu-separator />
            <x-choices-offline searchable label="Escolha um contato..." wire:loading.attr="disabled"
                wire:model.live="contact_id" :options="$this->contacts" single />

            <div class="grid grid-cols-1 my-4  gap-6 sm:grid-cols-2 ">
                <x-input wire:model='client_name' wire:loading.attr="disabled" class="" label="Contato *" />
                <x-input wire:model='client_phone' wire:loading.attr="disabled" class="" label="Telefone *" />
            </div>

            <x-slot:actions>
                <x-button label="Cancel" :link="route('ticket.index')" />
                <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
