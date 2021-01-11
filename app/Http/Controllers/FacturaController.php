<?php

namespace App\Http\Controllers;

use App\bodega;
use App\factura;
use App\proveedor;
use App\producto;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\abastecimiento\factura\FacturaRequest;

class FacturaController extends Controller
{

    public function index()
    {
        $facturas = factura::all();
        $proveedores = proveedor::all();
        return view('Facturas.index_factura', compact('facturas', 'proveedores'));
    }



    public function create()
    {
        $proveedores = proveedor::all();
        return view('Facturas.create', compact('proveedores'));
    }

    public function store(FacturaRequest $request)
    {
        $productos = producto::all();
        $codigo = ($productos->isEmpty())? 1111111111110  : $productos->last()->Codigo;
        $factura = factura::create(
            $request->input() + [
                'Fecha_ingreso' => new DateTime('now'),
                'Estado'        => 'Gestionando'
            ]);
        foreach ($request->descP as $key => $desc) {
            for ($i = 0 ; $i < $request->cantP[$key] ; $i++) { 
                $codigo = $codigo + 1;
                $producto = producto::create([
                    'Codigo'          => $codigo,
                    'Descripcion'     => $request->descP[$key],
                    'Precio_producto' => $request->precioP[$key],
                    'proveedor_id'    => $factura->proveedor->id,
                    'factura_id'      => $factura->id
                ]);

                $documento = Storage::disk('factura')->putFile('/', $request->file('Documento'));
                $factura->update(['Documento' => $documento]);
            }
        }

        return redirect()
            ->route('factura.index')
            ->with('success', [
                'titulo'  => 'Creación de Factura',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $factura = factura::findOrFail($id);
        return view('Facturas.show', compact('factura'));
    }

    public function edit($id)
    {
        $factura = factura::findOrFail($id);
        $proveedores = proveedor::all();
        return view('Facturas.edit', compact('factura', 'proveedores'));
    }

    public function update(FacturaRequest $request, $id)
    {
        dd($request->all());
    }

    public function destroy($id)
    {

    }

    public function factura_oc($idoc,$idp)
    {
        $facturas = DB::select('SELECT id,Factura,Fecha_ingreso FROM facturas WHERE oc_id = ?',[$idoc]);
        $proveedor = proveedor::find($idp);
        return view('Facturas.index_factura', compact('facturas','proveedor','idoc'));
    }


    public function stockStore(Request $request, $id){

    }

}
