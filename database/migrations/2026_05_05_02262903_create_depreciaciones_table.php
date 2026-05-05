<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('depreciaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bien_id')->constrained('bienes')->cascadeOnDelete();
            $table->date('fecha_calculo');
            $table->integer('periodo')->comment('Número de período de depreciación');
            $table->decimal('valor_inicial', 14, 2);
            $table->decimal('valor_depreciado', 14, 2)->comment('Monto depreciado en este período');
            $table->decimal('depreciacion_acumulada', 14, 2);
            $table->decimal('valor_libros', 14, 2);
            $table->decimal('porcentaje', 5, 2)->comment('Porcentaje aplicado');
            $table->enum('metodo', ['linea_recta', 'suma_digitos', 'horas_trabajo', 'unidades_produccion'])->default('linea_recta');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->unique(['bien_id', 'periodo']);
            $table->index(['bien_id', 'fecha_calculo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('depreciaciones');
    }
};
