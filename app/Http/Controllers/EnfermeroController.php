<?php

namespace App\Http\Controllers;

use App\Models\Enfermero;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\RutChileno;

class EnfermeroController extends Controller
{
    
    public function index()
    {
        $enfermeros = Enfermero::with('user')->get();
        return view('admin.enfermeros.index', compact('enfermeros'));
    }

   
    public function create()
    {
        //Retorna la vista para crear una nuevo enfermero
        return view('admin.enfermeros.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => ['required', 'max:12', 'unique:users,rut', new RutChileno],
            'password' => 'required|min:8|confirmed',
        ]);     
        
        $usuario = new User();
        $usuario->name = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;
        $usuario->password = Hash::make($request->password);
        $usuario->save();     
        
        $enfermero = new Enfermero();
        $enfermero->user_id = $usuario->id;
        $enfermero->nombre = $request->nombre;
        $enfermero->apellido = $request->apellido;
        $enfermero->rut = $request->rut;
        $enfermero->estado_id = Estado::where('nombre', 'ingresado')->first()?->id;
        $enfermero->save();

        $usuario->assignRole('enfermero');

        return redirect()->route('admin.enfermeros.index')
            ->with('mensaje', 'Enfermero creado exitosamente.')
            ->with('icono','success');
    }

    
    public function show($id)
    {
        //Retorna la vista para mostrar los detalles de un enfermero
        //FindOrFail busca el enfermero por ID y lanza una excepción si no se encuentra
        $enfermero = Enfermero::with('user')->findOrFail($id);
        return view('admin.enfermeros.show', compact('enfermero')); 
    }

    
    public function edit($id)
    {
        $enfermero = Enfermero::with('user')->findOrFail($id);
        return view('admin.enfermeros.edit', compact('enfermero')); 
    }
    
    
    public function update(Request $request, $id)
    {
        //Valida los datos del formulario de edición
        //Busca el enfermero por ID y lanza una excepción si no se encuentra
        //Actualiza los datos del enfermero y del usuario asociado
        //Si se proporciona una nueva contraseña, la actualiza
        $enfermero = Enfermero::find($id);

        $usuario = User::findOrFail($id);
        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => 'required|max:12|unique:enfermeros,rut,' . $enfermero->id,
            'password' => 'nullable|min:8|confirmed',
        ]);  

        $enfermero->nombre = $request->nombre;
        $enfermero->apellido = $request->apellido;
        $enfermero->rut = $request->rut;
        $enfermero->save();

        $usuario = User::find($enfermero->user_id);
        $usuario->name = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;
        if($request->filled('password')) {
            // Solo actualiza la contraseña si se ha proporcionado una nueva
            $usuario->password = Hash::make($request['password']);
        }        
        $usuario->save();

        return redirect()->route('admin.enfermeros.index')
            ->with('mensaje', 'Datos actualizado exitosamente.')
            ->with('icono','success');
    }
    
    public function destroy($id)
    {
        //Elimina el enfermero y el usuario asociado
        $enfermero = Enfermero::find($id);
        //Eliminar el usuario asociado, estamos trayendo del modelo enfermero hacia el usuario
        $user = $enfermero->user;
        $user->delete();
        
        //Eliminar el enfermero
        $enfermero->delete();

        return redirect()->route('admin.enfermeros.index')
            ->with('mensaje', 'Enfermero eliminado exitosamente.')
            ->with('icono','success');
    }
}
