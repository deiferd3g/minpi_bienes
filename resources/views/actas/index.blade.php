<x-layouts::app :title="__('Actas')">
    <flux:heading size="xl">Actas</flux:heading>
    <flux:subheading>Documentos oficiales de recepción, entrega, transferencia y custodia de bienes.</flux:subheading>

    <div class="mt-6 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Código</th>
                    <th class="px-4 py-3 font-medium">Título</th>
                    <th class="px-4 py-3 font-medium">Tipo</th>
                    <th class="px-4 py-3 font-medium">Órgano</th>
                    <th class="px-4 py-3 font-medium">Fecha</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Acta::with('organo')->latest()->get() as $acta)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $acta->codigo }}</td>
                    <td class="px-4 py-3 font-medium">{{ $acta->titulo }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm">{{ str_replace('_', ' ', ucfirst($acta->tipo)) }}</flux:badge>
                    </td>
                    <td class="px-4 py-3 text-xs">{{ $acta->organo->siglas ?? '-' }}</td>
                    <td class="px-4 py-3 text-xs">{{ $acta->fecha_emision->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm" color="{{ match($acta->estado) {
                            'borrador' => 'yellow',
                            'emitido' => 'blue',
                            'firmado' => 'green',
                            'anulado' => 'red',
                            'archivado' => 'neutral',
                            default => 'neutral',
                        } }}">{{ ucfirst($acta->estado) }}</flux:badge>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
