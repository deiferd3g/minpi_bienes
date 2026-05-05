<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignacion extends Model
{
    use SoftDeletes;

    protected $table = 'asignaciones';

    protected $fillable = [
        'bien_id', 'custodio_id', 'organo_id', 'ubicacion_id',
        'tipo', 'fecha_asignacion', 'fecha_devolucion',
        'numero_acta', 'motivo', 'observaciones',
        'autorizado_por', 'estado_fisico_al_recibir', 'activo',
    ];

    protected function casts(): array
    {
        return [
            'fecha_asignacion' => 'date',
            'fecha_devolucion' => 'date',
        ];
    }

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class);
    }

    public function custodio(): BelongsTo
    {
        return $this->belongsTo(Custodio::class);
    }

    public function organo(): BelongsTo
    {
        return $this->belongsTo(Organo::class);
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function autorizadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'autorizado_por');
    }
}
