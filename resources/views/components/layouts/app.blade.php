<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('build/assets/app-DWadOepi.css') }}">
    <script src="{{ asset('build/assets/app-DWXbm8-o.js') }}" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="mr-3 lg:hidden">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-5 pt-3" />

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if ($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                        class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                                no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Hello" icon="o-home" link="/" />
                <x-menu-sub title="Tickets" icon="o-ticket">
                    <x-menu-item title="Listar" icon="o-list-bullet" wire:navigate :link="route('ticket.index')" />
                    <x-menu-item title="Adicionar" icon="o-plus-circle" wire:navigate :link="route('ticket.create')" />
                </x-menu-sub>
                <x-menu-sub title="Usuarios" icon="o-users">
                    <x-menu-item title="Listar" icon="o-list-bullet" wire:navigate :link="route('users.index')" />
                    <x-menu-item title="Adicionar" icon="o-plus-circle" wire:navigate :link="route('users.create')" />
                </x-menu-sub>
                <x-menu-sub title="Desbloqueios" icon="o-lock-closed">
                    <x-menu-item title="Listar" icon="o-list-bullet" wire:navigate :link="route('unlocks.index')" />
                    <x-menu-item title="Adicionar" icon="o-plus-circle" wire:navigate :link="route('unlocks.create')" />
                </x-menu-sub>
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</body>

</html>
