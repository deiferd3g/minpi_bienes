<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Depreciacion extends Model
{
    protected $table = 'depreciaciones';

    protected $fillable = [
        'bien_id', 'fecha_calculo', 'periodo',
        'valor_inicial', 'valor_depreciado', 'depreciacion_acumulada',
        'valor_libros', 'porcentaje', 'metodo', 'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_calculo' => 'date',
            'valor_inicial' => 'decimal:2',
            'valor_depreciado' => 'decimal:2',
            'depreciacion_acumulada' => 'decimal:2',
            'valor_libros' => 'decimal:2',
        ];
    }

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class);
    }
}
