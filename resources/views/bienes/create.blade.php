<x-layouts::app :title="'Nuevo Bien Nacional'">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('bienes.index') }}" wire:navigate>Bienes</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Nuevo</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:heading size="xl">Registrar Bien Nacional</flux:heading>
    <flux:subheading>Ingrese los datos del bien para incorporarlo al inventario nacional.</flux:subheading>

    <div class="mt-6 max-w-3xl">
        <form class="space-y-6">
            <flux:separator text="Identificación" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Código Patrimonial" placeholder="MPPE-XXXX-####" required />
                <flux:input label="Código Interno" placeholder="DGTI-###" />
            </div>
            <flux:input label="Nombre del Bien" placeholder="Laptop Corporativa, Escritorio Ejecutivo..." required />
            <flux:textarea label="Descripción" rows="2" />

            <flux:separator text="Características" />
            <div class="grid gap-4 sm:grid-cols-3">
                <flux:input label="Marca" placeholder="HP, Toyota..." />
                <flux:input label="Modelo" placeholder="ProBook 450" />
                <flux:input label="Color" placeholder="Negro" />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="N° Serial" placeholder="SN-XXXXXXXX" />
                <flux:input label="Años de Vida Útil" type="number" placeholder="4" />
            </div>

            <flux:separator text="Clasificación" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:select label="Categoría">
                    <option>Seleccione...</option>
                    @foreach(\App\Models\CategoriaBien::whereNull('categoria_padre_id')->get() as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nombre }} ({{ $cat->codigo }})</option>
                    @endforeach
                </flux:select>
                <flux:select label="Fabricante">
                    <option>Seleccione...</option>
                    @foreach(\App\Models\Fabricante::all() as $fab)
                    <option value="{{ $fab->id }}">{{ $fab->nombre }}</option>
                    @endforeach
                </flux:select>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:select label="Órgano / Entidad" required>
                    <option>Seleccione...</option>
                    @foreach(\App\Models\Organo::all() as $org)
                    <option value="{{ $org->id }}">{{ $org->nombre }} ({{ $org->siglas }})</option>
                    @endforeach
                </flux:select>
                <flux:select label="Ubicación Física">
                    <option>Seleccione...</option>
                    @foreach(\App\Models\Ubicacion::all() as $ubi)
                    <option value="{{ $ubi->id }}">{{ $ubi->nombre }}</option>
                    @endforeach
                </flux:select>
            </div>

            <flux:separator text="Valores y Adquisición" />
            <div class="grid gap-4 sm:grid-cols-3">
                <flux:input label="Valor Original ($)" type="number" step="0.01" placeholder="0.00" />
                <flux:input label="Valor Actual ($)" type="number" step="0.01" placeholder="0.00" />
                <flux:input label="Valor Residual ($)" type="number" step="0.01" placeholder="0.00" />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Fecha de Adquisición" type="date" />
                <flux:input label="Documento de Adquisición" placeholder="OC-N°-XXXX" />
            </div>

            <flux:separator text="Estado" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:select label="Estado Físico">
                    <option value="nuevo">Nuevo</option>
                    <option value="bueno">Bueno</option>
                    <option value="regular">Regular</option>
                    <option value="malo">Malo</option>
                    <option value="obsoleto">Obsoleto</option>
                </flux:select>
                <flux:select label="Condición de Uso">
                    <option value="operativo">Operativo</option>
                    <option value="inoperativo">Inoperativo</option>
                    <option value="en_reparacion">En Reparación</option>
                    <option value="dado_baja">Dado de Baja</option>
                </flux:select>
            </div>
            <flux:textarea label="Observaciones" rows="2" />

            <div class="flex items-center justify-end gap-4 pt-4">
                <flux:button href="{{ route('bienes.index') }}" wire:navigate variant="ghost">Cancelar</flux:button>
                <flux:button variant="primary">Guardar Bien</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
