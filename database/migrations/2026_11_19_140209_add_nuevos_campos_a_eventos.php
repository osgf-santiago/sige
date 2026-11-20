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
        Schema::table('eventos', function (Blueprint $table) {
            $table->string('tipo')->nullable()->after('agenda');
            $table->string('solicitante')->nullable()->after('tipo');
            $table->string('operador')->nullable()->after('solicitante');
            $table->string('afluencia')->nullable()->after('operador');
            $table->dateTime('fin_evento')->nullable()->after('afluencia');
            $table->string('requerimientos_tecnicos')->nullable()->after('fin_evento');
            $table->string('requerimientos_sg')->nullable()->after('requerimientos_tecnicos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'solicitante', 'operador', 'afluencia', 'fin_evento', 'requerimientos_tecnicos', 'requerimientos_sg']);
        });
    }
};
