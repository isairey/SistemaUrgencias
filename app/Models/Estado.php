<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }

    public function adminEnfermero()
    {
        return $this->hasMany(AdminEnfermero::class);
    }

    public function adminUrgencia()
    {
        return $this->hasMany(AdminUrgencia::class);
    }

    public function admisiones()
    {
        return $this->hasMany(Admision::class);
    }

    public function enfermeros()
    {
        return $this->hasMany(Enfermero::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
