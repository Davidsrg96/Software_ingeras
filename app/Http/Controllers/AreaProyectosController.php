<?php

namespace App\Http\Controllers;

use App\proyecto;
use App\area_proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * index recibe la id del proyecto
     */
    public function index($id)
    {
        $areas = DB::select( 'SELECT a.id,a.Nombre_area,a.Personal,a.Porcentaje_asignado,a.proyecto_id,p.Nombre_proyecto
                                     FROM area_proyectos a,proyectos p 
                                     WHERE a.proyecto_id = p.id AND proyecto_id = ?',[$id]);

        return view('Proyectos.index_area',compact('areas', 'proyecto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $p = proyecto::find($id);
        return view('Proyectos.create_area', compact('p'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('INSERT INTO area_proyectos (Nombre_area, Porcentaje_asignado, Personal, proyecto_id)
                                VALUES (?,?,?,?)',[$request->get('nom_area'),
                                                   $request->get('porcentaje'),
                                                   $request->get('personal'),
                                                   $request->get('proyecto')]);
        return redirect()->route('area.index',$request->get('proyecto'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idp, $id)
    {
        $p = proyecto::find($idp);
        $area = area_proyecto::find($id);
        return view('Proyectos.show_area',compact('p', 'area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idp, $id)
    {
        $a = area_proyecto::find($id);
        $p = proyecto::find($idp);
        return view('Proyectos.create_area', compact('a','p'));
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
        db::update('UPDATE area_proyectos SET Nombre_area = ?, Porcentaje_asignado = ?, Personal = ?
                            WHERE id = ?',[$request->get('nom_area'),
                                           $request->get('porcentaje'),
                                           $request->get('personal'),
                                           $id]);
        return redirect()->route('area.index',compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('DELETE FROM area_proyectos WHERE id = ?',[$id]);
        return redirect()->route('area.index',compact('id'));
    }
}
