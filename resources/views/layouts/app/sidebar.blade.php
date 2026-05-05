<flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.header>
        <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
        <flux:sidebar.collapse class="lg:hidden" />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.group :heading="__('Bienes Nacionales')" class="grid">
            <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="building-library" :href="route('organos.index')" :current="request()->routeIs('organos.*')" wire:navigate>
                {{ __('Órganos') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="computer-desktop" :href="route('bienes.index')" :current="request()->routeIs('bienes.*')" wire:navigate>
                {{ __('Bienes') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="user" :href="route('custodios.index')" :current="request()->routeIs('custodios.*')" wire:navigate>
                {{ __('Custodios') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="map-pin" :href="route('ubicaciones.index')" :current="request()->routeIs('ubicaciones.*')" wire:navigate>
                {{ __('Ubicaciones') }}
            </flux:sidebar.item>
        </flux:sidebar.group>

        <flux:sidebar.group :heading="__('Gestión')" class="grid">
            <flux:sidebar.item icon="arrows-right-left" :href="route('movimientos.index')" :current="request()->routeIs('movimientos.*')" wire:navigate>
                {{ __('Movimientos') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="clipboard-document-list" :href="route('inventarios.index')" :current="request()->routeIs('inventarios.*')" wire:navigate>
                {{ __('Inventarios') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="document-text" :href="route('actas.index')" :current="request()->routeIs('actas.*')" wire:navigate>
                {{ __('Actas') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="chart-bar" :href="route('reportes.index')" :current="request()->routeIs('reportes.*')" wire:navigate>
                {{ __('Reportes') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>

    <flux:spacer />

    <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
</flux:sidebar>

<!-- Mobile User Menu -->
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:spacer />
    <flux:dropdown position="top" align="end">
        <flux:profile
            :initials="auth()->user()->initials()"
            icon-trailing="chevron-down"
        />
        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                            <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>
            <flux:menu.separator />
            <flux:menu.radio.group>
                <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                    {{ __('Settings') }}
                </flux:menu.item>
            </flux:menu.radio.group>
            <flux:menu.separator />
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button" type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer"
                >
                    {{ __('Log out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

{{ $slot }}

@persist('toast')
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
@endpersist

@fluxScripts
