<x-layouts::app :title="'Nuevo Inventario'">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('inventarios.index') }}" wire:navigate>Inventarios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:heading size="xl">Planificar Inventario</flux:heading>
    <flux:subheading>Programe una toma física de bienes nacionales.</flux:subheading>

    <div class="mt-6 max-w-2xl">
        <form class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Código" placeholder="INV-2025-001" required />
                <flux:input label="Nombre" placeholder="Inventario Anual 2025" required />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:select label="Tipo" required>
                    <option value="planificado">Planificado</option>
                    <option value="extraordinario">Extraordinario</option>
                    <option value="rotacion">Rotación</option>
                    <option value="cierre_anual">Cierre Anual</option>
                    <option value="toma_fisica">Toma Física</option>
                </flux:select>
                <flux:select label="Alcance">
                    <option value="total">Total</option>
                    <option value="parcial">Parcial</option>
                    <option value="por_categoria">Por Categoría</option>
                    <option value="por_ubicacion">Por Ubicación</option>
                </flux:select>
            </div>
            <flux:select label="Órgano" required>
                @foreach(\App\Models\Organo::all() as $org)
                <option value="{{ $org->id }}">{{ $org->nombre }}</option>
                @endforeach
            </flux:select>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Fecha de Inicio" type="date" required />
                <flux:input label="Fecha de Fin" type="date" />
            </div>
            <flux:textarea label="Observaciones" rows="2" />
            <div class="flex items-center justify-end gap-4 pt-4">
                <flux:button href="{{ route('inventarios.index') }}" wire:navigate variant="ghost">Cancelar</flux:button>
                <flux:button variant="primary">Crear Inventario</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
