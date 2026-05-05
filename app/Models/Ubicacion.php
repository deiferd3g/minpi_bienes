<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'organo_id', 'nombre', 'codigo', 'direccion',
        'ciudad', 'estado', 'pais', 'edificio',
        'piso', 'oficina', 'referencia', 'activo',
    ];

    public function organo(): BelongsTo
    {
        return $this->belongsTo(Organo::class);
    }

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class);
    }
}
