<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acta extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'titulo', 'organo_id', 'tipo',
        'cuerpo', 'bienes_incluidos',
        'fecha_emision', 'estado', 'firmantes',
        'archivo_pdf', 'elaborado_por', 'aprobado_por', 'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_emision' => 'date',
            'bienes_incluidos' => 'json',
            'firmantes' => 'json',
        ];
    }

    public function organo(): BelongsTo
    {
        return $this->belongsTo(Organo::class);
    }

    public function elaboradoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'elaborado_por');
    }

    public function aprobadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'aprobado_por');
    }
}
