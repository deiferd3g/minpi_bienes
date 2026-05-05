<x-layouts::app :title="__('Custodios')">
    <flux:heading size="xl">Custodios</flux:heading>
    <flux:subheading>Personas responsables de los bienes nacionales asignados.</flux:subheading>

    <div class="mt-6 flex items-center justify-between">
        <flux:input icon="magnifying-glass" placeholder="Buscar custodio por cédula o nombre..." class="max-w-sm" />
        <flux:button href="{{ route('custodios.create') }}" wire:navigate>+ Nuevo Custodio</flux:button>
    </div>

    <div class="mt-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Cédula</th>
                    <th class="px-4 py-3 font-medium">Nombres</th>
                    <th class="px-4 py-3 font-medium">Apellidos</th>
                    <th class="px-4 py-3 font-medium">Cargo</th>
                    <th class="px-4 py-3 font-medium">Órgano</th>
                    <th class="px-4 py-3 font-medium">Tipo</th>
                    <th class="px-4 py-3 font-medium">Bienes</th>
                    <th class="px-4 py-3 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Custodio::with('organo')->get() as $custodio)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $custodio->cedula }}</td>
                    <td class="px-4 py-3 font-medium">{{ $custodio->nombres }}</td>
                    <td class="px-4 py-3">{{ $custodio->apellidos }}</td>
                    <td class="px-4 py-3 text-xs">{{ $custodio->cargo }}</td>
                    <td class="px-4 py-3 text-xs">{{ $custodio->organo->siglas ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm">{{ ucfirst($custodio->tipo) }}</flux:badge>
                    </td>
                    <td class="px-4 py-3 font-mono text-xs">{{ $custodio->bienes->count() }}</td>
                    <td class="px-4 py-3">
                        <flux:button href="{{ route('custodios.show', $custodio) }}" size="sm" wire:navigate>Ver</flux:button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
