<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalles_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventario_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bien_id')->constrained();
            $table->enum('resultado', ['presente', 'ausente', 'danado', 'extraviado', 'traspasado', 'no_identificado'])->nullable();
            $table->string('codigo_alternativo', 50)->nullable()->comment('Código alternativo reportado en toma física');
            $table->decimal('valor_reportado', 14, 2)->nullable()->comment('Valor reportado en toma física');
            $table->text('observacion')->nullable();
            $table->string('verificado_por', 100)->nullable();
            $table->dateTime('fecha_verificacion')->nullable();
            $table->boolean('conciliado')->default(false);
            $table->text('accion_conciliacion')->nullable();
            $table->timestamps();

            $table->unique(['inventario_id', 'bien_id']);
            $table->index('resultado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalles_inventario');
    }
};
