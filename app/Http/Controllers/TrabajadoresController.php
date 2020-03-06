<?php

namespace App\Http\Controllers;

use App\trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajadores = trabajador::orderBy('id','ASC')->paginate();
        return view('Trabajadores.index',compact('trabajadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Trabajadores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('INSERT INTO trabajadors (Nombre,Rut)
                            VALUES (?,?)',[$request->get('nombre'),$request->get('rut')]);
        return redirect()->route('trabajadores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trabajador = trabajador::find($id);
        return view('Trabajadores.show',compact('trabajador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $t = trabajador::find($id);
        return view('Trabajadores.create',compact('t'));
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
        DB::update('UPDATE trabajadors SET Nombre = ?, Rut = ? WHERE id = ?',
                            [$request->get('nombre'),$request->get('rut'),$id]);
        return redirect()->route('trabajadores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('DELETE FROM trabajadors WHERE id = ?',[$id]);
        return redirect()->route('trabajadores.index');
    }
}
