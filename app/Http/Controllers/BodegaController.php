<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\almacenamiento_stock;
use App\bodega;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = bodega::orderBy('id','ASC')->paginate();
        $proveedores = proveedor::all();
        $almacenes = almacenamiento::all();
        $a_s = almacenamiento_stock::all();
        return view('Abastecimiento.index_bodega', compact('producto','proveedores','almacenes','a_s'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = proveedor::all();
        return view('Abastecimiento.create_producto',compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::insert('INSERT INTO bodegas (Codigo,Nombre_producto,Precio_producto,Cantidad,proveedor_id)
                            VALUES (?,?,?,?,?)',[$request->get('codigo'),
                                                 $request->get('producto'),
                                                 $request->get('precio'),
                                                 $request->get('cantidad'),
                                                 $request->get('proveedor')]);
        return redirect()->route('bodega.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function mover(Request $request, $id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedores = proveedor::all();
        $p = bodega::find($id);
        return view('Abastecimiento.create_producto',compact('p','proveedores'));
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
        DB::update('UPDATE bodegas SET Codigo = ?,Nombre_producto = ?, Precio_producto = ?, Cantidad = ?, proveedor_id = ?
                           WHERE  id = ?',[$request->get('codigo'),
            $request->get('nom_producto'),
            $request->get('precio'),
            $request->get('cantidad'),
            $request->get('proveedor'),
            $id]);
        return redirect()->route('bodega.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete('DELETE FROM bodegas WHERE id = ?', [$id]);
        return redirect()->route('bodega.index');
    }
}
