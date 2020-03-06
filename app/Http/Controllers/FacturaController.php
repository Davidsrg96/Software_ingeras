<?php

namespace App\Http\Controllers;

use App\bodega;
use App\factura;
use App\proveedor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $facturas = factura::orderBy('id','ASC')->paginate();
        $proveedores = proveedor::all();
        return view('Facturas.index_factura', compact('facturas', 'proveedores'));
    }

    public function factura_oc($idoc,$idp)
    {
        $facturas = DB::select('SELECT id,Factura,Fecha_ingreso FROM facturas WHERE oc_id = ?',[$idoc]);
        $proveedor = proveedor::find($idp);
        return view('Facturas.index_factura', compact('facturas','proveedor','idoc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $proveedor = proveedor::find($request->get('prov'));
        if($request->get('oc_id') != null){
            $oc_id = $request->get('oc_id');
            return view('Facturas.create_factura',compact('proveedor','oc_id'));
        }else{
            return view('Facturas.create_factura',compact('proveedor'));
        }
    }


    /**
     * Store a newly created resource in storage.
     *exit
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = DB::select('SELECT id FROM proveedors WHERE Nombre_proveedor = ?',[$request->get('proveedor')]);
        $idp = $proveedor[0]->id;
        $date = new DateTime('now');
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('local')->put($nombre,  \File::get($file));
        $this->stockStore($request,$idp);
        //Antes de guardar la factura se confirma si pertenece a una orden de compra o no
        if($request->get('oc_id') != null){
            $idoc = $request->get('oc_id');
            DB::insert('INSERT INTO facturas (Factura,Fecha_ingreso,oc_id,proveedor_id)
                            VALUES (?,?,?,?)',[$nombre,
                                               $date,
                                               $idoc,
                                               $idp]);
            return redirect()->route('factura.oc',compact('idoc','idp'));
        }else{
            DB::insert('INSERT INTO facturas (Factura,Fecha_ingreso,proveedor_id)
                            VALUES (?,?,?)',[$nombre,
                                             $date,
                                             $idp]);
            return redirect()->route('facturas.index');
        }


    }

    public function stockStore(Request $request, $idp){
        //Validar que siempre existan productos en facturas
        $codigos = $request->get('codigo');
        $nombres = $request->get('nom_producto');
        $precios = $request->get('precio');
        $cantidades = $request->get('cantidad');

        for($i = 0;$i < sizeof($codigos); $i++){
            //Si encuentra el codigo dentro de los productos entra a verificar si es del mismo proveedor
            $pr = DB::select('SELECT * FROM bodegas WHERE Codigo = ? AND proveedor_id = ?',[$codigos[$i],$idp]);
            $npr = DB::select('SELECT * FROM bodegas WHERE Codigo = ? AND NOT proveedor_id = ?',[$codigos[$i],$idp]);
            //Si encuentra el producto ya en bodega central
            if($pr != null && $npr == null){
                $producto = bodega::where('Codigo', '=', $codigos[$i])->get()->first();
                $cantidades[$i] = $producto->Cantidad + $cantidades[$i];
                $disponible = $producto->Disponible + $cantidades[$i];
                DB::update('UPDATE bodegas SET Cantidad = ?, Disponible = ? WHERE Codigo = ?',[$cantidades[$i],$disponible,$codigos[$i]]);
            }elseif($npr != null){//Si encuentra el codigo pero no el proveedor
                DB::insert('INSERT INTO bodegas (Codigo,Nombre_producto,Precio_producto,Cantidad,Disponible,proveedor_id)
                            VALUES (?,?,?,?,?,?)',[$codigos[$i],
                    $nombres[$i],
                    $precios[$i],
                    $cantidades[$i],
                    $cantidades[$i],
                    $idp]);
            }else{//Si no encuentra nada del producto en la BDD
                DB::insert('INSERT INTO bodegas (Codigo,Nombre_producto,Precio_producto,Cantidad,Disponible,proveedor_id)
                            VALUES (?,?,?,?,?,?)',[$codigos[$i],
                    $nombres[$i],
                    $precios[$i],
                    $cantidades[$i],
                    $cantidades[$i],
                    $idp]);
            }
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
