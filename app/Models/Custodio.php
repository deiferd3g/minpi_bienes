<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Custodio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cedula', 'nombres', 'apellidos', 'nacionalidad',
        'cargo', 'organo_id', 'email', 'telefono',
        'direccion_oficina', 'tipo',
        'fecha_nombramiento', 'fecha_vencimiento_cargo',
        'activo', 'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nombramiento' => 'date',
            'fecha_vencimiento_cargo' => 'date',
        ];
    }

    public function organo(): BelongsTo
    {
        return $this->belongsTo(Organo::class);
    }

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class, 'custodio_actual_id');
    }

    public function asignaciones(): HasMany
    {
        return $this->hasMany(Asignacion::class);
    }
}
