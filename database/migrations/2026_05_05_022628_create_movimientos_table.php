<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->foreignId('bien_id')->constrained()->cascadeOnDelete();
            $table->foreignId('organo_origen_id')->constrained('organos');
            $table->foreignId('organo_destino_id')->constrained('organos');
            $table->foreignId('ubicacion_origen_id')->nullable()->constrained('ubicaciones');
            $table->foreignId('ubicacion_destino_id')->nullable()->constrained('ubicaciones');
            $table->foreignId('custodio_origen_id')->nullable()->constrained('custodios');
            $table->foreignId('custodio_destino_id')->nullable()->constrained('custodios');
            $table->enum('tipo', ['transferencia', 'reubicacion', 'cambio_custodio', 'prestamo', 'devolucion', 'desincorporacion']);
            $table->string('numero_acta', 50)->nullable();
            $table->text('motivo');
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado', 'ejecutado', 'anulado'])->default('pendiente');
            $table->foreignId('solicitado_por')->constrained('users');
            $table->foreignId('aprobado_por')->nullable()->constrained('users');
            $table->dateTime('fecha_solicitud');
            $table->dateTime('fecha_ejecucion')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['bien_id', 'estado']);
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
