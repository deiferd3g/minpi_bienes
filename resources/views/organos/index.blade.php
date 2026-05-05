<x-layouts::app :title="__('Órganos y Entidades')">
    <flux:heading size="xl">Órganos y Entidades</flux:heading>
    <flux:subheading>Gestión de ministerios, institutos y dependencias del sector público.</flux:subheading>

    <div class="mt-6 flex items-center justify-between">
        <flux:input icon="magnifying-glass" placeholder="Buscar órgano..." class="max-w-sm" />
        <flux:button href="{{ route('organos.create') }}" wire:navigate>+ Nuevo Órgano</flux:button>
    </div>

    <div class="mt-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Código</th>
                    <th class="px-4 py-3 font-medium">Nombre</th>
                    <th class="px-4 py-3 font-medium">Siglas</th>
                    <th class="px-4 py-3 font-medium">Nivel</th>
                    <th class="px-4 py-3 font-medium">RIF</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                    <th class="px-4 py-3 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Organo::with('padre')->get() as $organo)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $organo->codigo }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('organos.show', $organo) }}" class="hover:underline font-medium" wire:navigate>
                            {{ $organo->nombre }}
                        </a>
                        @if($organo->padre)
                            <span class="ml-2 text-xs text-neutral-500">→ {{ $organo->padre->siglas }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $organo->siglas }}</td>
                    <td class="px-4 py-3">
                        <flux:badge size="sm" color="{{ match($organo->nivel) {
                            'ministerio' => 'blue',
                            'instituto' => 'green',
                            'direccion' => 'orange',
                            default => 'neutral',
                        } }}">{{ ucfirst($organo->nivel) }}</flux:badge>
                    </td>
                    <td class="px-4 py-3 font-mono text-xs">{{ $organo->rif ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @if($organo->activo)
                            <flux:badge size="sm" color="green">Activo</flux:badge>
                        @else
                            <flux:badge size="sm" color="red">Inactivo</flux:badge>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <flux:button href="{{ route('organos.edit', $organo) }}" size="sm" wire:navigate>Editar</flux:button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
