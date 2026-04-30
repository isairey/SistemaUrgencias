<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Campos para la tabla paciente
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut', 12)->unique();
            $table->boolean('activo')->default(true)->index();

            // Campos adicionales llenados por el enfermero
            $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('estado_id')->nullable()->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
