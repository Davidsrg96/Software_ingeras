<?php

namespace App\Http\Controllers;

use App\tipo_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{

    public function index()
    {
        $tipos_usuarios = tipo_usuario::orderBy('id','ASC')->paginate();
        return view('Tipos_usuarios.index',compact('tipos_usuarios'));
    }

    public function create()
    {
        return view('Tipos_usuarios.create');
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO tipo_usuarios (Tipo_usuario, Descripcion)
                            VALUES (?,?)',[$request->get('tipo_usuario'),$request->get('descripcion')]);
        return redirect()->route('tipo_usuario.index');
    }

    public function show($id)
    {
        $tipo = tipo_usuario::find($id);
        return view('Tipos_usuarios.show',compact('tipo'));
    }

    public function edit($id)
    {
        $tipo = tipo_usuario::find($id);
        return view('Tipos_usuarios.create',compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE tipo_usuarios SET Tipo_usuario = ?, Descripcion = ? WHERE id = ?',
                            [$request->get('tipo_usuario'),$request->get('descripcion'),$id]);
        return redirect()->route('tipo_usuario.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM tipo_usuarios WHERE id = ?',[$id]);
        return redirect()->route('tipo_usuario.index');
    }
}
