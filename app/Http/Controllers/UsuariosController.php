<?php

namespace App\Http\Controllers;

use App\cargo;
use App\user;
use App\tipo_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller
{

    public function index()
    {
        $usuarios = user::orderBy('id','ASC')->paginate();
        $tipos = tipo_usuario::all();
        $cargos = cargo::all();
        return view('Usuarios.index_usuarios',compact('usuarios', 'tipos', 'cargos'));

    }

    public function create()
    {
        $tipos = tipo_usuario::all();
        $cargos = cargo::all();
        return view('Usuarios.create_usuarios', compact('tipos','cargos'));
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO users (Nombre,Rut,password,email,Es_externo,Confiabilidad,Ciudad,cargo_id,tipo_usuario_id) 
                                VALUES (?,?,?,?,?,?,?,?,?)',[$request->get('nombre'),
                                                           $request->get('rut'),
                                                           bcrypt($request->get('contraseña')),
                                                           $request->get('email'),
                                                           $request->get('trabajador_ioe'),
                                                           $request->get('confiabilidad'),
                                                           $request->get('ciudad'),
                                                           $request->get('cargo'),
                                                           $request->get('tipo_usuario')]);

        return redirect()->route('usuarios.index');
    }

    public function show($id)
    {
        $usuario = user::find($id);
        $cargo = cargo::find($usuario->cargo_id);
        $tipo = tipo_usuario::find($usuario->tipo_usuario_id);
        return view('Usuarios.show',compact('usuario','cargo','tipo'));
    }

    public function edit($id)
    {
        $tipos = tipo_usuario::all();
        $cargos = cargo::all();
        $u = user::find($id);
        return view('Usuarios.create_usuarios', compact('u', 'tipos', 'cargos'));
    }

    public function update(Request $request, $id)
    {

        DB::update('UPDATE users SET Nombre = ?, Rut = ?, password = ?, email = ?
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

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM users WHERE id = ?',[$id]);
        return redirect()->route('usuarios.index');
    }
}
