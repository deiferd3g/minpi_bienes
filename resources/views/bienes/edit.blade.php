<x-layouts::app :title="'Editar: ' . $bien->codigo_patrimonial">
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('bienes.index') }}" wire:navigate>Bienes</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Editar: {{ $bien->codigo_patrimonial }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <flux:heading size="xl">Editar Bien</flux:heading>
    <flux:subheading>{{ $bien->codigo_patrimonial }} · {{ $bien->nombre }}</flux:subheading>

    <div class="mt-6 max-w-3xl">
        <form class="space-y-6">
            <flux:separator text="Identificación" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Código Patrimonial" value="{{ $bien->codigo_patrimonial }}" required />
                <flux:input label="Código Interno" value="{{ $bien->codigo_interno }}" />
            </div>
            <flux:input label="Nombre" value="{{ $bien->nombre }}" required />

            <flux:separator text="Características" />
            <div class="grid gap-4 sm:grid-cols-3">
                <flux:input label="Marca" value="{{ $bien->marca }}" />
                <flux:input label="Modelo" value="{{ $bien->modelo }}" />
                <flux:input label="Color" value="{{ $bien->color }}" />
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:input label="Serial" value="{{ $bien->serial }}" />
                <flux:input label="Vida Útil (años)" type="number" value="{{ $bien->vida_util_anios }}" />
            </div>

            <flux:separator text="Clasificación" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:select label="Categoría">
                    @foreach(\App\Models\CategoriaBien::all() as $cat)
                    <option value="{{ $cat->id }}" {{ $bien->categoria_id === $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
                    @endforeach
                </flux:select>
                <flux:select label="Fabricante">
                    @foreach(\App\Models\Fabricante::all() as $fab)
                    <option value="{{ $fab->id }}" {{ $bien->fabricante_id === $fab->id ? 'selected' : '' }}>{{ $fab->nombre }}</option>
                    @endforeach
                </flux:select>
            </div>

            <flux:separator text="Valores" />
            <div class="grid gap-4 sm:grid-cols-3">
                <flux:input label="Valor Original ($)" type="number" step="0.01" value="{{ $bien->valor_original }}" />
                <flux:input label="Valor Actual ($)" type="number" step="0.01" value="{{ $bien->valor_actual }}" />
                <flux:input label="Valor Residual ($)" type="number" step="0.01" value="{{ $bien->valor_residual }}" />
            </div>

            <flux:separator text="Estado" />
            <div class="grid gap-4 sm:grid-cols-2">
                <flux:select label="Estado Físico">
                    @foreach(['nuevo','bueno','regular','malo','obsoleto','desincorporado','robado'] as $estado)
                    <option value="{{ $estado }}" {{ $bien->estado_fisico === $estado ? 'selected' : '' }}>{{ ucfirst($estado) }}</option>
                    @endforeach
                </flux:select>
                <flux:select label="Condición de Uso">
                    @foreach(['operativo','inoperativo','en_reparacion','dado_baja'] as $cond)
                    <option value="{{ $cond }}" {{ $bien->condicion_uso === $cond ? 'selected' : '' }}>{{ str_replace('_', ' ', ucfirst($cond)) }}</option>
                    @endforeach
                </flux:select>
            </div>
            <flux:textarea label="Observaciones" rows="2">{{ $bien->observaciones }}</flux:textarea>

            <div class="flex items-center justify-end gap-4 pt-4">
                <flux:button href="{{ route('bienes.index') }}" wire:navigate variant="ghost">Cancelar</flux:button>
                <flux:button variant="primary">Guardar Cambios</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
