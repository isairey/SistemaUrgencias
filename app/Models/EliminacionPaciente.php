<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EliminacionPaciente extends Model
{
    protected $table = 'eliminaciones_pacientes';

    protected $fillable = [
        'paciente_id',
        'usuario_id',
        'eliminado_en',
        'motivo'
    ];

    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class);
    }

}
