<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    //Tabla de atenciones de pacientes
    public function up(): void
    {
        Schema::create('atencions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('estado_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamp('fecha_atencion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });

    }

    
    public function down(): void
    {
        Schema::dropIfExists('atencions');
    }
};
