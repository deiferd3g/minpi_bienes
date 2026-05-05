<x-layouts::app :title="'Nuevo Custodio'">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('custodios.index') }}" wire:navigate>Custodios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:heading size="xl">Nuevo Custodio</flux:heading>
    <flux:subheading>Registre la persona responsable de bienes nacionales.</flux:subheading>

    <div class="mt-6 max-w-2xl">
        <form class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Cédula" placeholder="V-12345678" required />
                <flux:input label="Nacionalidad" value="Venezolana" />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Nombres" placeholder="María Isabel" required />
                <flux:input label="Apellidos" placeholder="Rodríguez López" required />
            </div>
            <flux:input label="Cargo" placeholder="Directora General" required />
            <flux:select label="Órgano" required>
                @foreach(\App\Models\Organo::all() as $org)
                <option value="{{ $org->id }}">{{ $org->nombre }} ({{ $org->siglas }})</option>
                @endforeach
            </flux:select>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Correo Electrónico" type="email" placeholder="correo@entidad.gob.ve" />
                <flux:input label="Teléfono" placeholder="0212-..." />
            </div>
            <flux:select label="Tipo de Custodio">
                <option value="titular">Titular</option>
                <option value="encargado">Encargado</option>
                <option value="temporal">Temporal</option>
                <option value="comisionado">Comisionado</option>
            </flux:select>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Fecha de Nombramiento" type="date" />
                <flux:input label="Vencimiento del Cargo" type="date" />
            </div>
            <flux:textarea label="Observaciones" rows="2" />
            <div class="flex items-center justify-end gap-4 pt-4">
                <flux:button href="{{ route('custodios.index') }}" wire:navigate variant="ghost">Cancelar</flux:button>
                <flux:button variant="primary">Guardar Custodio</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
