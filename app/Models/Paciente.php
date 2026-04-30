<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Atencion;

class Paciente extends Model
{

    protected $fillable = [
    'nombre',
    'apellido',
    'rut',
    'categoria_id',
    'estado_id'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function estado() {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function atenciones()
    {
        return $this->hasMany(Atencion::class);
    }

}
