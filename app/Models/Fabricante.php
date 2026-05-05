<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabricante extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre', 'pais_origen', 'sitio_web',
        'telefono_soporte', 'email_soporte', 'notas', 'activo',
    ];

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class);
    }
}
