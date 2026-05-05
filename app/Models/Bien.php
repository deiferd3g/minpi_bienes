<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bien extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo_patrimonial', 'codigo_interno', 'nombre', 'descripcion',
        'marca', 'modelo', 'serial', 'color',
        'categoria_id', 'fabricante_id', 'organo_id', 'ubicacion_id',
        'custodio_actual_id',
        'valor_original', 'valor_actual', 'valor_residual',
        'fecha_adquisicion', 'documento_adquisicion', 'fecha_puesta_servicio',
        'estado_fisico', 'condicion_uso',
        'vida_util_anios', 'fecha_vencimiento_garantia',
        'observaciones', 'imagen', 'caracteristicas_extra',
    ];

    protected function casts(): array
    {
        return [
            'fecha_adquisicion' => 'date',
            'fecha_puesta_servicio' => 'date',
            'fecha_vencimiento_garantia' => 'date',
            'caracteristicas_extra' => 'json',
            'valor_original' => 'decimal:2',
            'valor_actual' => 'decimal:2',
            'valor_residual' => 'decimal:2',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaBien::class, 'categoria_id');
    }

    public function fabricante(): BelongsTo
    {
        return $this->belongsTo(Fabricante::class);
    }

    public function organo(): BelongsTo
    {
        return $this->belongsTo(Organo::class);
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function custodioActual(): BelongsTo
    {
        return $this->belongsTo(Custodio::class, 'custodio_actual_id');
    }

    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class);
    }

    public function movimientos(): HasMany
    {
        return $this->hasMany(Movimiento::class);
    }

    public function depreciaciones(): HasMany
    {
        return $this->hasMany(Depreciacion::class);
    }

    public function mantenimientos(): HasMany
    {
        return $this->hasMany(Mantenimiento::class);
    }

    public function detallesInventario(): HasMany
    {
        return $this->hasMany(DetalleInventario::class, 'bien_id');
    }
}
