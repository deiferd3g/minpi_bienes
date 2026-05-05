<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'siglas', 'descripcion', 'rif',
        'direccion', 'telefono', 'email', 'organo_padre_id',
        'nivel', 'activo',
    ];

    public function padre(): BelongsTo
    {
        return $this->belongsTo(Organo::class, 'organo_padre_id');
    }

    public function hijos(): HasMany
    {
        return $this->hasMany(Organo::class, 'organo_padre_id');
    }

    public function ubicaciones(): HasMany
    {
        return $this->hasMany(Ubicacion::class);
    }

    public function custodios(): HasMany
    {
        return $this->hasMany(Custodio::class);
    }

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class);
    }
}
