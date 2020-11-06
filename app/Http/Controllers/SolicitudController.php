<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\bodega;
use App\proveedor;
use App\Solicitud;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{

    public function index()
    {
        $id = Auth::id();
        $pendientes = DB::select('SELECT * FROM solicituds WHERE (solicitante_id = ? OR destino_id = ?) AND Status = ?',[$id,$id,'Pendiente']);
        $solicitudes = DB::select('SELECT * FROM solicituds WHERE (solicitante_id = ? OR destino_id = ?) AND NOT Status = ?',[$id,$id,'Pendiente']);
        $usuarios = DB::select('SELECT id,Nombre FROM usuario');
        return view('Solicitudes.index',compact('pendientes','usuarios', 'solicitudes'));
    }

    public function create()
    {
        $id = Auth::id();
        $usuarios = DB::select('SELECT id,Nombre FROM usuario WHERE NOT id = ?',[$id]);
        return view('Solicitudes.create',compact('usuarios'));
    }

    public function crearSolicitudBodega($ida)
    {
        $id = Auth::id();
        $solicitud = 'Solicitud a bodega';
        $almacen_local = almacenamiento::find($ida);
        $usuarios = DB::select('SELECT u.id,u.Nombre FROM usuario u,cargos c WHERE u.cargo_id = c.id
                                        AND c.Tipo_cargo = ? AND NOT u.id = ? ',['Abastecimiento',$id]);
        $proveedores = proveedor::all();
        $productos = bodega::all();
        return view('Solicitudes.create',compact('usuarios','almacen_local','productos','proveedores','solicitud'));
    }

    public function crearSolicitudMovimiento($ida)
    {
        $id = Auth::id();
        $solicitud = 'Solicitud a almacen';
        $almacen_local = almacenamiento::find($ida);
        $usuarios = DB::select('SELECT u.id,u.Nombre FROM usuario u,cargos c WHERE u.cargo_id = c.id
                                        AND c.Tipo_cargo = ? AND NOT u.id = ? ', ['Abastecimiento', $id]);
        $almacenes = DB::select('SELECT * FROM almacenamientos WHERE NOT id = ?', [$id]);
        $productos = DB::select('SELECT b.id,b.Codigo,b.Nombre_producto, a.Cantidad_almacenada,al.Nombre, p.Nombre_proveedor
                                        FROM bodegas b, almacenamiento_stocks a, almacenamientos al, proveedors p
                                        WHERE b.id = a.bodega_id AND b.proveedor_id = p.id
                                        AND al.id = a.almacenamiento_id AND NOT al.id = ?', [$id]);
        return view('Solicitudes.create',compact('usuarios','almacen_local','productos','solicitud','almacenes'));
    }

    public function store(Request $request)
    {
        $id = Auth::id();
        $date = new DateTime('now');
        $ida = $request->get('almacen_id');
        if($request->get('tipo_solicitud')  != null){
            DB::insert('INSERT INTO solicituds (Titulo,Mensaje,solicitante_id,destino_id,Fecha_inicio,Fecha_termino,Tipo_solicitud)
                            VALUES (?,?,?,?,?,?,?)',[$request->get('titulo'),
                $request->get('mensaje'),
                $id,
                $request->get('destino'),
                $date,
                $request->get('fecha_limite'),
                $request->get('tipo_solicitud')]);
            return redirect()->route('almacenamiento.show',$ida);
        }else{
            DB::insert('INSERT INTO solicituds (Titulo,Mensaje,solicitante_id,destino_id,Fecha_inicio,Fecha_termino)
                            VALUES (?,?,?,?,?,?)',[$request->get('titulo'),
                $request->get('mensaje'),
                $id,
                $request->get('destino'),
                $date,
                $request->get('fecha_limite')]);
            return redirect()->route('solicitudes.index');
        }


    }

    public function show($id)
    {
        $solicitud = solicitud::find($id);
        $solicitante = DB::select('SELECT u.id,u.Nombre FROM usuario u, solicituds s WHERE s.id = ? AND u.id = s.solicitante_id',[$id]);
        $destinatario = DB::select('SELECT u.id,u.Nombre FROM usuario u, solicituds s WHERE s.id = ? AND u.id = s.destino_id',[$id]);
        return view('Solicitudes.show',compact('solicitud','solicitante','destinatario'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE solicituds SET Status = ? WHERE id = ?',[$request->get('status'),$id]);
        return redirect()->route('solicitudes.show',$id);
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM solicituds WHERE id = ?',[$id]);
        return back();
    }
}
