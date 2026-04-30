<?php

namespace App\Http\Controllers;

use App\Models\AdminUrgencia;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\RutChileno;


class AdminUrgenciaController extends Controller
{
   
    public function index()
    {
        $adminUrgencias = AdminUrgencia::with('user')->get();
        return view('admin.admin_urgencias.index', compact('adminUrgencias'));          
    } 
    
    public function create()
    {
        return view('admin.admin_urgencias.create');
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

        $adminUrgencia = new AdminUrgencia();
        $adminUrgencia->user_id = $usuario->id; 
        $adminUrgencia->nombre = $request->nombre;
        $adminUrgencia->apellido = $request->apellido;
        $adminUrgencia->rut = $request->rut;
        $adminUrgencia->estado_id = Estado::where('nombre', 'ingresado')->first()?->id;
        $adminUrgencia->save();

        $usuario->assignRole('administrador_urgencia');

        return redirect()->route('admin.admin_urgencias.index')
            ->with('mensaje','Registro Exitoso!')
            ->with('icono','success');        
    }
   
    public function show($id)
    {
        $adminUrgencia = AdminUrgencia::with('user')->findOrFail($id);
        return view('admin.admin_urgencias.show', compact('adminUrgencia'));     
    }

    
    public function edit($id)
    {
        $adminUrgencia = AdminUrgencia::with('user')->findOrFail($id);
        return view('admin.admin_urgencias.edit', compact('adminUrgencia'));
    }

    public function update(Request $request, $id)
    {
        $adminUrgencia = AdminUrgencia::find($id);   

        $usuario = User::findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'rut' => 'required|unique:admin_urgencias,rut,' . $adminUrgencia->id,
            'password' => 'nullable|min:8|confirmed',
        ]);
       
        //Actualiza los datos 
        $adminUrgencia->nombre = $request->nombre;
        $adminUrgencia->apellido = $request->apellido;
        $adminUrgencia->rut = $request->rut;
        $adminUrgencia->save();
        
        $usuario = User::find($adminUrgencia->user_id);
        $usuario->name = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rut = $request->rut;

        if($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.admin_urgencias.index')
            ->with('mensaje','Usuario Actualizado!')
            ->with('icono','success');        
    }

    public function destroy($id)
    {
        $adminUrgencia = AdminUrgencia::find($id);
        $user = $adminUrgencia->user;
        $user->delete();

        $adminUrgencia->delete();
        return redirect()->route('admin.admin_urgencias.index')
            ->with('mensaje','Usuario Eliminado!')
            ->with('icono','success');
    }
}
