<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
            $table->foreignId('user_id')->comment('solicitante')->constrained('users');
            $table->foreignId('assigned_to')->nullable()->comment('tecnico')->constrained('users');

            $table->string('categoria'); // Ej: Hardware, Software, Redes
            $table->enum('impacto', ['bajo', 'medio', 'alto'])->default('bajo');
            $table->enum('urgencia', ['bajo', 'medio', 'alto'])->default('bajo');
            $table->enum('prioridad', ['bajo', 'medio', 'alto', 'critico'])->default('bajo');
            $table->enum('estatus', ['nuevo', 'abierto', 'pendiente', 'resuelto', 'cerrado', 'cancelado'])->default('nuevo');

            $table->text('reporte');
            $table->timestamp('primera_respuesta')->nullable();
            $table->timestamp('resuelto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
