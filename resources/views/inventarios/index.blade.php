<x-layouts::app :title="__('Inventarios')">
    <flux:heading size="xl">Inventarios</flux:heading>
    <flux:subheading>Tomas físicas programadas y extraordinarias de bienes nacionales.</flux:subheading>

    <div class="mt-6 flex items-center justify-between">
        <flux:input icon="magnifying-glass" placeholder="Buscar inventario..." class="max-w-sm" />
        <flux:button href="{{ route('inventarios.create') }}" wire:navigate>+ Nuevo Inventario</flux:button>
    </div>

    <div class="mt-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Código</th>
                    <th class="px-4 py-3 font-medium">Nombre</th>
                    <th class="px-4 py-3 font-medium">Tipo</th>
                    <th class="px-4 py-3 font-medium">Órgano</th>
                    <th class="px-4 py-3 font-medium">Esperados</th>
                    <th class="px-4 py-3 font-medium">Contados</th>
                    <th class="px-4 py-3 font-medium">Diferencias</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Inventario::with('organo')->latest()->get() as $inv)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $inv->codigo }}</td>
                    <td class="px-4 py-3 font-medium">{{ $inv->nombre }}</td>
                    <td class="px-4 py-3 text-xs">{{ str_replace('_', ' ', ucfirst($inv->tipo)) }}</td>
                    <td class="px-4 py-3 text-xs">{{ $inv->organo->siglas ?? '-' }}</td>
                    <td class="px-4 py-3 font-mono text-xs">{{ $inv->total_bienes_esperados }}</td>
                    <td class="px-4 py-3 font-mono text-xs">{{ $inv->total_bienes_contados }}</td>
                    <td class="px-4 py-3 font-mono text-xs {{ $inv->total_diferencias > 0 ? 'text-red-500' : '' }}">{{ $inv->total_diferencias }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm" color="{{ match($inv->estado) {
                            'planificado' => 'blue',
                            'en_curso' => 'orange',
                            'conciliacion' => 'yellow',
                            'finalizado' => 'green',
                            'anulado' => 'red',
                            default => 'neutral',
                        } }}">{{ str_replace('_', ' ', ucfirst($inv->estado)) }}</flux:badge>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
