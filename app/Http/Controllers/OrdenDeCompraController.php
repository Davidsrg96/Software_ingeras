<?php

namespace App\Http\Controllers;


use App\orden_de_compra;
use App\proveedor;
use App\producto;
use App\factura;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\abastecimiento\ordenCompra\OrdenCompraRequest;
use App\Http\Requests\abastecimiento\ordenCompra\DeleteOrdenCompraRequest;

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
        $fecha = explode(' ', Carbon::now()->toDateTimeString())[0];
        return view('Orden_compra.create',compact('proveedores', 'fecha'));
    }

    public function store(OrdenCompraRequest $request)
    {
        $productos = producto::all();
        $codigo = ($productos->isEmpty())? 1111111111110  : $productos->last()->Codigo;
        $orden = orden_de_compra::create( $request->input() );
        foreach ($request->descP as $key => $desc) {
            for ($i = 0 ; $i < $request->cantP[$key] ; $i++) {
                
                $codigo = $codigo + 1;
                while ( producto::where('Codigo', $codigo)->count() > 0 ) {
                    $codigo = $codigo + 1;
                }
                $producto = producto::create([
                    'Codigo'          => $codigo,
                    'Descripcion'     => $request->descP[$key],
                    'Precio_producto' => $request->precioP[$key],
                    'proveedor_id'    => $orden->proveedor->id,
                    'orden_compra_id' => $orden->id
                ]);

            }
        }
        $documento = Storage::disk('ordenCompra')->putFile('/', $request->file('Documento'));
        $orden->update(['Documento' => $documento]);

        return redirect()
            ->route('orden_de_compra.index')
            ->with('success', [
                'titulo'  => 'Creación de Orden de Compra',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $orden = orden_de_compra::findOrFail($id);
        return view('Orden_compra.show', compact('orden'));
    }

    public function edit($id)
    {
        $ordenCompra = orden_de_compra::findOrFail($id);
        $factura = factura::where('orden_compra_id',$ordenCompra->id)->first();
        $proveedores = proveedor::all();
        return view('Orden_compra.edit',compact('ordenCompra','proveedores','factura'));
    }

    public function update(OrdenCompraRequest $request, $id)
    {
        $orden = orden_de_compra::findOrFail($id);
        $factura = factura::where('orden_compra_id', $orden->id)->first();
        $productos = $orden->productos;

        $orden->update($request->input());
        if ($request->Documento) {
            Storage::disk('ordenCompra')->delete('/', $orden->Documento);
            $documento = Storage::disk('ordenCompra')->putFile('/', $request->file('Documento'));
            $orden->update(['Documento' => $documento]);
        }
        foreach ($request->descP as $key => $descripcion) {
            $productOrden = $productos->where('Descripcion', $descripcion);
            $diferencia = 0;
            //Si existen productos con la misma descripcion
            if( !$productOrden->isEmpty() ){
                $productoFactura = 0;
                if($productOrden->count() < $request->cantP[$key]){
                    $codigo = (producto::all()->isEmpty())? 1111111111110  : $productos->last()->Codigo;
                    $cantidad = $request->cantP[$key] - $productOrden->count();
                    if ( $factura ) {
                        $productoFactura = $factura->productos
                                                        ->where('Descripcion', $descripcion)
                                                        ->where('orden_compra_id',null)->get();
                        $diferencia = $productoFactura->count() - $cantidad;
                    }

                    for ($i = 0 ; $i < $cantidad ; $i++) {
                        if( $diferencia >= $cantidad ){
                            $productoFactura[$i]->update(['orden_compra_id' => $orden->id]);
                            $diferencia ++;

                        }else{
                            $codigo = $codigo + 1;
                            while ( producto::where('Codigo', $codigo)->count() > 0 ) {
                                $codigo = $codigo + 1;
                            }
                            $producto = producto::create([
                                'Codigo'          => $codigo,
                                'Descripcion'     => $request->descP[$key],
                                'Precio_producto' => $request->precioP[$key],
                                'proveedor_id'    => $orden->proveedor->id,
                                'orden_compra_id' => $orden->id
                            ]);
                        }

                    }
                }else{
                    if( $productOrden->count() > $request->cantP[$key] ){
                        $cantidad = $productOrden->count() - $request->cantP[$key];
                        if ( $factura ) {
                            $productoFactura = $factura->productos
                                                            ->where('Descripcion', $descripcion)
                                                            ->where('orden_compra_id',$orden->id)->get();
                            $diferencia = $productoFactura->count() - $cantidad;
                        }
                        for ($i = 0 ; $i < $cantidad ; $i++) {
                            if( $diferencia >= $cantidad ){
                                $productoFactura[$i]->update(['orden_compra_id' => null ]);
                            }else{
                                $productOrden[$i]->delete();
                            }
                        }
                    }
                }
            }else{
                $codigo = (producto::all()->isEmpty())? 1111111111110  : producto::all()->last()->Codigo;
                for ($i = 0 ; $i < $request->cantP[$key] ; $i++) {
                    $codigo = $codigo + 1;
                    while ( producto::where('Codigo', $codigo)->count() > 0 ) {
                        $codigo = $codigo + 1;
                    }
                    $producto = producto::create([
                        'Codigo'          => $codigo,
                        'Descripcion'     => $request->descP[$key],
                        'Precio_producto' => $request->precioP[$key],
                        'proveedor_id'    => $orden->proveedor->id,
                        'orden_compra_id' => $orden->id
                    ]);
                }
            }
        }
        return redirect()
            ->route('orden_de_compra.index')
            ->with('success', [
                'titulo'  => 'Actualización de Orden de Compra',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
        
    }

    public function destroy(DeleteOrdenCompraRequest $request, $id)
    {
        dd($request->all());
    }
}
