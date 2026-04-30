<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ejemplo: "En atención", "En espera"
            $table->timestamps();
        });

        //Insertar datos iniciales
        DB::table('estados')->insert([
            ['nombre' => 'Ingresado','created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'En espera de atencion','created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'En atencion', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Dado de Alta', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'En espera de cama', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
