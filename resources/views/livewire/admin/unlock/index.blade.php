<div>
    <x-header title="Desbloqueios" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Buscar..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" badge="0" responsive icon="o-funnel" />
            <x-button label="Cadastrar" class="btn-primary" icon="o-plus" :link="route('unlocks.create')" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$this->unlocks" with-pagination>
        </x-table>

    </x-card>
</div>
