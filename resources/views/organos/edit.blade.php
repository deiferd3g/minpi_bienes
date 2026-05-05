<x-layouts::app :title="'Editar: ' . $organo->nombre">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('organos.index') }}" wire:navigate>Órganos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Editar: {{ $organo->codigo }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:heading size="xl">Editar {{ $organo->nombre }}</flux:heading>
    <flux:subheading>Modifique los datos del órgano o entidad.</flux:subheading>

    <div class="mt-6 max-w-2xl">
        <form class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Nombre" value="{{ $organo->nombre }}" required />
                <flux:input label="Siglas" value="{{ $organo->siglas }}" required />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Código" value="{{ $organo->codigo }}" required />
                <flux:input label="RIF" value="{{ $organo->rif }}" />
            </div>
            <flux:select label="Nivel">
                @foreach(['ministerio','instituto','direccion','division','departamento','otro'] as $nivel)
                <option value="{{ $nivel }}" {{ $organo->nivel === $nivel ? 'selected' : '' }}>{{ ucfirst($nivel) }}</option>
                @endforeach
            </flux:select>
            <flux:input label="Dirección" value="{{ $organo->direccion }}" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Teléfono" value="{{ $organo->telefono }}" />
                <flux:input label="Correo Electrónico" type="email" value="{{ $organo->email }}" />
            </div>
            <flux:textarea label="Descripción" rows="3">{{ $organo->descripcion }}</flux:textarea>
            <div class="flex items-center gap-4">
                <flux:switch :checked="$organo->activo" label="Activo" />
            </div>
            <div class="flex items-center justify-end gap-4 pt-4">
                <flux:button href="{{ route('organos.index') }}" wire:navigate variant="ghost">Cancelar</flux:button>
                <flux:button variant="primary">Guardar Cambios</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
