<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almacenamientos = almacenamiento::orderBy('id','ASC')->paginate();
        return view('Almacenamiento.index_almacenamiento',compact('almacenamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Almacenamiento.create_almacenamiento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('INSERT INTO almacenamientos (Nombre,Ubicacion)
                                VALUES (?,?)',[$request->get('nom_almacenamiento'),
                                               $request->get('ubicacion')]);
        return redirect()->route('almacenamiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $almacen = almacenamiento::find($id);
        $almacenes = DB::select('SELECT * FROM almacenamientos WHERE NOT id = ?',[$id]);
        $productos = DB::select('SELECT * FROM almacenamiento_stocks a, bodegas b, proveedors p 
                              WHERE a.almacenamiento_id = ? AND a.bodega_id = b.id AND b.proveedor_id = p.id',[$id]);
        return view('Almacenamiento.show',compact('almacen','productos','almacenes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $a = almacenamiento::find($id);
        return view('Almacenamiento.create_almacenamiento',compact('a'));
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
        DB::update('UPDATE almacenamientos SET Nombre = ?,Ubicacion = ?
                            WHERE id = ?',[$request->get('nom_almacenamiento'),
                                           $request->get('ubicacion'),
                                           $id]);
        return redirect()->route('almacenamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('DELETE FROM almacenamientos WHERE id = ?',[$id]);
        return redirect()->route('almacenamiento.index');
    }
}
