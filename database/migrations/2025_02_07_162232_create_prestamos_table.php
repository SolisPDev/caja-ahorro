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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->date('fecha_solicitud');
            $table->decimal('monto', 10, 2);
            $table->decimal('tasa_interes', 5, 2)->default(5.00);
            $table->decimal('saldo_pendiente', 10, 2);
            $table->decimal('total_pagar', 10, 2);
            $table->integer('quincenas');
            $table->date('fecha_inicio');
            $table->enum('estado', ['Activo', 'Pagado', 'Vencido'])->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
