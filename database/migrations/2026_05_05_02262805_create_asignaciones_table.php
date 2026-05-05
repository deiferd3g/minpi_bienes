<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bien_id')->constrained('bienes')->cascadeOnDelete();
            $table->foreignId('custodio_id')->constrained();
            $table->foreignId('organo_id')->constrained();
            $table->foreignId('ubicacion_id')->nullable()->constrained('ubicaciones');
            $table->enum('tipo', ['asignacion', 'transferencia', 'devolucion', 'reubicacion'])->default('asignacion');
            $table->date('fecha_asignacion');
            $table->date('fecha_devolucion')->nullable();
            $table->string('numero_acta', 50)->nullable();
            $table->text('motivo')->nullable();
            $table->text('observaciones')->nullable();
            $table->foreignId('autorizado_por')->constrained('users');
            $table->string('estado_fisico_al_recibir')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['bien_id', 'activo']);
            $table->index(['custodio_id', 'activo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
