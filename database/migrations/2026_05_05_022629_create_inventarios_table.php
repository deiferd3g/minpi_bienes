<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->string('nombre');
            $table->foreignId('organo_id')->constrained();
            $table->foreignId('ubicacion_id')->nullable()->constrained();
            $table->enum('tipo', ['planificado', 'extraordinario', 'rotacion', 'cierre_anual', 'toma_fisica']);
            $table->enum('alcance', ['total', 'parcial', 'por_categoria', 'por_ubicacion'])->default('total');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->integer('total_bienes_esperados')->default(0);
            $table->integer('total_bienes_contados')->default(0);
            $table->integer('total_conciliados')->default(0);
            $table->integer('total_diferencias')->default(0);
            $table->decimal('diferencia_valor_total', 14, 2)->default(0);
            $table->enum('estado', ['planificado', 'en_curso', 'conciliacion', 'finalizado', 'anulado'])->default('planificado');
            $table->foreignId('responsable_id')->constrained('users');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};
