<x-layouts::app :title="$inventario->nombre">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('inventarios.index') }}" wire:navigate>Inventarios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $inventario->codigo }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-start justify-between">
        <div>
            <flux:heading size="xl">{{ $inventario->nombre }}</flux:heading>
            <flux:subheading>
                <span class="font-mono">{{ $inventario->codigo }}</span> ·
                <flux:badge size="sm">{{ str_replace('_', ' ', ucfirst($inventario->tipo)) }}</flux:badge> ·
                <flux:badge size="sm">{{ str_replace('_', ' ', ucfirst($inventario->estado)) }}</flux:badge>
            </flux:subheading>
        </div>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Detalles</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Órgano</dt><dd>{{ $inventario->organo->nombre ?? '-' }}</dd></div>
                <div class="flex justify-between"><dt>Alcance</dt><dd>{{ str_replace('_', ' ', ucfirst($inventario->alcance)) }}</dd></div>
                <div class="flex justify-between"><dt>Fecha Inicio</dt><dd>{{ $inventario->fecha_inicio->format('d/m/Y') }}</dd></div>
                <div class="flex justify-between"><dt>Fecha Fin</dt><dd>{{ $inventario->fecha_fin?->format('d/m/Y') ?? 'Pendiente' }}</dd></div>
            </dl>
        </div>
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Resultados</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Esperados</dt><dd class="font-mono">{{ $inventario->total_bienes_esperados }}</dd></div>
                <div class="flex justify-between"><dt>Contados</dt><dd class="font-mono">{{ $inventario->total_bienes_contados }}</dd></div>
                <div class="flex justify-between"><dt>Conciliados</dt><dd class="font-mono">{{ $inventario->total_conciliados }}</dd></div>
                <div class="flex justify-between"><dt>Diferencias</dt><dd class="font-mono {{ $inventario->total_diferencias > 0 ? 'text-red-500' : '' }}">{{ $inventario->total_diferencias }}</dd></div>
            </dl>
        </div>
    </div>
</x-layouts::app>
