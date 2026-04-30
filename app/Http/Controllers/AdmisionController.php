<?php

namespace App\Http\Controllers;

use App\Models\Admision;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\RutChileno;

class AdmisionController extends Controller
{
    public function index(){
        //Del modelo usuario traera todos los datos que seran almacenados en esta variable
        //En este caso se asume que se mostraran las admisiones de los usuarios
        $admisiones = Admision::with('user')->get();
        return view('admin.admisiones.index', compact('admisiones'));
    }

    public function create(){
        //Retorna la vista para crear una nueva admision
        return view('admin.admisiones.create');
    }

    public function store(Request $request){
        //Valida los datos del formulario
        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => ['required', 'max:12', 'unique:users,rut', new RutChileno],
            'password' => 'required|min:8|confirmed',
        ]);

        //Inserción a la base de datos de creacion de usuario
        $usuario = new User();
        $usuario->name = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        $admision = new Admision();
        $admision->user_id = $usuario->id; // Asocia la admisión al usuario creado
        $admision->nombre = $request->nombre;
        $admision->apellido = $request->apellido;
        $admision->rut = $request->rut;
        $admision->estado_id = Estado::where('nombre', 'ingresado')->first()?->id;
        $admision->save();

        $usuario->assignRole('admisionista');


        return redirect()->route('admin.admisiones.index')
        ->with('mensaje','Registro Exitoso!')
        ->with('icono','success');
    }

    public function show($id){
        //Muestra los detalles de una admision especifica
        $admision = Admision::with('user')->findOrFail($id);
        return view('admin.admisiones.show', compact('admision'));
    }

    public function edit($id){
        //Muestra el formulario para editar una admision
        $admision = Admision::with('user')->findOrFail($id);
        return view('admin.admisiones.edit', compact('admision'));
    }

    //permite traer todo lo que esta en el formulario de edicion
    public function update(Request $request, $id)
    {
        $admision = Admision::find($id);

        $usuario = User::findOrFail($id);
        $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'rut' => 'required|unique:admisions,rut,' . $admision->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        //Actualiza los datos de la admision
        $admision->nombre = $request->nombre;
        $admision->apellido = $request->apellido;
        $admision->rut = $request->rut;        
        $admision->save();

        $usuario = User::find($admision->user_id);
        $usuario->name = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;

        if($request->filled('password')){
            // Solo actualiza la contraseña si se ha proporcionado una nueva
            $usuario->password = Hash::make($request['password']);
        }        
        $usuario->save();

        return redirect()->route('admin.admisiones.index')
        ->with('mensaje','Registro Actualizado!')
        ->with('icono','success');
    }

    public function destroy($id){
        //Elimina una admision
        $admision = Admision::findOrFail($id);
        $admision->delete();

        return redirect()->route('admin.admisiones.index')
        ->with('mensaje','Registro Eliminado!')
        ->with('icono','warning');
    }
}


