<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\RutChileno;

class UsuarioController extends Controller
{
    public function index(){
        //Del modelo usuario traera todos los datos que seran almacenados en esta variable
        //En este caso se asume que se mostraran las admisiones de los usuarios
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create(){
        //Retorna la vista para crear una nueva admision
        return view('admin.usuarios.create');
    }

    public function store(Request $request){
        //Valida los datos del formulario
        $request->validate([
            'name' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => ['required', 'max:12', 'unique:users,rut', new RutChileno],
            'password' => 'required|min:8|confirmed',
        ]);

        //Inserción a la base de datos
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;
        $usuario->estado_id = Estado::where('nombre', 'ingresado')->first()?->id;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        $usuario->assignRole('administrador'); // Asigna el rol de administrador al usuario creado

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje','Registro Exitoso!')
        ->with('icono','success');
    }

    public function show($id){
        //Muestra los detalles de una admision especifica
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit($id){
        //Muestra el formulario para editar una admision
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    //permite traer todo lo que esta en el formulario de edicion
    public function update(Request $request, $id){
        $usuario = User::find($id);
        //Valida los datos del formulario
        $request->validate([
            'name' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => 'required|max:12|unique:users,rut,'.$usuario->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        //Actualiza los datos de la admision
        $usuario->name = $request->name;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;
        if($request->filled('password')) {
            // Solo actualiza la contraseña si se ha proporcionado una nueva
            $usuario->password = Hash::make($request['password']);
        }
        
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje','Registro Actualizado!')
        ->with('icono','success');
    }

    public function destroy($id){
        //Elimina una admision
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje','Registro Eliminado!')
        ->with('icono','warning');
    }
}


