<x-layouts::app :title="$organo->nombre">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('organos.index') }}" wire:navigate>Órganos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $organo->codigo }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-start justify-between">
        <div>
            <flux:heading size="xl">{{ $organo->nombre }}</flux:heading>
            <flux:subheading>{{ $organo->siglas }} · {{ $organo->codigo }}</flux:subheading>
        </div>
        <flux:button href="{{ route('organos.edit', $organo) }}" wire:navigate>Editar</flux:button>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Información General</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>RIF</dt><dd class="font-mono">{{ $organo->rif ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Nivel</dt><dd><flux:badge size="sm">{{ ucfirst($organo->nivel) }}</flux:badge></dd></div>
                <div class="flex justify-between"><dt>Dirección</dt><dd class="text-right max-w-xs">{{ $organo->direccion ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Teléfono</dt><dd>{{ $organo->telefono ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Email</dt><dd>{{ $organo->email ?? 'N/A' }}</dd></div>
                <div class="flex justify-between">
                    <dt>Estado</dt>
                    <dd>@if($organo->activo) <flux:badge color="green" size="sm">Activo</flux:badge> @else <flux:badge color="red" size="sm">Inactivo</flux:badge> @endif</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Estadísticas</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Ubicaciones</dt><dd class="font-semibold">{{ $organo->ubicaciones->count() }}</dd></div>
                <div class="flex justify-between"><dt>Custodios</dt><dd class="font-semibold">{{ $organo->custodios->count() }}</dd></div>
                <div class="flex justify-between"><dt>Bienes Registrados</dt><dd class="font-semibold">{{ $organo->bienes->count() }}</dd></div>
                <div class="flex justify-between"><dt>Sub-órganos</dt><dd class="font-semibold">{{ $organo->hijos->count() }}</dd></div>
            </dl>
        </div>
    </div>
</x-layouts::app>
