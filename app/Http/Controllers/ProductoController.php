<?php

namespace App\Http\Controllers;

use App\producto;
use App\bodega;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\producto\ProductoRequest;
use App\Http\Requests\administracion\producto\ProductoDeleteRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = producto::all()->sortBy('Nombre_producto');
        return view('Producto.index', compact('productos'));
    }

    public function create()
    {
        $proveedores = proveedor::all();
        return view('Producto.create',compact('proveedores'));
    }

   
    public function store(ProductoRequest $request)
    {
        $productos = producto::all();
        $codigo = ($productos->isEmpty())? 1111111111110 : $productos->last()->Codigo;
        for ($i = 0; $i < $request->Cantidad ; $i ++) {
            $codigo = $codigo + 1;
            producto::create(
                $request->input() + [
                    'Estado' => 'Disponible',
                    'Codigo' => $codigo
                ]);
        }
        return redirect()
            ->route('producto.index')
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
        $producto = producto::find($id);
        return view('Producto.edit',compact('producto','proveedores'));
    }

    public function update(ProductoRequest $request, $id)
    {
        producto::findOrFail($id)->update($request->input());
        return redirect()
            ->route('producto.index')
            ->with('success', [
                'titulo'  => 'Actualización de Producto',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy(ProductoDeleteRequest $request, $id)
    {
        producto::findOrFail($id)->delete();
        return redirect()
          ->route('producto.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Producto',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
