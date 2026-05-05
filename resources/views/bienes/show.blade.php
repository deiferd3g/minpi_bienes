<x-layouts::app :title="$bien->nombre">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('bienes.index') }}" wire:navigate>Bienes</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $bien->codigo_patrimonial }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-start justify-between">
        <div>
            <flux:heading size="xl">{{ $bien->nombre }}</flux:heading>
            <flux:subheading>
                <span class="font-mono">{{ $bien->codigo_patrimonial }}</span>
                @if($bien->codigo_interno) · <span class="font-mono">{{ $bien->codigo_interno }}</span> @endif
            </flux:subheading>
        </div>
        <flux:button href="{{ route('bienes.edit', $bien) }}" wire:navigate>Editar</flux:button>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Identificación</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Marca</dt><dd>{{ $bien->marca ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Modelo</dt><dd>{{ $bien->modelo ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Serial</dt><dd class="font-mono text-xs">{{ $bien->serial ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Color</dt><dd>{{ $bien->color ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Categoría</dt><dd>{{ $bien->categoria->nombre ?? '-' }}</dd></div>
                <div class="flex justify-between"><dt>Fabricante</dt><dd>{{ $bien->fabricante->nombre ?? '-' }}</dd></div>
            </dl>
        </div>

        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Ubicación y Custodia</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Órgano</dt><dd>{{ $bien->organo->nombre ?? '-' }}</dd></div>
                <div class="flex justify-between"><dt>Ubicación</dt><dd>{{ $bien->ubicacion->nombre ?? 'No asignada' }}</dd></div>
                <div class="flex justify-between"><dt>Custodio</dt><dd>{{ $bien->custodioActual->nombres ?? 'No asignado' }} {{ $bien->custodioActual->apellidos ?? '' }}</dd></div>
            </dl>
        </div>

        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Valores</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Valor Original</dt><dd class="font-mono">${{ number_format($bien->valor_original, 2) }}</dd></div>
                <div class="flex justify-between"><dt>Valor Actual</dt><dd class="font-mono font-semibold">${{ number_format($bien->valor_actual, 2) }}</dd></div>
                <div class="flex justify-between"><dt>Valor Residual</dt><dd class="font-mono">${{ number_format($bien->valor_residual, 2) }}</dd></div>
                <div class="flex justify-between"><dt>Depreciación</dt><dd class="font-mono text-red-500">-${{ number_format($bien->valor_original - $bien->valor_actual, 2) }}</dd></div>
            </dl>
        </div>

        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Adquisición</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Fecha Adquisición</dt><dd>{{ $bien->fecha_adquisicion?->format('d/m/Y') ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Documento</dt><dd>{{ $bien->documento_adquisicion ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Vida Útil</dt><dd>{{ $bien->vida_util_anios ?? 'N/A' }} años</dd></div>
                <div class="flex justify-between"><dt>Garantía</dt><dd>{{ $bien->fecha_vencimiento_garantia?->format('d/m/Y') ?? 'N/A' }}</dd></div>
            </dl>
        </div>

        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Estado</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt>Estado Físico</dt>
                    <dd><flux:badge size="sm">{{ ucfirst($bien->estado_fisico) }}</flux:badge></dd>
                </div>
                <div class="flex justify-between">
                    <dt>Condición</dt>
                    <dd><flux:badge size="sm">{{ str_replace('_', ' ', ucfirst($bien->condicion_uso)) }}</flux:badge></dd>
                </div>
            </dl>
        </div>

        @if($bien->observaciones)
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700 sm:col-span-2 lg:col-span-3">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Observaciones</h3>
            <p class="text-sm">{{ $bien->observaciones }}</p>
        </div>
        @endif
    </div>
</x-layouts::app>
