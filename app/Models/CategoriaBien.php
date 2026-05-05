<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaBien extends Model
{
    use SoftDeletes;

    protected $table = 'categorias_bienes';

    protected $fillable = [
        'nombre', 'codigo', 'descripcion', 'categoria_padre_id',
        'tipo', 'unidad_medida', 'vida_util_anios',
        'depreciable', 'activo',
    ];

    public function padre(): BelongsTo
    {
        return $this->belongsTo(CategoriaBien::class, 'categoria_padre_id');
    }

    public function hijos(): HasMany
    {
        return $this->hasMany(CategoriaBien::class, 'categoria_padre_id');
    }

    public function bienes(): HasMany
    {
        return $this->hasMany(Bien::class, 'categoria_id');
    }
}
