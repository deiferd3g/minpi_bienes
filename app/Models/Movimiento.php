<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimiento extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'bien_id',
        'organo_origen_id', 'organo_destino_id',
        'ubicacion_origen_id', 'ubicacion_destino_id',
        'custodio_origen_id', 'custodio_destino_id',
        'tipo', 'numero_acta', 'motivo', 'estado',
        'solicitado_por', 'aprobado_por',
        'fecha_solicitud', 'fecha_ejecucion', 'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_solicitud' => 'datetime',
            'fecha_ejecucion' => 'datetime',
        ];
    }

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class);
    }

    public function organoOrigen(): BelongsTo
    {
        return $this->belongsTo(Organo::class, 'organo_origen_id');
    }

    public function organoDestino(): BelongsTo
    {
        return $this->belongsTo(Organo::class, 'organo_destino_id');
    }

    public function ubicacionOrigen(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_origen_id');
    }

    public function ubicacionDestino(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_destino_id');
    }

    public function custodioOrigen(): BelongsTo
    {
        return $this->belongsTo(Custodio::class, 'custodio_origen_id');
    }

    public function custodioDestino(): BelongsTo
    {
        return $this->belongsTo(Custodio::class, 'custodio_destino_id');
    }

    public function solicitadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'solicitado_por');
    }

    public function aprobadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aprobado_por');
    }
}
