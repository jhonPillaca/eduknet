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
            $table->timestamps();
            $table->string('user_id');// este campo tendría como tipo de dato integer, pero como desconozco como realmente viene el dato temporalmente lo dejo en string.
            $table->string('book_id');// este campo tendría como tipo de dato integer, pero como desconozco como realmente viene el dato temporalmente lo dejo en string.
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion');
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
