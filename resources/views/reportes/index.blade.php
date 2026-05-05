<x-layouts::app :title="__('Reportes')">
    <flux:heading size="xl">Reportes</flux:heading>
    <flux:subheading>Indicadores y estadísticas del Sistema de Control de Bienes Nacionales.</flux:subheading>

    @php
        $totalBienes = \App\Models\Bien::count();
        $totalOrganos = \App\Models\Organo::count();
        $totalCustodios = \App\Models\Custodio::count();
        $totalInoperativos = \App\Models\Bien::where('condicion_uso', '!=', 'operativo')->count();
        $valorTotal = \App\Models\Bien::sum('valor_actual');
        $bienesPorEstado = \App\Models\Bien::selectRaw("estado_fisico, count(*) as total")->groupBy('estado_fisico')->pluck('total', 'estado_fisico');
    @endphp

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <p class="text-xs uppercase tracking-wider text-neutral-500">Total Bienes</p>
            <p class="mt-1 text-3xl font-bold">{{ number_format($totalBienes) }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <p class="text-xs uppercase tracking-wider text-neutral-500">Órganos</p>
            <p class="mt-1 text-3xl font-bold">{{ number_format($totalOrganos) }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <p class="text-xs uppercase tracking-wider text-neutral-500">Custodios</p>
            <p class="mt-1 text-3xl font-bold">{{ number_format($totalCustodios) }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <p class="text-xs uppercase tracking-wider text-neutral-500">Inoperativos</p>
            <p class="mt-1 text-3xl font-bold text-red-500">{{ number_format($totalInoperativos) }}</p>
        </div>
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700 sm:col-span-2">
            <p class="text-xs uppercase tracking-wider text-neutral-500">Valor Total del Inventario</p>
            <p class="mt-1 text-3xl font-bold text-green-600">${{ number_format($valorTotal, 2) }}</p>
        </div>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Bienes por Estado Físico</h3>
            @foreach($bienesPorEstado as $estado => $cantidad)
            <div class="mb-2 flex items-center justify-between text-sm">
                <span>{{ ucfirst($estado) }}</span>
                <span class="font-mono">{{ $cantidad }}</span>
            </div>
            <div class="mb-3 h-2 w-full overflow-hidden rounded-full bg-neutral-200 dark:bg-neutral-700">
                <div class="h-full rounded-full bg-blue-500" style="width: {{ $totalBienes > 0 ? ($cantidad / $totalBienes) * 100 : 0 }}%"></div>
            </div>
            @endforeach
        </div>

        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Acciones Rápidas</h3>
            <div class="space-y-2">
                <flux:button href="{{ route('bienes.create') }}" wire:navigate class="w-full justify-start">Registrar Bien</flux:button>
                <flux:button href="{{ route('inventarios.create') }}" wire:navigate class="w-full justify-start">Iniciar Inventario</flux:button>
                <flux:button href="{{ route('organos.create') }}" wire:navigate class="w-full justify-start">Nuevo Órgano</flux:button>
                <flux:button href="{{ route('custodios.create') }}" wire:navigate class="w-full justify-start">Registrar Custodio</flux:button>
            </div>
        </div>
    </div>
</x-layouts::app>
