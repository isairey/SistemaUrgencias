<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atencion;
use App\Models\Paciente;
use App\Models\Categoria;
use App\Models\Estado;
use App\Rules\RutChileno;

class AtencionController extends Controller
{
    public function create($paciente_id)
    {
        $paciente = Paciente::findOrFail($paciente_id);
        $categorias = Categoria::all();
        $estados = Estado::all();

        return view('admin.atenciones.create', compact('paciente', 'categorias', 'estados'));
    }

    public function store(Request $request)
    {
        // Buscar paciente existente por rut
        $pacienteExistente = Paciente::where('rut', $request->input('rut'))->first();

        if ($pacienteExistente) {
            Atencion::create([
                'paciente_id' => $pacienteExistente->id,
                'estado_id' => Estado::where('nombre', 'ingresado')->first()?->id,
                'categoria_id' => null, // o una categoría por defecto si lo deseas
                'fecha_atencion' => now(),
                'observaciones' => 'Atención automática al reingresar paciente',
            ]);

            return redirect()->route('admin.pacientes.index')
                ->with('mensaje', 'Paciente ya estaba registrado. Se agregó una nueva atención automáticamente.')
                ->with('icono', 'success');
        }

        // Si no existe, validar y crear nuevo paciente
        $tipo = $request->input('identificacion_tipo');

        $rules = [
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'identificacion_tipo' => 'required|in:rut,pasaporte,ficha',
            'rut' => 'required|max:12|unique:pacientes',
        ];

        if ($tipo === 'rut') {
            $rules['rut'] = new RutChileno;
        }

        $request->validate($rules);

        $estadoInicial = Estado::where('nombre', 'ingresado')->first();

        $paciente = new Paciente();
        $paciente->nombre = $request->nombre;
        $paciente->apellido = $request->apellido;
        $paciente->rut = $request->rut;
        $paciente->identificacion_tipo = $tipo;
        $paciente->estado_id = $estadoInicial?->id;
        $paciente->save();

        // Registrar atención inicial para paciente nuevo
        Atencion::create([
            'paciente_id' => $paciente->id,
            'estado_id' => $estadoInicial?->id,
            'categoria_id' => null,
            'fecha_atencion' => now(),
            'observaciones' => 'Atención inicial al registrar paciente',
        ]);

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Paciente registrado exitosamente con atención inicial.')
            ->with('icono', 'success');
    }
}
