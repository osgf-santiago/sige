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
        Schema::create('detalles_oc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oc_id')
                  ->constrained('ordenes_compras') 
                  ->cascadeOnDelete();
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->decimal('precio_unitario');
            $table->decimal('sub_total');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_oc');
    }
};
