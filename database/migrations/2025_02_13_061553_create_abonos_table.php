<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('abonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->constrained('socios')->onDelete('cascade');
            $table->foreignId('prestamo_id')->constrained('prestamos')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->decimal('saldo_restante', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abonos');
    }
};
