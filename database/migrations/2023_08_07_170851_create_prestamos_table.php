<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id'); // modificación conociendo la tabla 
            $table->unsignedBigInteger('book_id');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion');
            $table->boolean('devuelto')->default(false);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('libros');
        });
    }




    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};