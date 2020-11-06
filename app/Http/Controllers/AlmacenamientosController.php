<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenamientosController extends Controller
{
   
    public function index()
    {
        $almacenamientos = almacenamiento::orderBy('id','ASC')->paginate();
        return view('Almacenamiento.index_almacenamiento',compact('almacenamientos'));
    }

    public function create()
    {
        return view('Almacenamiento.create_almacenamiento');
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO almacenamientos (Nombre,Ubicacion)
                                VALUES (?,?)',[$request->get('nom_almacenamiento'),
                                               $request->get('ubicacion')]);
        return redirect()->route('almacenamiento.index');
    }

    public function show($id)
    {
        $almacen = almacenamiento::find($id);
        $almacenes = DB::select('SELECT * FROM almacenamientos WHERE NOT id = ?',[$id]);
        $productos = DB::select('SELECT * FROM almacenamiento_stocks a, bodegas b, proveedors p 
                              WHERE a.almacenamiento_id = ? AND a.bodega_id = b.id AND b.proveedor_id = p.id',[$id]);
        return view('Almacenamiento.show',compact('almacen','productos','almacenes'));
    }

    public function edit($id)
    {
        $a = almacenamiento::find($id);
        return view('Almacenamiento.create_almacenamiento',compact('a'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE almacenamientos SET Nombre = ?,Ubicacion = ?
                            WHERE id = ?',[$request->get('nom_almacenamiento'),
                                           $request->get('ubicacion'),
                                           $id]);
        return redirect()->route('almacenamiento.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM almacenamientos WHERE id = ?',[$id]);
        return redirect()->route('almacenamiento.index');
    }
}
