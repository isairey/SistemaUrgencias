<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Atencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'categoria_id',
        'estado_id',
        'fecha_atencion',
        'observaciones',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

}
