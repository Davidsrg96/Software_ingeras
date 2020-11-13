<?php

namespace App\Http\Controllers;

use App\cargo;
use App\usuario;
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
      $tipos = tipo_usuario::all();
      $cargos = cargo::all();
      return view('Usuarios.create_usuarios', compact('tipos','cargos'));
    }

    public function store(UsuarioRequest $request)
    {
      dd($request->all());
      $rut = $this->convRut($request->rutEs);
      usuario::create($request->input() + ['Rut' => $rut]);
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
      $u = usuario::find($id);
      return view('Usuarios.create_usuarios', compact('u', 'tipos', 'cargos'));
    }

    public function update(Request $request, $id)
    {

        DB::update('UPDATE usuario SET Nombre = ?, Rut = ?, password = ?, email = ?
                                    Es_externo = ?, Confiabilidad = ?,Ciudad = ?, cargo_id = ?, tipo_usuario_id = ?
                           WHERE id = ?',     [$request->get('nombre'),
                                               $request->get('rut'),
                                               $request->get('contraseña'),
                                               $request->get('email'),
                                               $request->get('trabajador_ioe'),
                                               $request->get('confiabilidad'),
                                               $request->get('ciudad'),
                                               $request->get('cargo'),
                                               $request->get('tipo_usuario'),
                                               $id]);

        return redirect()
            ->route('admin.usuarios.usuario.index')
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

  private function convRut($rutEs)
  {
    $arrRut = explode('.', $rutEs);
    $rut ="";
    foreach ($arrRut as $value) {
      $rut = $rut . $value;
    }
    return $rut;
  }
}
