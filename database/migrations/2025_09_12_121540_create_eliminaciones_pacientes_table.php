<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('eliminaciones_pacientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('eliminado_en')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('motivo')->nullable(); // motivo por defecto " dado de alta"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eliminaciones_pacientes');
    }
};
