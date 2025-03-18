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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('imagen')->nullable();
            $table->foreignId('autor_id')->constrained('writers')->onDelete('cascade'); 
            $table->string('genero');
            $table->string('editorial')->nullable();
            $table->year('fecha_creacion'); 
            $table->text('descripcion');    
            $table->decimal('valoracion', 3, 2)->default(0.0);
            $table->decimal('precio', 8, 2)->default(0.00); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
