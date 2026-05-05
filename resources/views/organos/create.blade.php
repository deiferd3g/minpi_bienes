<x-layouts::app :title="'Nuevo Órgano'">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('organos.index') }}" wire:navigate>Órganos</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:heading size="xl">Nuevo Órgano / Entidad</flux:heading>
    <flux:subheading>Registre un nuevo ministerio, instituto o dependencia.</flux:subheading>

    <div class="mt-6 max-w-2xl">
        <form class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Nombre del Órgano" placeholder="Ministerio..." required />
                <flux:input label="Siglas" placeholder="MPPE" required />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Código" placeholder="MPPE" required />
                <flux:input label="RIF" placeholder="G-20000001-0" />
            </div>
            <flux:select label="Nivel">
                <option value="ministerio">Ministerio</option>
                <option value="instituto">Instituto</option>
                <option value="direccion">Dirección</option>
                <option value="division">División</option>
                <option value="departamento">Departamento</option>
                <option value="otro">Otro</option>
            </flux:select>
            <flux:input label="Dirección" placeholder="Av. ..." />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Teléfono" placeholder="0212-..." />
                <flux:input label="Correo Electrónico" type="email" placeholder="correo@entidad.gob.ve" />
            </div>
            <flux:textarea label="Descripción" rows="3" />
            <div class="flex items-center justify-end gap-4 pt-4">
                <flux:button href="{{ route('organos.index') }}" wire:navigate variant="ghost">Cancelar</flux:button>
                <flux:button variant="primary">Guardar Órgano</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
