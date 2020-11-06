<?php

namespace App\Http\Controllers;

use App\actividad_proyecto,
    App\cualidad,
    App\proyecto,
    App\area_proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActividadesProyectosController extends Controller
{
   
    public function index($id_proyecto,$id_area)
    {
        $cualidades = cualidad::all();
        $actividad = DB::select('SELECT ac.id,ac.Nombre_actividad,ac.Descripcion,ac.Evaluacion,ar.Nombre_area,p.Nombre_proyecto,ac.proyecto_id,ac.area_proyecto_id
                                 FROM actividad_proyectos ac, area_proyectos ar, proyectos p 
                                 WHERE ac.area_proyecto_id = ar.id AND ac.proyecto_id = p.id AND ar.id = ? AND p.id = ?',
                                 [$id_area,$id_proyecto]);

        return view('Proyectos.index_actividad',compact( 'actividad','cualidades'));
    }

    public function create($id_proyecto,$id_area)
    {
        $p = proyecto::find($id_proyecto);
        $a = area_proyecto::find($id_area);
        return view('Proyectos.create_actividad',compact('p', 'a'));
    }

    public function store(Request $request, $id_proyecto,$id_area)
    {
        DB::insert('INSERT INTO actividad_proyectos (Nombre_actividad,Descripcion,proyecto_id,area_proyecto_id)
                            VALUES (?,?,?,?)', [$request->get('nom_act'),
                                                $request->get('nom_act'),
                                                $id_proyecto,
                                                $id_area]);
        return redirect()->action('ActividadesProyectosController@index',[$id_proyecto,$id_area]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id, $id_proyecto, $id_area)
    {
        $p = proyecto::find($id_proyecto);
        $a = area_proyecto::find($id_area);
        $act = actividad_proyecto::find($id);
        return view('Proyectos.create_actividad',compact('p', 'a', 'act'));
    }

    public function update(Request $request, $id, $id_proyecto,$id_area)
    {
        DB::update('UPDATE actividad_proyectos SET Nombre_actividad = ?, Descripcion = ?
                            WHERE id = ?',[$request->get('nom_act'),
                                           $request->get('descripcion'),
                                           $id]);
        return redirect()->action('ActividadesProyectosController@index',[$id_proyecto,$id_area]);
    }

    public function destroy($id, $id_proyecto,$id_area)
    {
        DB::delete('DELETE FROM actividad_proyectos WHERE id = ?',[$id]);
        return redirect()->action('ActividadesProyectosController@index',[$id_proyecto,$id_area]);
    }
}
