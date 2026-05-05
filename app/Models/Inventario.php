<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'organo_id', 'ubicacion_id',
        'tipo', 'alcance', 'fecha_inicio', 'fecha_fin',
        'total_bienes_esperados', 'total_bienes_contados',
        'total_conciliados', 'total_diferencias',
        'diferencia_valor_total', 'estado', 'responsable_id', 'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function organo(): BelongsTo
    {
        return $this->belongsTo(Organo::class);
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleInventario::class, 'inventario_id');
    }
}
