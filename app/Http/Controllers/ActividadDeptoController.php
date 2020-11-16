<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActividadDeptoController extends Controller
{
    public function index($id)
    {
        
    }

    public function create($id)
    {
        return view('Departamentos.create_actividad', compact('id'));
    }

    public function store(Request $request, $id)
    {
        /*Se crea la actividad rescatando la id*/
        $id_actividad = DB::table('actividads')
            ->insertGetId(['Nombre_actividad'=> $request->get('nom_actividad'),
                'Descripcion' =>$request->get('descripcion')]);


        /*Se inserta la relacion N:N existente en las tablas rescatando el id del depto y de la actividad*/
        DB::insert('INSERT INTO departamento_actividads (departamento_id,actividad_id) VALUES (?,?)',
            [$id, $id_actividad]);
        return redirect()->route('actividadesdepto.index', $id);
    }

     public function edit($idAct,$id)
    {
        $act = actividad::find($idAct);
        return view('Departamentos.create_actividad', compact('act', 'id'));

    }

     public function update(Request $request, $idAct, $id)
    {
        DB::update('UPDATE actividads SET Nombre_actividad = ?, Descripcion = ?
                            WHERE id = ?',[$request->get('nom_actividad'),
                                           $request->get('descripcion'),
                                           $idAct]);
        return redirect()->route('departamento.actividades.index',compact('id'));

    }

    public function delete($idAct, $id)
    {
        dd('eliminar actividad');
        DB::delete('DELETE FROM departamento_actividads
                            WHERE actividad_id = :idAct
                            AND departamento_id = :id',['idAct' => $idAct,'id' => $id]);
        DB::delete('DELETE FROM actividads WHERE id = ?',[$idAct]);

        return redirect()->route('departamento.actividades.index', $id);
    }
}
