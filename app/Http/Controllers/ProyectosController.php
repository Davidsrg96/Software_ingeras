<?php

namespace App\Http\Controllers;

use App\User;
use App\proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{

    public function index()
    {
        $proyectos = proyecto::orderBy('id','ASC')->paginate();
        $encargados = user::all();
        return view('Proyectos.index_proyectos', compact('proyectos','encargados'));
    }

    public function create()
    {
        $usuarios = user::all();
        return view('Proyectos.create_proyectos',compact('usuarios'));
    }

    public function usuarios($id)
    {
        $proyecto = proyecto::find($id);
        $usuarios = DB::select('SELECT u.Nombre,u.Rut,u.Carga_proyecto,up.Carga
                                       FROM users u, proyectos p, usuario_proyectos up
                                       WHERE u.id = up.usuario_id AND p.id = up.proyecto_id
                                       AND p.id = ?',[$id]);
        return view('Proyectos.index_usuarios_proyecto',compact('proyecto','usuarios'));
    }

    public function createUsuariosProyecto($id)
    {
        $proyecto = proyecto::find($id);
        $usuarios = DB::select('SELECT id,Nombre,Rut,Carga_proyecto FROM users WHERE Carga_proyecto < ?',[100]);
        return view('Proyectos.create_usuarios_proyecto',compact('proyecto','usuarios'));
    }

    public function storeUsuarios(Request $request,$id)
    {
        $ids = $request->get('ids');
        $cargas = $request->get('cargas');
        $cargas_totales = $request->get('cargas_totales');

        for($i = 0;$i < sizeof($ids); $i++){
            DB::update('UPDATE users SET Carga_proyecto = ? WHERE id = ?',[$cargas_totales[$i],$ids[$i]]);
            DB::insert('INSERT INTO usuario_proyectos (Carga,usuario_id,proyecto_id)
                                VALUES (?,?,?)',[$cargas[$i],$ids[$i],$id]);
        }
        return redirect()->route('proyectos.usuarios',compact($id));
    }

    public function destroyUsuarios($idp,$idu)
    {
        $carga = DB::select('SELECT Carga FROM usuario_proyectos WHERE usuario_id = ? AND proyecto_id = ?',[$idu,$idp]);
        $carga_total = DB::select('SELECT Carga_proyecto FROM users WHERE id = ?',[$idu]);
        $nueva_carga = $carga_total - $carga;
        DB::update('UPDATE users SET Carga_proyecto = ? WHERE id = ?',[$nueva_carga,$idu]);
        DB::delete('DELETE FROM usuario_proyectos WHERE usuario_id = ? AND proyecto_id = ?',[$idu,$idp]);
        return redirect()->route('proyectos.usuarios',compact($idp));
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO proyectos (Nombre_proyecto, Fecha_inicio, Fecha_termino, 
                                        Presupuesto_oferta, Presupuesto_control, encargado_id)
                                VALUES (?,?,?,?,?,?)',[$request->get('nom_proyecto'),
                                                       $request->get('f_inicio'),
                                                       $request->get('f_termino'),
                                                       $request->get('p_oferta'),
                                                       $request->get('p_control'),
                                                       $request->get('encargado')]);

        return redirect()->route('proyectos.index');
    }

    public function show($id)
    {
        $p = DB::select('SELECT p.*, u.Nombre
                                FROM proyectos p, users u
                                WHERE p.encargado_id = u.id AND p.id = ?',[$id]);
        return view('Proyectos.show_proyectos', compact('p'));
    }

    public function edit($id)
    {
        $p = DB::select('SELECT p.id, p.Nombre_proyecto, p.Fecha_inicio, p.Fecha_termino, p.Presupuesto_oferta, p.Presupuesto_control, p.encargado_id, u.Nombre
                                FROM proyectos p, users u
                                WHERE p.encargado_id = u.id AND p.id = ?',[$id]);
        return view('Proyectos.create_proyectos',compact('p'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE proyectos SET Nombre_proyecto = ?, Fecha_inicio = ?, Fecha_termino = ?, 
                                        Presupuesto_oferta = ?, Presupuesto_control = ?
                            WHERE id = ?',[$request->get('nom_proyecto'),
                                           $request->get('f_inicio'),
                                           $request->get('f_termino'),
                                           $request->get('p_oferta'),
                                           $request->get('p_control'),
                                           $id]);
        return redirect()->route('proyectos.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM proyectos WHERE id = ?',[$id]);
        return redirect()->route('proyectos.index');
    }
}
