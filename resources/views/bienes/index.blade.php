<x-layouts::app :title="__('Bienes Nacionales')">
    <flux:heading size="xl">Bienes Nacionales</flux:heading>
    <flux:subheading>Inventario nacional de bienes públicos. Total: {{ \App\Models\Bien::count() }} registros.</flux:subheading>

    <div class="mt-6 flex items-center justify-between">
        <flux:input icon="magnifying-glass" placeholder="Buscar por código, nombre, serial..." class="max-w-md" />
        <flux:button href="{{ route('bienes.create') }}" wire:navigate>+ Nuevo Bien</flux:button>
    </div>

    <div class="mt-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Código Patrimonial</th>
                    <th class="px-4 py-3 font-medium">Nombre</th>
                    <th class="px-4 py-3 font-medium">Categoría</th>
                    <th class="px-4 py-3 font-medium">Órgano</th>
                    <th class="px-4 py-3 font-medium">Estado Físico</th>
                    <th class="px-4 py-3 font-medium">Condición</th>
                    <th class="px-4 py-3 font-medium">Valor Actual</th>
                    <th class="px-4 py-3 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Bien::with(['categoria', 'organo'])->latest()->get() as $bien)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $bien->codigo_patrimonial }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('bienes.show', $bien) }}" class="hover:underline font-medium" wire:navigate>
                            {{ $bien->nombre }}
                        </a>
                        @if($bien->serial)
                            <span class="ml-1 text-xs text-neutral-500">SN: {{ $bien->serial }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-xs">{{ $bien->categoria->nombre ?? '-' }}</td>
                    <td class="px-4 py-3 text-xs">{{ $bien->organo->siglas ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm" color="{{ match($bien->estado_fisico) {
                            'nuevo' => 'green',
                            'bueno' => 'emerald',
                            'regular' => 'orange',
                            'malo', 'obsoleto' => 'red',
                            'desincorporado' => 'neutral',
                            'robado' => 'red',
                            default => 'neutral',
                        } }}">{{ ucfirst($bien->estado_fisico) }}</flux:badge>
                    </td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm" color="{{ $bien->condicion_uso === 'operativo' ? 'green' : ($bien->condicion_uso === 'inoperativo' ? 'red' : 'orange') }}">
                            {{ str_replace('_', ' ', ucfirst($bien->condicion_uso)) }}
                        </flux:badge>
                    </td>
                    <td class="px-4 py-3 font-mono text-xs">${{ number_format($bien->valor_actual, 2) }}</td>
                    <td class="px-4 py-3">
                        <flux:button href="{{ route('bienes.edit', $bien) }}" size="sm" wire:navigate>Editar</flux:button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
