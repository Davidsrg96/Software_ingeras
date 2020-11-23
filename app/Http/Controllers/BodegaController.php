<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\bodega;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\bodega\BodegaRequest;
use App\Http\Requests\administracion\bodega\BodegaDeleteRequest;

class BodegaController extends Controller
{
  
    public function index()
    {
        $productos = bodega::orderBy('id','ASC')->paginate();
        return view('Bodega.index_bodega', compact('productos'));
    }

    public function create()
    {
        $proveedores = proveedor::all();
        return view('Bodega.create_producto',compact('proveedores'));
    }

   
    public function store(BodegaRequest $request)
    {
        bodega::create($request->input());
        return redirect()
            ->route('bodega.index')
            ->with('success', [
                'titulo'  => 'Creación de Producto',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
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
        $producto = bodega::find($id);
        return view('Bodega.edit',compact('producto','proveedores'));
    }

    public function update(BodegaRequest $request, $id)
    {
        bodega::findOrFail($id)->update($request->input());
        return redirect()
            ->route('bodega.index')
            ->with('success', [
                'titulo'  => 'Actualización de Producto',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy(BodegaDeleteRequest $request, $id)
    {
        bodega::findOrFail($id)->delete();
        return redirect()
          ->route('bodega.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Producto',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
