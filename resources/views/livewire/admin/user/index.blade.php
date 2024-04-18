<div>
    <x-header title="Usuarios" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Buscar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" badge="0" responsive icon="o-funnel" />
            <x-button label="Cadastrar" class="btn-primary" icon="o-plus" :link="route('users.create')" />
            <x-button label="Deletar" class="btn-error" icon="o-trash" :link="route('users.create')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$this->users" with-pagination>
            @scope('cell_roles', $roles)
                {{-- @dump($roles->roles()->first()->name) --}}
                @foreach ($roles->roles as $role)
                    {{-- {{ $role->name }} --}}
                    <x-badge :value="$role->name" class="badge-primary" />
                @endforeach
            @endscope
        </x-table>

    </x-card>
</div>
