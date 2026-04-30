<?php

namespace App\Http\Controllers;

use App\Events\PatientStatusUpdated;
use App\Models\Paciente;
use App\Models\Categoria;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoPacienteController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $estadosClave = [
            'En espera de atencion',
            'En atencion',
        ];

        $cupos = [
            'ESI 1' => 2,
            'ESI 2' => 8,
            'ESI 3' => 50,
            'ESI 4' => 7,
            'ESI 5' => 4,
            'ESPERA-CAMA' => 35,
        ];

        $umbralesBase = [
            'ESI 1' => 0,
            'ESI 2' => 5,
            'ESI 3' => 15,
            'ESI 4' => 30,
            'ESI 5' => 45,
            'ESPERA-CAMA' => 60,
        ];

        $iconos = [
            'En espera de atencion' => 'bi bi-hourglass-split',
            'En atencion' => 'bi bi-heart-pulse-fill',
            'En espera de cama' => 'fas fa-bed',
        ];

        $pacientes = Paciente::with(['categoria', 'estado'])
            ->whereHas('estado', function ($query) {
                $query->where('nombre', '!=', 'Dado de Alta');
            })
            ->get();

        $hayCriticos = $pacientes->where('categoria.codigo', 'ESI 1')->count() > 0;

        $umbrales = collect($umbralesBase)->map(function ($valor, $codigo) use ($hayCriticos) {
            return $hayCriticos ? $valor + 20 : $valor;
        })->toArray();

        $data = [];

        foreach ($categorias as $categoria) {
            if ($categoria->codigo === 'ESI 6') continue;

            $categoriaPacientes = $pacientes->where('categoria_id', $categoria->id);
            $totalPacientes = $categoriaPacientes->count();

            $estados = collect($estadosClave)->mapWithKeys(function ($estadoNombre) use ($categoriaPacientes, $iconos) {
                $estadoPacientes = $categoriaPacientes->where('estado.nombre', $estadoNombre);

                // Filtrar según estado para calcular tiempo correcto
                $tiempoPromedio = 0;

                if ($estadoNombre === 'En espera de atencion') {
                    $tiempoPromedio = $estadoPacientes
                        ->map(fn($p) => now()->diffInMinutes($p->created_at))
                        ->avg();
                }
                
                return [
                    $estadoNombre => [
                        'cantidad' => $estadoPacientes->count(),
                        'promedio' => round($tiempoPromedio ?? 0),
                        'icono' => $iconos[$estadoNombre] ?? 'fas fa-question-circle',
                    ],
                ];

            })->toArray();

            $data[] = [
                'codigo' => $categoria->codigo,
                'nombre' => $categoria->nombre,
                'color' => str_replace('bg-', '', $categoria->color),
                'cupo' => $cupos[$categoria->codigo] ?? 0,
                'total' => $totalPacientes,
                'umbrales' => $umbrales[$categoria->codigo] ?? 30,
                'estados' => $estados,
            ];
        }

        // Categoría especial: espera de cama
        $esperaCamaPacientes = $pacientes->where('estado.nombre', 'En espera de cama');

        $tiempoPromedioCama = $esperaCamaPacientes
            ->map(fn($p) => now()->diffInMinutes($p->created_at))
            ->avg();

        $data[] = [
            'codigo' => 'ESPERA-CAMA',
            'nombre' => 'Pacientes en espera de cama',
            'color' => 'secondary',
            'icono' => 'fas fa-procedures',
            'cupo' => $cupos['ESPERA-CAMA'],
            'total' => $esperaCamaPacientes->count(),
            'umbrales' => $umbrales['ESPERA-CAMA'],
            'estados' => [
                'En espera de cama' => [
                    'cantidad' => $esperaCamaPacientes->count(),
                    'promedio' => round($tiempoPromedioCama ?? 0),
                    'icono' => 'fas fa-procedures',
                ]
            ]
        ];

        return view('admin.panel', ['categorias' => $data, 'hayCriticos' => $hayCriticos]);
    }

    public function getPacienteJson($id)
    {
        $paciente = Paciente::with('estado', 'categoria')->findOrFail($id);

        return response()->json([
            'id' => $paciente->id,
            'nombre' => $paciente->nombre,
            'apellido' => $paciente->apellido,
            'rut' => $paciente->rut,
            'estado_id' => $paciente->estado_id,
            'estado_nombre' => $paciente->estado->nombre,
            'categoria_id' => $paciente->categoria_id,
            'categoria_nombre' => optional($paciente->categoria)->nombre,
            'ultima_categoria' => optional($paciente->categoria)->nombre,
            'total_atenciones' => $paciente->atenciones()->count(),
        ]);
    }

    public function condition()
    {
        //carga las relaciones necesarias para mostrar en la vista condition
        $pacientes = Paciente::with(['categoria', 'estado'])
            // filtra los pacientes activos = 1
            ->where('activo', true)
            //ejecuta la consulta y obtiene los resultados
            ->get();
        $categorias = Categoria::all();
        $estados = Estado::all();

        $this->authorize('admin.pacientes.condition');
        return view('admin.condition', compact('pacientes', 'categorias', 'estados'));
    }

    public function updateCategory(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'estado_id' => 'required|exists:estados,id',
        ]);

        $estadoAnterior = $paciente->estado ? $paciente->estado->nombre : null;

        $paciente->categoria_id = $validated['categoria_id'];
        $paciente->estado_id = $validated['estado_id'];
        $paciente->save();

        $categoria = Categoria::find($validated['categoria_id']);
        $estado = Estado::find($validated['estado_id']);

        $cantidad = Paciente::where('categoria_id', $validated['categoria_id'])
            ->where('estado_id', $validated['estado_id'])
            ->count();

        event(new PatientStatusUpdated(
            $categoria->codigo,
            $categoria->nombre,
            $estado->nombre,
            $estadoAnterior,
            $cantidad
        ));

        return response()->json(['success' => true]);
    }

    function mapColor($color)
    {
        $validColors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

        return in_array($color, $validColors) ? $color : ($color === 'orange' ? 'orange' : 'secondary');
    }
}
