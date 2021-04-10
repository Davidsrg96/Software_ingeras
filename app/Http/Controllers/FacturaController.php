<?php

namespace App\Http\Controllers;

use App\bodega;
use App\factura;
use App\producto;
use App\proveedor;
use App\orden_de_compra;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\abastecimiento\factura\FacturaRequest;
use App\Http\Requests\abastecimiento\factura\ValidarFacturaRequest;

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
        $ordenes     = orden_de_compra::all();
        $fecha = explode(' ', Carbon::now()->toDateTimeString())[0];
        $bodegas = bodega::all();
        return view('Facturas.create', compact('proveedores', 'ordenes','fecha', 'bodegas'));
    }

    public function store(FacturaRequest $request)
    {
        $factura = factura::create(
            $request->input() + [
                'Fecha_ingreso' => new DateTime('now'),
                'Estado'        => 'Gestionando'
            ]);
        
        if ( $request->orden_compra_id ) {
            $this->createConOrden($request, $factura);

        }else{
            $this->createSinOrden($request, $factura);
        }

        $documento = Storage::disk('factura')->putFile('/', $request->file('Documento'));
        $factura->update(['Documento' => $documento]);

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
        $factura     = factura::findOrFail($id);
        $proveedores = proveedor::all();
        $ordenes     = orden_de_compra::all();
        $fecha       = explode(' ', Carbon::now()->toDateTimeString())[0];
        $bodegas     = bodega::all(); 
        return view('Facturas.edit', compact('factura', 'proveedores', 'ordenes', 'fecha', 'bodegas'));
    }

    public function update(FacturaRequest $request, $id)
    {
        $factura = factura::findOrFail($id); 
        if( $request->orden_compra_id ){
            $this->editConOrden($request, $factura);
        }else{
            $this->editSinOrden($request, $factura);
        }
        $factura->update($request->input());

        if ($request->Documento) {
            Storage::disk('factura')->delete('/', $factura->Documento);
            $documento = Storage::disk('factura')->putFile('/', $request->file('Documento'));
            $factura->update(['Documento' => $documento]);
        }
        return redirect()
          ->route('factura.index')
          ->with('success', [
            'titulo'  => 'Actualización de Factura',
            'mensaje' => 'Actualización realizada de forma correcta',
          ]);
    }

    public function destroy($id)
    {

    }

    public function validar($id)
    {
        $factura = factura::findOrFail($id);
        return view('Facturas.validar', compact('factura'));
    }
    public function updateValidar(ValidarFacturaRequest $request, $id)
    {
        $factura = factura::findOrFail($id);
        $factura->update($request->input());
        return redirect()
          ->route('factura.show', $factura->id)
          ->with('success', [
            'titulo'  => 'Validacion de Factura',
            'mensaje' => 'Actualización realizada de forma correcta',
          ]);
    }


    private function createConOrden($request, $factura)
    {

        $codigo = (producto::all()->isEmpty())? 1111111111110  : producto::all()->last()->Codigo;
        $factura->update(['orden_compra_id' => $request->orden_compra_id]);
        $productos = orden_de_compra::findOrFail($request->orden_compra_id)->productos;

        if( !$productos->isEmpty() ){
            foreach ($request->descP as $key => $desc) {
                $contador = 0;
                if( !$productos->where('Descripcion', $desc)->isEmpty()){
                    foreach ($productos->where('Descripcion', $desc) as $producto) {
                        if( $contador > $request->cantP[$key] ){
                            break;
                        }else{
                            $producto->update(['factura_id' => $factura->id]);
                            $contador++;
                        }
                    }
                    for ($i=0; $i < ($request->cantP[$key] - $contador)  ; $i++) { 
                        $this->crearProducto($factura->id, $request, $codigo, $key);
                    }
                }else{
                    for ($i = 0 ; $i < $request->cantP[$key] ; $i++) { 
                        $this->crearProducto($factura->id, $request, $codigo, $key);
                    }
                }
            }
        }else{
            foreach ($request->descP as $key => $desc) {
                for ($i = 0 ; $i < $request->cantP[$key] ; $i++) { 
                    $this->crearProducto($factura->id, $request, $codigo, $key);
                }
            }
        }
    }

    private function createSinOrden($request, $factura)
    {
        $codigo = (producto::all()->isEmpty())? 1111111111110  : producto::all()->last()->Codigo;
        foreach ($request->descP as $key => $desc) {
            for ($i = 0 ; $i < $request->cantP[$key] ; $i++) { 
                $this->crearProducto($factura->id, $request, $codigo, $key);
            }
        }
    }

    private function editConOrden($request, $factura)
    {
        $this->eliminarInexitentes($factura, $request);
        if($factura->orden_compra_id != $request->orden_compra_id){
            foreach ($factura->productos->where('orden_compra_id','<>',null) as $producto) {
                $producto->update([
                    'factura_id' => null,
                    'bodega_id' => null
                ]);
            }

            $codigo = (producto::all()->isEmpty())? 1111111111110  : producto::all()->last()->Codigo;
            $orden  = orden_de_compra::findOrFail($request->orden_compra_id); 
            $factura = factura::findOrFail($factura->id);
            foreach ($request->descP as $key => $desc) {
                $cantProductosF = $factura
                                    ->productos
                                    ->where('Descripcion', $desc)
                                    ->where('Precio_producto', $request->cantP[$key]);
                $cantProductosO = $orden
                                    ->productos
                                    ->where('Descripcion', $desc)
                                    ->where('Precio_producto', $request->cantP[$key]);

                
                $suma = $cantProductosF->count() + $cantProductosO->count();
                if($suma < $request->cantP[$key]){
                    for ($i=0; $i < $request->cantP[$key] - $suma ; $i++) { 
                        $this->crearProducto($factura->id, $request, $codigo, $key);
                    }
                    foreach ($cantProductosO as $producto) {
                        $producto->update([
                            'factura_id' => $factura->id,
                            'bodega_id'  => $bodega
                        ]);
                    }
                }else{
                    if ($cantProductosO >= $request->cantP[$key]) {
                        foreach ($factura->productos as $producto) {
                            $producto->delete();
                        }
                        for ($i=0; $i < $request->cantP[$key] ; $i++) { 
                            $cantProductosO[$key]->update([
                                'factura_id' => $factura->id,
                                'bodega_id'  => $bodega
                            ]);
                        }
                    }else{
                        foreach ($cantProductosO as $producto) {
                            $producto->update([
                                'factura_id' => $factura->id,
                                'bodega_id'  => $bodega
                            ]);
                        }
                        for ($i=0; $i < $suma - $request->cantP[$key] ; $i++) { 
                            $cantProductosF[$key]->delete();
                        }
                    }
                }
            }
        }
    }
    private function editSinOrden($request, $factura)
    {
        foreach ($factura->productos->where('orden_compra_id','<>',null) as $producto) {
            $producto->update([
                'factura_id' => null,
                'bodega_id'  => null
            ]);
        }
        $this->eliminarInexitentes($factura, $request);
        $codigo = (producto::all()->isEmpty())? 1111111111110  : producto::all()->last()->Codigo;
        $factura = factura::findOrFail($factura->id);
        foreach ($request->descP as $key => $desc) {
            $cantProductos = $factura
                                ->productos
                                ->where('Descripcion', $desc)
                                ->where('Precio_producto', $request->precioP[$key]);
            
            if($cantProductos->count() < $request->cantP[$key]){
                for ($i=0; $i < $request->cantP[$key] - $cantProductos->count() ; $i++) { 
                    $this->crearProducto($factura->id, $request, $codigo, $key);
                }
            }else{
                for ($i=0; $i < $cantProductos->count() - $request->cantP[$key] ; $i++) { 
                    $cantProductos[$key]->delete();
                }
            }
        }
    }

    private function eliminarInexitentes($factura, $request)
    {
        foreach ($factura->productos as $producto) {
            $existe = false;
            foreach ($request->descP as $key => $desc) {
                if($producto->Descripcion == $desc && $producto->Precio_producto == $request->precioP[$key]){
                    $existe = true;
                    break;
                }
            }
            if(!$existe){
                if($producto->orden_compra_id){
                    $producto->update([
                        'factura_id' => null,
                        'bodega_id'  => null
                    ]);
                }else{
                    $producto->delete();
                }
            }
        }
    }
    private function crearProducto($id, $request, $codigo, $key)
    {
        $codigo = $codigo + 1;
        while ( producto::where('Codigo', $codigo)->count() > 0 ) {
            $codigo = $codigo + 1;
        }
        producto::create([
            'Codigo'          => $codigo,
            'Descripcion'     => $request->descP[$key],
            'Precio_producto' => $request->precioP[$key],
            'proveedor_id'    => $request->proveedor_id,
            'factura_id'      => $id,
            'bodega_id'       => $request->bodega,
        ]);
    }

}
