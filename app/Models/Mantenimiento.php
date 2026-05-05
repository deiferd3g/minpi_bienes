<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mantenimiento extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'bien_id', 'tipo',
        'proveedor', 'costo',
        'fecha_solicitud', 'fecha_ejecucion', 'fecha_proximo_mantenimiento',
        'descripcion_trabajo', 'diagnostico', 'repuestos_utilizados',
        'estado', 'solicitado_por', 'autorizado_por',
        'observaciones', 'archivo_informe',
    ];

    protected function casts(): array
    {
        return [
            'fecha_solicitud' => 'date',
            'fecha_ejecucion' => 'date',
            'fecha_proximo_mantenimiento' => 'date',
            'costo' => 'decimal:2',
        ];
    }

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class);
    }

    public function solicitadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'solicitado_por');
    }

    public function autorizadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autorizado_por');
    }
}
