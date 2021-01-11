<?php

namespace App\Http\Controllers;


use App\orden_de_compra;
use App\proveedor;
use App\producto;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdenDeCompraController extends Controller
{

    public function index()
    {
        $ordenes = orden_de_compra::all();
        return view('Orden_compra.index', compact('ordenes'));
    }

    public function create()
    {
        $proveedores = proveedor::all();
        return view('Orden_compra.create',compact('proveedores'));
    }

    public function store(Request $request)
    {
        $productos = producto::all();
        $codigo = ($productos->isEmpty())? 1111111111110  : $productos->last()->Codigo;
        $orden = orden_de_compra::create(
            $request->input() + [
                'Fecha_ingreso' => new DateTime('now'),
            ]);
        foreach ($request->descP as $key => $desc) {
            for ($i = 0 ; $i < $request->cantP[$key] ; $i++) { 
                $codigo = $codigo + 1;
                $producto = producto::create([
                    'Codigo'          => $codigo,
                    'Descripcion'     => $request->descP[$key],
                    'Precio_producto' => $request->precioP[$key],
                    'proveedor_id'    => $orden->proveedor->id,
                    'orden_compra_id' => $orden->id
                ]);

                $documento = Storage::disk('ordenCompra')->putFile('/', $request->file('Documento'));
                $orden->update(['Documento' => $documento]);
            }
        }

        return redirect()
            ->route('orden_de_compra.index')
            ->with('success', [
                'titulo'  => 'Creación de Orden de Compra',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
