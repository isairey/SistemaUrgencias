<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Estado;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Events\PatientStatusUpdated;
use Illuminate\Support\Facades\Auth;
use App\Rules\RutChileno;
use App\Models\EliminacionPaciente;
use App\Models\Atencion;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;


class PacienteController extends Controller
{
    
    public function index()
    {
        $pacientes = Paciente::where('activo', true)->get();
        $categorias = Categoria::all();
        $estados = Estado::all();

        return view('admin.pacientes.index', compact('pacientes', 'categorias', 'estados'));
    }

    public function create()
    {
        return view('admin.pacientes.create');
    }

    public function store(Request $request)
    {
        // Buscar si el paciente existe por el rut, si lo encuentra y está activo, lo carga con sus relaciones
        $pacienteExistente = Paciente::with('atenciones', 'estado')
            ->where('rut', $request->rut)
            ->first();
        //Si el paciente existe, revisa si está inactivo o tiene atención activa
        if ($pacienteExistente) {
            if ($pacienteExistente->activo === false) {
                // Si el paciente existe, pero esta inactivo, muestra alerta para reactivación
                return redirect()->back()
                    ->withInput()
                    ->with('paciente_existente', $pacienteExistente)
                    ->with('icono', 'info')
                    ->with('mensaje', 'Este paciente está inactivo. ¿Deseas reactivarlo y registrar una nueva atención?');
            }

            // Define los estados que se consideran como atención activa, esto se usará para filtrar las atenciones del paciente
            $estadoActivo = ['Ingresado', 'En espera de atencion', 'En atencion', 'En espera de cama'];
            //Consulta si el paciente tiene alguna atención en esos estados (usa whereHas para filtrar las atenciones segun el nombre del estado)
            $atencionActiva = $pacienteExistente->atenciones()
                ->whereHas('estado', fn($q) => $q->whereIn('nombre', $estadoActivo))
                ->exists();

            //si el paciente tiene una atencion activa, se bloquea el ingreso y se muestra una alerta de advertencia
            if ($atencionActiva) {
                return redirect()->back()
                    ->withInput()
                    ->with('paciente_existente', $pacienteExistente)
                    ->with('icono', 'warning')
                    ->with('mensaje', 'Este paciente ya tiene una atención activa. No se puede registrar una nueva atención.');
            }

            // Verifica si el formulario (modal) incluye la confirmacion para agregar una nueva atención
            if ($request->has('confirmar_atencion')) {
                // Si se confirma, crea una nueva atención para el paciente existente
                Atencion::create([
                    'paciente_id' => $pacienteExistente->id,
                    'estado_id' => $pacienteExistente->estado_id,
                    'categoria_id' => null,
                    'fecha_atencion' => now(),
                    'observaciones' => 'Atención automática al reingresar paciente',
                ]);

                return redirect()->route('admin.pacientes.index')
                    ->with('mensaje', 'Atención registrada correctamente para paciente existente.')
                    ->with('icono', 'success');
            }

            // Si no hay atención activa ni confirmacion, muestra alerta para confirmar nueva atención
            return redirect()->back()
                ->withInput()
                ->with('paciente_existente', $pacienteExistente)
                ->with('icono', 'info')
                ->with('mensaje', 'Este paciente ya está registrado. ¿Deseas agregar una nueva atención?');
        }            

        // Validación y creación de paciente nuevo
        $tipo = $request->input('identificacion_tipo');

        $rules = [
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'identificacion_tipo' => 'required|in:rut,pasaporte,ficha',
            'rut' => [
                'required',
                'max:12',
                Rule::unique('pacientes', 'rut'),
            ],
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

        Atencion::create([
            'paciente_id' => $paciente->id,
            'estado_id' => $estadoInicial?->id,
            'categoria_id' => null,
            'fecha_atencion' => now(),
            'observaciones' => 'Paciente nuevo con atención inicial automática',
        ]);

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Paciente registrado exitosamente con atención inicial.')
            ->with('icono', 'success');
    }

    public function atencionRapida(Paciente $paciente)
    {
        //reactiva el paciente si estaba inactivo
        if (!$paciente->activo) {
            $paciente->activo = true;
            $paciente->save();

        //registra una nueva atencion con estado "ingresado" y categoria null
            EliminacionPaciente::create([
                'paciente_id' => $paciente->id,
                'usuario_id' => Auth::id(),
                'motivo' => 'Reactivación de paciente para atención rápida',
                'eliminado_en' => now(),
            ]);
        }

        $estadoIngresado = Estado::where('nombre', 'ingresado')->first();

        // Actualiza estado y categoría del paciente
        $paciente->estado_id = $estadoIngresado?->id;
        $paciente->categoria_id = null;
        $paciente->save();

        Atencion::create([
            'paciente_id' => $paciente->id,
            'estado_id' => Estado::where('nombre', 'ingresado')->first()?->id,
            'categoria_id' => null,
            'fecha_atencion' => now(),
            'observaciones' => 'Paciente en base de datos, atención rápida registrada',
        ]);

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Atención registrada exitosamente.')
            ->with('icono', 'success');
    }

    public function actualizarDatos(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
        ]);

        $paciente->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        return response()->json([
            'paciente' => [
            'nombre' => $paciente->nombre,
            'apellido' => $paciente->apellido,
            'rut' => $paciente->rut,
            'total_atenciones' => $paciente->atenciones()->count(),
            'ultima_categoria' => optional($paciente->atenciones()->latest()->first()?->categoria)->nombre,
            ]
        ]);
    }

    public function show($id)
    {
        //variable + modelo
        $paciente = Paciente::findOrFail($id);
        // retornamos a la vista que deseamos ver e informamos la variable
        return view('admin.pacientes.show', compact('paciente'));
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => 'required|max:12|unique:pacientes,rut,' . $paciente->id
        ]);

        //actualizamos los datos del paciente
        $paciente->nombre = $request->nombre;
        $paciente->apellido = $request->apellido;
        $paciente->rut = $request->rut;
        $paciente->save();

        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Paciente actualizado exitosamente.')
            ->with('icono', 'success');
    }    

    public function destroy($id)
    {
        //Busca al paciente por su ID, incluyendo su relacion con el modelo estado
        $paciente = Paciente::with('estado')->findOrFail($id);

        // verifica que el paciente este en estado clinico "dado de alta", solo en ese estado se permite marcarlo como inactivo
        if ($paciente->estado->nombre !== 'Dado de Alta') {
            //si no encuentra el estado "Dado de Alta", muestra una alerta y no permite eliminar
            return redirect()->back()
                ->with('mensaje', 'Solo se pueden eliminar pacientes dados de alta.')
                ->with('icono', 'info');
        }

        // Marcar como inactivo en lugar de eliminar
        $paciente->activo = false;
        $paciente->save();

        // Auditoría oculta: registrar quién lo inactiva (elimina de panel)
        EliminacionPaciente::create([
            'paciente_id' => $paciente->id,
            'usuario_id' => auth()->id(),
            'motivo' => 'Paciente inactivo tras alta médica',
            'eliminado_en' => now(),
        ]);

        return redirect()->route('admin.pacientes.condition')
        ->with('mensaje','Registro Eliminado!')
        ->with('icono','warning');
    }
}
