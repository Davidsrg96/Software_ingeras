<?php

namespace App\Http\Controllers;

use App\tipo_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_usuarios = tipo_usuario::orderBy('id','ASC')->paginate();
        return view('Tipos_usuarios.index',compact('tipos_usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Tipos_usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('INSERT INTO tipo_usuarios (Tipo_usuario, Descripcion)
                            VALUES (?,?)',[$request->get('tipo_usuario'),$request->get('descripcion')]);
        return redirect()->route('tipo_usuario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = tipo_usuario::find($id);
        return view('Tipos_usuarios.show',compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = tipo_usuario::find($id);
        return view('Tipos_usuarios.create',compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::update('UPDATE tipo_usuarios SET Tipo_usuario = ?, Descripcion = ? WHERE id = ?',
                            [$request->get('tipo_usuario'),$request->get('descripcion'),$id]);
        return redirect()->route('tipo_usuario.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('DELETE FROM tipo_usuarios WHERE id = ?',[$id]);
        return redirect()->route('tipo_usuario.index');
    }
}
