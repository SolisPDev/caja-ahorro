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
        Schema::table('prestamos', function (Blueprint $table) {
            $table->decimal('total_pagar', 10, 2)->after('tasa_interes');
            $table->integer('quincenas')->after('total_pagar');
            $table->date('fecha_inicio')->after('fecha_solicitud');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestamos', function (Blueprint $table) {
            $table->dropColumn(['total_pagar', 'quincenas', 'fecha_inicio']);
        });
    }
};
