<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');       // Ejemplo: C1, C2, etc.
            $table->string('nombre');       // Ejemplo: "Riesgo Vital Emergencia"
            $table->string('color');        // Ejemplo: "bg-danger"
            $table->integer('orden');       // Para orden en pantalla
            $table->timestamps();
        });

        // Insertar datos iniciales
        DB::table('categorias')->insert([
            ['codigo' => 'ESI 1', 'nombre' => 'Riesgo Vital Emergencia', 'color' => 'bg-danger', 'orden' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['codigo' => 'ESI 2', 'nombre' => 'Paciente de Alta Complejidad', 'color' => 'bg-orange', 'orden' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['codigo' => 'ESI 3', 'nombre' => 'Paciente de Mediano Riesgo', 'color' => 'bg-warning', 'orden' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['codigo' => 'ESI 4', 'nombre' => 'Urgencia Menor', 'color' => 'bg-success', 'orden' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['codigo' => 'ESI 5', 'nombre' => 'Sin Urgencia', 'color' => 'bg-primary', 'orden' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
