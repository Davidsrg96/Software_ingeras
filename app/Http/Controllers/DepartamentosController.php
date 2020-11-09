<?php

namespace App\Http\Controllers;

use App\actividad;
use App\departamento;
use App\departamento_actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentosController extends Controller
{
    
    public function index()
    {
        $departamentos = departamento::orderBy('id','ASC')->paginate();
        return view('Departamentos.index_depto', compact('departamentos'));
    }


    public function actividades($id)
    {
        $d = departamento::find($id);
        $act = DB::select('SELECT actividads.*
                                    FROM actividads, departamento_actividads
                                    WHERE actividads.id = departamento_actividads.actividad_id
                                    AND departamento_actividads.departamento_id = :id',['id' => $d->id]);

        return view('Departamentos.index_actividad',compact(['act', 'd']));
    }

    public function create()
    {
        return view('Departamentos.create_depto');
    }

    public function crearActividad($id)
    {
        return view('Departamentos.create_actividad', compact('id'));
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO departamento (Nombre_departamento, Objetivo) VALUES (?,?)',
                                [$request->get('nombre_depto'),$request->get('objetivo')]);
        return redirect()->route('departamentos.index');
    }

    public function guardarActividad(Request $request, $id)
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

    public function show($id)
    {
        $d = departamento::find($id);
        return view('Departamentos.show_depto', compact(['id', 'd']));
    }

    public function edit($id)
    {
        $d = departamento::find($id);
        return view('Departamentos.create_depto',compact('d'));
    }


    public function editarActividad($idAct,$id)
    {
        $act = actividad::find($idAct);
        return view('Departamentos.create_actividad', compact('act', 'id'));

    }
   
    public function update(Request $request, $id)
    {
        DB::update('UPDATE departamento SET Nombre_departamento = ?, Objetivo = ?
                            WHERE id = ?',[$request->get('nombre_depto'),
                                           $request->get('objetivo')]);
        return redirect()->route('departamentos.index');
    }

    public function actualizarActividad(Request $request, $idAct, $id)
    {
        DB::update('UPDATE actividads SET Nombre_actividad = ?, Descripcion = ?
                            WHERE id = ?',[$request->get('nom_actividad'),
                                           $request->get('descripcion'),
                                           $idAct]);
        return redirect()->route('actividadesdepto.index',compact('id'));

    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM departamento WHERE id = ?',[$id]);
        return redirect()->route('departamentos.index');
    }

    public function eliminarActividad($idAct, $id)
    {
        DB::delete('DELETE FROM departamento_actividads
                            WHERE actividad_id = :idAct
                            AND departamento_id = :id',['idAct' => $idAct,'id' => $id]);
        DB::delete('DELETE FROM actividads WHERE id = ?',[$idAct]);

        return redirect()->route('actividadesdepto.index', $id);
    }
}
