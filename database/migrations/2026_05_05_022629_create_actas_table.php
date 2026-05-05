<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 30)->unique();
            $table->string('titulo');
            $table->foreignId('organo_id')->constrained();
            $table->enum('tipo', ['recepcion', 'entrega', 'transferencia', 'desincorporacion', 'deposito', 'custodia', 'inventario', 'ajuste', 'otro']);
            $table->text('cuerpo');
            $table->json('bienes_incluidos')->nullable()->comment('Lista de IDs de bienes incluidos');
            $table->date('fecha_emision');
            $table->enum('estado', ['borrador', 'emitido', 'firmado', 'anulado', 'archivado'])->default('borrador');
            $table->text('firmantes')->nullable()->comment('JSON con datos de quienes firman');
            $table->string('archivo_pdf', 255)->nullable();
            $table->foreignId('elaborado_por')->constrained('users');
            $table->foreignId('aprobado_por')->nullable()->constrained('users');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actas');
    }
};
