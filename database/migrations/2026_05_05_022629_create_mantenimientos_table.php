<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->foreignId('bien_id')->constrained()->cascadeOnDelete();
            $table->enum('tipo', ['preventivo', 'correctivo', 'predictivo', 'emergencia']);
            $table->string('proveedor', 150)->nullable();
            $table->decimal('costo', 14, 2)->default(0);
            $table->date('fecha_solicitud');
            $table->date('fecha_ejecucion')->nullable();
            $table->date('fecha_proximo_mantenimiento')->nullable();
            $table->text('descripcion_trabajo');
            $table->text('diagnostico')->nullable();
            $table->text('repuestos_utilizados')->nullable();
            $table->enum('estado', ['solicitado', 'aprobado', 'en_ejecucion', 'completado', 'cancelado'])->default('solicitado');
            $table->foreignId('solicitado_por')->constrained('users');
            $table->foreignId('autorizado_por')->nullable()->constrained('users');
            $table->text('observaciones')->nullable();
            $table->string('archivo_informe', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['bien_id', 'estado']);
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
