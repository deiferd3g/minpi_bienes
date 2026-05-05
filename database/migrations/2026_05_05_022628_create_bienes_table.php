<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_patrimonial', 50)->unique()->comment('Código único de inventario nacional');
            $table->string('codigo_interno', 50)->nullable()->comment('Código interno del órgano');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 100)->nullable();
            $table->string('serial', 100)->nullable();
            $table->string('color', 50)->nullable();
            $table->foreignId('categoria_id')->constrained('categorias_bienes');
            $table->foreignId('fabricante_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('organo_id')->constrained();
            $table->foreignId('ubicacion_id')->nullable()->constrained();
            $table->foreignId('custodio_actual_id')->nullable()->constrained('custodios')->nullOnDelete();
            $table->decimal('valor_original', 14, 2)->default(0);
            $table->decimal('valor_actual', 14, 2)->default(0);
            $table->decimal('valor_residual', 14, 2)->default(0);
            $table->date('fecha_adquisicion')->nullable();
            $table->string('documento_adquisicion', 100)->nullable()->comment('Factura/Acta/Orden');
            $table->date('fecha_puesta_servicio')->nullable();
            $table->enum('estado_fisico', ['nuevo', 'bueno', 'regular', 'malo', 'obsoleto', 'desincorporado', 'robado'])->default('bueno');
            $table->enum('condicion_uso', ['operativo', 'inoperativo', 'en_reparacion', 'dado_baja'])->default('operativo');
            $table->integer('vida_util_anios')->nullable();
            $table->date('fecha_vencimiento_garantia')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->json('caracteristicas_extra')->nullable()->comment('Atributos dinámicos según categoría');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['organo_id', 'categoria_id']);
            $table->index('estado_fisico');
            $table->index('condicion_uso');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bienes');
    }
};
