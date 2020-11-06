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
  
    public function index()
    {
        $producto = bodega::orderBy('id','ASC')->paginate();
        $proveedores = proveedor::all();
        $almacenes = almacenamiento::all();
        $a_s = almacenamiento_stock::all();
        return view('Abastecimiento.index_bodega', compact('producto','proveedores','almacenes','a_s'));
    }

    public function create()
    {
        $proveedores = proveedor::all();
        return view('Abastecimiento.create_producto',compact('proveedores'));
    }

   
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

    public function show($id)
    {
        //
    }

    public function mover(Request $request, $id){

    }

    public function edit($id)
    {
        $proveedores = proveedor::all();
        $p = bodega::find($id);
        return view('Abastecimiento.create_producto',compact('p','proveedores'));
    }

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

    public function destroy($id)
    {
        DB::delete('DELETE FROM bodegas WHERE id = ?', [$id]);
        return redirect()->route('bodega.index');
    }
}
