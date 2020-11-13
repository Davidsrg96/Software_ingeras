<?php

namespace App\Http\Controllers;

use App\cargo;
use App\usuario;
use App\ciudad;
use App\tipo_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\usuario\UsuarioRequest;


class UsuariosController extends Controller
{

    public function index()
    {
      $usuarios = usuario::orderBy('id','ASC')->paginate();
      return view('Usuarios.index_usuarios',compact('usuarios'));

    }

    public function create()
    {
      $tipos    = tipo_usuario::all();
      $cargos   = cargo::all();
      $ciudades = ciudad::all();
      return view('Usuarios.create_usuarios', compact('tipos','cargos','ciudades'));
    }

    public function store(UsuarioRequest $request)
    {
      usuario::create($request->input() + ['Rut' => $request->rutEs]);
      return redirect()
          ->route('usuarios.index')
          ->with('success', [
            'titulo'  => 'Creación de Usuario',
            'mensaje' => 'Creación realizada de forma correcta',
          ]);
    }

    public function show($id)
    {
      $usuario = usuario::find($id);
      return view('Usuarios.show',compact('usuario'));
    }

    public function edit($id)
    {
      $tipos = tipo_usuario::all();
      $cargos = cargo::all();
      $usuario = usuario::find($id);
      $ciudades = ciudad::all();
      $password = bcrypt($usuario->password);
      return view('Usuarios.edit_usuario', compact('usuario', 'tipos', 'cargos','ciudades','password'));
    }

    public function update(UsuarioRequest $request, $id)
    {
      if ($request->password) {
        usuario::findOrFail($id)->update($request->input() + ['Rut' => $request->rutEs]);
      }else{
        usuario::findOrFail($id)->update($request->except(['password']) + ['Rut' => $request->rutEs]);
      }

      return redirect()
          ->route('usuarios.index')
          ->with('success', [
            'titulo'  => 'Actualización de Usuario',
            'mensaje' => 'Actualización realizada de forma correcta',
          ]);
    }

    public function destroy($id)
    {
        usuario::findOrFail($id)->delete();
        return redirect()
            ->route('usuarios.index')
            ->with('success', [
              'titulo'  => 'Eliminación de Usuario',
              'mensaje' => 'Eliminación realizada de forma correcta',
          ]);
    }
}
