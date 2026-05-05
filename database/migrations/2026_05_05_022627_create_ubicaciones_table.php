<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organo_id')->constrained()->cascadeOnDelete();
            $table->string('nombre');
            $table->string('codigo', 30)->nullable()->unique();
            $table->string('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('estado', 100)->nullable();
            $table->string('pais', 100)->default('Venezuela');
            $table->string('edificio')->nullable();
            $table->string('piso', 20)->nullable();
            $table->string('oficina', 50)->nullable();
            $table->text('referencia')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
