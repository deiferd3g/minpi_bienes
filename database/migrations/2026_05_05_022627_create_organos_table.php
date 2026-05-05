<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique()->comment('Código del órgano/entidad');
            $table->string('nombre');
            $table->string('siglas', 30)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('rif', 20)->nullable()->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('email')->nullable();
            $table->foreignId('organo_padre_id')->nullable()->constrained('organos')->nullOnDelete();
            $table->enum('nivel', ['ministerio', 'instituto', 'direccion', 'division', 'departamento', 'otro'])->default('otro');
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organos');
    }
};
