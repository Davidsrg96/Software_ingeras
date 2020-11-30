<?php

namespace App\Http\Controllers;

use App\tipo_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\tipoUsuario\TipoUsuarioRequest;
use App\Http\Requests\administracion\tipoUsuario\TipoUsuarioDeleteRequest;

class TipoUsuarioController extends Controller
{

    public function index()
    {
        $tipos_usuarios = tipo_usuario::all()->sortBy('Tipo_usuario');
        return view('Tipos_usuarios.index',compact('tipos_usuarios'));
    }

    public function create()
    {
        return view('Tipos_usuarios.create');
    }

    public function store(TipoUsuarioRequest $request)
    {
        tipo_usuario::create($request->input());
        return redirect()
            ->route('tipo_usuario.index')
            ->with('success', [
                'titulo'  => 'Creación de Tipo de Usuario',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $tipo = tipo_usuario::find($id);
        return view('Tipos_usuarios.show',compact('tipo'));
    }

    public function edit($id)
    {
        $tipo = tipo_usuario::find($id);
        return view('Tipos_usuarios.edit', compact('tipo'));
    }

    public function update(TipoUsuarioRequest $request, $id)
    {
        tipo_usuario::findOrFail($id)->update($request->input());
        return redirect()
          ->route('tipo_usuario.index')
          ->with('success', [
            'titulo'  => 'Actualización de Tipo de Usuario',
            'mensaje' => 'Actualización realizada de forma correcta',
          ]);
    }

    public function destroy(TipoUsuarioDeleteRequest $request, $id)
    {
        tipo_usuario::findOrFail($id)->delete();
        return redirect()
          ->route('tipo_usuario.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Tipo de Usuario',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
