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
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_udg')->unique();
            $table->text('cog_descripcion')->nullable();
            $table->text('clasificador')->nullable();
            $table->string('clasificador_descripcion', 250)->nullable();
            $table->integer('id_resguardante')->nullable();
            $table->string('nombre_resguardante', 250)->nullable();
            $table->string('fecha_adquisicion', 250)->nullable();
            $table->string('descripcion', 600)->nullable();
            $table->string('origen', 250)->nullable();
            $table->string('tram_alta', 250)->nullable();
            $table->string('marca', 250)->nullable();
            $table->string('modelo', 250)->nullable();
            $table->string('num_serie', 250)->nullable();
            $table->integer('id_tipo_siiau')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bienes');
    }
};
