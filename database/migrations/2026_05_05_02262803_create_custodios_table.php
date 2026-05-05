<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custodios', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 20)->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('nacionalidad', 50)->default('Venezolana');
            $table->string('cargo');
            $table->foreignId('organo_id')->constrained();
            $table->string('email')->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('direccion_oficina')->nullable();
            $table->enum('tipo', ['titular', 'encargado', 'temporal', 'comisionado'])->default('titular');
            $table->date('fecha_nombramiento')->nullable();
            $table->date('fecha_vencimiento_cargo')->nullable();
            $table->boolean('activo')->default(true);
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->fullText(['nombres', 'apellidos', 'cedula']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custodios');
    }
};
