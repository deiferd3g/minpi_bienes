<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias_bienes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo', 20)->unique();
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_padre_id')->nullable()->constrained('categorias_bienes')->nullOnDelete();
            $table->enum('tipo', ['mobiliario', 'equipo_computacion', 'vehiculo', 'maquinaria', 'inmueble', 'instrumental', 'comunicacion', 'seguridad', 'otro'])->default('otro');
            $table->string('unidad_medida', 30)->nullable();
            $table->integer('vida_util_anios')->nullable()->comment('Años de vida útil para depreciación');
            $table->boolean('depreciable')->default(true);
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias_bienes');
    }
};
