<x-layouts::app :title="$custodio->nombres . ' ' . $custodio->apellidos">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('custodios.index') }}" wire:navigate>Custodios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $custodio->cedula }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-start justify-between">
        <div>
            <flux:heading size="xl">{{ $custodio->nombres }} {{ $custodio->apellidos }}</flux:heading>
            <flux:subheading>{{ $custodio->cedula }} · {{ $custodio->cargo }}</flux:subheading>
        </div>
    </div>

    <div class="mt-6 grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Datos Personales</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt>Nacionalidad</dt><dd>{{ $custodio->nacionalidad }}</dd></div>
                <div class="flex justify-between"><dt>Órgano</dt><dd>{{ $custodio->organo->nombre ?? '-' }}</dd></div>
                <div class="flex justify-between"><dt>Email</dt><dd>{{ $custodio->email ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Teléfono</dt><dd>{{ $custodio->telefono ?? 'N/A' }}</dd></div>
                <div class="flex justify-between"><dt>Tipo</dt><dd><flux:badge size="sm">{{ ucfirst($custodio->tipo) }}</flux:badge></dd></div>
            </dl>
        </div>
        <div class="rounded-xl border border-neutral-200 p-4 dark:border-neutral-700">
            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wider text-neutral-500">Bienes Asignados</h3>
            @if($custodio->bienes->count() > 0)
                <ul class="space-y-1 text-sm">
                    @foreach($custodio->bienes as $bien)
                    <li class="flex justify-between">
                        <a href="{{ route('bienes.show', $bien) }}" class="hover:underline" wire:navigate>{{ $bien->codigo_patrimonial }}</a>
                        <span class="text-neutral-500">{{ $bien->nombre }}</span>
                    </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-neutral-500">No tiene bienes asignados actualmente.</p>
            @endif
        </div>
    </div>
</x-layouts::app>
