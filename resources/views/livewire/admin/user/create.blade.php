<div>
    <x-header title="Cadastrar Usuario" separator progress-indicator />

    <x-card title="Cadastrar Usuario">
        <x-form wire:submit="save">
            <div class="grid grid-cols-1 my-3 gap-6 sm:grid-cols-3 ">
                <x-input label="Nome" wire:model="name" />
                <x-input wire:model='email' class="" label="Email" />
                <x-choices label="Tipo" wire:model="role" :options="$this->roles" single />
                <x-input wire:model='password' type="password" class="" label="Senha" />
                <x-input wire:model='password_confirmation' type="password" class="" label="Confirmar Senha" />
            </div>

            <x-slot:actions>
                <x-button label="Cancel" :link="route('ticket.index')" />
                <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
