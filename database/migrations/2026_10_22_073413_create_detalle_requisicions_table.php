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
        Schema::create('detalle_requisiciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisicion_id')
                  ->constrained('requisiciones') 
                  ->cascadeOnDelete();

            $table->foreignId('articulo_id')
                  ->constrained('articulos')
                  ->cascadeOnDelete();
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_requisicions');
    }
};
