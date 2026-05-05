<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleInventario extends Model
{
    protected $table = 'detalles_inventario';

    protected $fillable = [
        'inventario_id', 'bien_id', 'resultado',
        'codigo_alternativo', 'valor_reportado',
        'observacion', 'verificado_por', 'fecha_verificacion',
        'conciliado', 'accion_conciliacion',
    ];

    public function inventario(): BelongsTo
    {
        return $this->belongsTo(Inventario::class);
    }

    public function bien(): BelongsTo
    {
        return $this->belongsTo(Bien::class);
    }
}
