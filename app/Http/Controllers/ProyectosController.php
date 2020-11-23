<?php

namespace App\Http\Controllers;

use App\usuario;
use App\proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\proyecto\ProyectoRequest;
use App\Http\Requests\proyecto\ProyectoDeleteRequest;

class ProyectosController extends Controller
{

    public function index()
    {
        $proyectos = proyecto::orderBy('id','ASC')->paginate();
        return view('Proyectos.index_proyectos', compact('proyectos'));
    }

    public function create()
    {
        $usuarios = usuario::all();
        return view('Proyectos.create_proyectos',compact('usuarios'));
    }

    public function store(ProyectoRequest $request)
    {
        proyecto::create($request->input());

        return redirect()
            ->route('proyectos.index')
            ->with('success', [
                'titulo'  => 'Creación de Proyecto',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $p = proyecto::findOrFail($id);
        return view('Proyectos.show_proyectos', compact('p'));
    }

    public function edit($id)
    {
        $p = DB::select('SELECT p.id, p.Nombre_proyecto, p.Fecha_inicio, p.Fecha_termino, p.Presupuesto_oferta, p.Presupuesto_control, p.encargado_id, u.Nombre
                                FROM proyectos p, usuario u
                                WHERE p.encargado_id = u.id AND p.id = ?',[$id]);
        return view('Proyectos.create_proyectos',compact('p'));
    }

    public function update(ProyectoRequest $request, $id)
    {
        dd($request->all());
        proyecto::findOrFail($id)->update($request->input());
        return redirect()
            ->route('proyectos.index')
            ->with('success', [
                'titulo'  => 'Actualización de Proyecto',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy(ProyectoDeleteRequest $request ,$id)
    {
        dd($id);
        proyecto::findOrFail($id)->update($request->input());
        return redirect()
          ->route('proyectos.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Producto',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }

    public function usuarios($id)
    {
        $proyecto = proyecto::find($id);
        $usuarios = DB::select('SELECT u.Nombre,u.Rut,u.Carga_proyecto,up.Carga
                                       FROM usuario u, proyectos p, usuario_proyectos up
                                       WHERE u.id = up.usuario_id AND p.id = up.proyecto_id
                                       AND p.id = ?',[$id]);
        return view('Proyectos.index_usuarios_proyecto',compact('proyecto','usuarios'));
    }

    public function createUsuariosProyecto($id)
    {
        $proyecto = proyecto::find($id);
        $usuarios = DB::select('SELECT id,Nombre,Rut,Carga_proyecto FROM usuario WHERE Carga_proyecto < ?',[100]);
        return view('Proyectos.create_usuarios_proyecto',compact('proyecto','usuarios'));
    }

    public function storeUsuarios(Request $request,$id)
    {
        $ids = $request->get('ids');
        $cargas = $request->get('cargas');
        $cargas_totales = $request->get('cargas_totales');

        for($i = 0;$i < sizeof($ids); $i++){
            DB::update('UPDATE usuario SET Carga_proyecto = ? WHERE id = ?',[$cargas_totales[$i],$ids[$i]]);
            DB::insert('INSERT INTO usuario_proyectos (Carga,usuario_id,proyecto_id)
                                VALUES (?,?,?)',[$cargas[$i],$ids[$i],$id]);
        }
        return redirect()->route('proyectos.usuarios',compact($id));
    }

    public function destroyUsuarios($idp,$idu)
    {
        $carga = DB::select('SELECT Carga FROM usuario_proyectos WHERE usuario_id = ? AND proyecto_id = ?',[$idu,$idp]);
        $carga_total = DB::select('SELECT Carga_proyecto FROM usuario WHERE id = ?',[$idu]);
        $nueva_carga = $carga_total - $carga;
        DB::update('UPDATE usuario SET Carga_proyecto = ? WHERE id = ?',[$nueva_carga,$idu]);
        DB::delete('DELETE FROM usuario_proyectos WHERE usuario_id = ? AND proyecto_id = ?',[$idu,$idp]);
        return redirect()->route('proyectos.usuarios',compact($idp));
    }
}
