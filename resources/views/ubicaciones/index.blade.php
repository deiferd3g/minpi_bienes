<x-layouts::app :title="__('Ubicaciones')">
    <flux:heading size="xl">Ubicaciones</flux:heading>
    <flux:subheading>Sedes, oficinas y almacenes donde se resguardan los bienes nacionales.</flux:subheading>

    <div class="mt-6 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <table class="w-full text-left text-sm">
            <thead class="bg-neutral-100 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 font-medium">Código</th>
                    <th class="px-4 py-3 font-medium">Nombre</th>
                    <th class="px-4 py-3 font-medium">Órgano</th>
                    <th class="px-4 py-3 font-medium">Ciudad / Estado</th>
                    <th class="px-4 py-3 font-medium">Bienes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @foreach(\App\Models\Ubicacion::with('organo')->get() as $ubi)
                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $ubi->codigo ?? '-' }}</td>
                    <td class="px-4 py-3 font-medium">{{ $ubi->nombre }}</td>
                    <td class="px-4 py-3 text-xs">{{ $ubi->organo->siglas ?? '-' }}</td>
                    <td class="px-4 py-3 text-xs">{{ $ubi->ciudad ?? '-' }} / {{ $ubi->estado ?? '-' }}</td>
                    <td class="px-4 py-3 font-mono text-xs">{{ $ubi->bienes->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
