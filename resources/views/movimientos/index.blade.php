<x-layouts::app :title="__('Movimientos')">
    <flux:heading size="xl">Movimientos de Bienes</flux:heading>
    <flux:subheading>Registro de transferencias, reubicaciones y cambios de custodio.</flux:subheading>

    <div class="mt-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Código</th>
                    <th class="px-4 py-3 font-medium">Bien</th>
                    <th class="px-4 py-3 font-medium">Tipo</th>
                    <th class="px-4 py-3 font-medium">Origen</th>
                    <th class="px-4 py-3 font-medium">Destino</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                    <th class="px-4 py-3 font-medium">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Movimiento::with('bien', 'organoOrigen', 'organoDestino')->latest()->get() as $mov)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $mov->codigo }}</td>
                    <td class="px-4 py-3 text-xs">{{ $mov->bien->codigo_patrimonial ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm">{{ str_replace('_', ' ', ucfirst($mov->tipo)) }}</flux:badge>
                    </td>
                    <td class="px-4 py-3 text-xs">{{ $mov->organoOrigen->siglas ?? '-' }}</td>
                    <td class="px-4 py-3 text-xs">{{ $mov->organoDestino->siglas ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm" color="{{ match($mov->estado) {
                            'pendiente' => 'orange',
                            'aprobado' => 'blue',
                            'ejecutado' => 'green',
                            'rechazado', 'anulado' => 'red',
                            default => 'neutral',
                        } }}">{{ ucfirst($mov->estado) }}</flux:badge>
                    </td>
                    <td class="px-4 py-3 text-xs">{{ $mov->fecha_solicitud->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
