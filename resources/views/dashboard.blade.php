<x-layouts::app :title="__('Dashboard')">
    @php
        $totalBienes = \App\Models\Bien::count();
        $totalOrganos = \App\Models\Organo::count();
        $totalCustodios = \App\Models\Custodio::count();
        $totalUbicaciones = \App\Models\Ubicacion::count();
        $totalOperativos = \App\Models\Bien::where('condicion_uso', 'operativo')->count();
        $totalInoperativos = \App\Models\Bien::where('condicion_uso', 'inoperativo')->count();
        $totalBajas = \App\Models\Bien::where('condicion_uso', 'dado_baja')->count();
        $valorTotal = \App\Models\Bien::sum('valor_actual');
        $ultimosBienes = \App\Models\Bien::latest()->take(5)->get();
    @endphp

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        {{-- KPI Cards --}}
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <flux:card class="p-4">
                <flux:heading size="sm" class="text-neutral-500">Bienes Registrados</flux:heading>
                <p class="mt-1 text-3xl font-bold">{{ number_format($totalBienes) }}</p>
                <flux:text class="text-xs">{{ $totalOperativos }} operativos · {{ $totalInoperativos }} inoperativos</flux:text>
            </flux:card>
            <flux:card class="p-4">
                <flux:heading size="sm" class="text-neutral-500">Órganos</flux:heading>
                <p class="mt-1 text-3xl font-bold">{{ number_format($totalOrganos) }}</p>
                <flux:text class="text-xs">Entidades registradas en el sistema</flux:text>
            </flux:card>
            <flux:card class="p-4">
                <flux:heading size="sm" class="text-neutral-500">Custodios</flux:heading>
                <p class="mt-1 text-3xl font-bold">{{ number_format($totalCustodios) }}</p>
                <flux:text class="text-xs">Responsables de bienes asignados</flux:text>
            </flux:card>
            <flux:card class="p-4">
                <flux:heading size="sm" class="text-neutral-500">Valor Total</flux:heading>
                <p class="mt-1 text-3xl font-bold text-green-600">${{ number_format($valorTotal, 2) }}</p>
                <flux:text class="text-xs">Valor actual del inventario nacional</flux:text>
            </flux:card>
        </div>

        {{-- Estado de bienes --}}
        <div class="grid gap-6 md:grid-cols-2">
            <flux:card class="p-4">
                <flux:heading>Estado de los Bienes</flux:heading>
                <flux:subheading class="mb-4">Distribución por condición de uso</flux:subheading>
                <div class="space-y-3">
                    <div>
                        <div class="mb-1 flex justify-between text-sm">
                            <span>🟢 Operativos</span>
                            <span class="font-mono">{{ $totalOperativos }} ({{ $totalBienes > 0 ? round(($totalOperativos/$totalBienes)*100) : 0 }}%)</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-neutral-200 dark:bg-neutral-700">
                            <div class="h-full rounded-full bg-green-500" style="width: {{ $totalBienes > 0 ? ($totalOperativos/$totalBienes)*100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-1 flex justify-between text-sm">
                            <span>🔴 Inoperativos</span>
                            <span class="font-mono">{{ $totalInoperativos }} ({{ $totalBienes > 0 ? round(($totalInoperativos/$totalBienes)*100) : 0 }}%)</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-neutral-200 dark:bg-neutral-700">
                            <div class="h-full rounded-full bg-red-500" style="width: {{ $totalBienes > 0 ? ($totalInoperativos/$totalBienes)*100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-1 flex justify-between text-sm">
                            <span>⚫ Dados de Baja</span>
                            <span class="font-mono">{{ $totalBajas }}</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded-full bg-neutral-200 dark:bg-neutral-700">
                            <div class="h-full rounded-full bg-neutral-500" style="width: {{ $totalBienes > 0 ? ($totalBajas/$totalBienes)*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </flux:card>

            {{-- Últimos registros --}}
            <flux:card class="p-4">
                <flux:heading>Últimos Bienes Registrados</flux:heading>
                <flux:subheading class="mb-4">Actividad reciente en el inventario</flux:subheading>
                <div class="space-y-3">
                    @foreach($ultimosBienes as $bien)
                    <div class="flex items-center justify-between border-b border-neutral-100 pb-2 text-sm dark:border-neutral-800">
                        <div>
                            <a href="{{ route('bienes.show', $bien) }}" class="font-medium hover:underline" wire:navigate>
                                {{ $bien->nombre }}
                            </a>
                            <p class="text-xs text-neutral-500 font-mono">{{ $bien->codigo_patrimonial }}</p>
                        </div>
                        <flux:badge size="sm" color="{{ $bien->condicion_uso === 'operativo' ? 'green' : 'red' }}">
                            {{ str_replace('_', ' ', ucfirst($bien->condicion_uso)) }}
                        </flux:badge>
                    </div>
                    @endforeach
                </div>
            </flux:card>
        </div>
    </div>
</x-layouts::app>
