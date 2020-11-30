<?php

namespace App\Http\Controllers;

use App\bodega;
use App\producto;
use App\proveedor;
use App\guia_despacho;
use App\tipo_usuario;
use App\usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\abastecimiento\guiaDespacho\MovimientoIndexRequest;

class GuiaDespachoController extends Controller
{

    public function index()
    {
        $guias = guia_despacho::all();
        $bodegas = bodega::all();
        return view('Abastecimiento.index_guia_despacho',compact('guias','bodegas'));
    }

    public function create(Request $request)
    {
        $id = Auth::id();
        $almacen = bodega::find($request->almacen);
        $producto = producto::all();
        $proveedores = proveedor::all();
        $solicitante = usuario::find($id);
        $usuarios = DB::select('SELECT id,Nombre FROM usuario WHERE NOT id = ?',[$id]);
        return view('Abastecimiento.create_despacho',compact('almacen','producto','proveedores','usuarios','solicitante'));
    }

    public function movimientoProducto(MovimientoIndexRequest $request, $id)
    {
        $idu = Auth::id();
        $solicitante = usuario::find($idu);
        $almacen_origen = bodega::find($id);
        $almacen_destino = bodega::find($request->bodegaID);
        $producto = DB::select('SELECT a.Cantidad_almacenada,b.id,b.Codigo,b.proveedor_id,b.Nombre_producto FROM producto b,bodega_producto a WHERE b.id = a.producto_id
                                        AND a.bodega_id = ?',[$id]);
        //dd($producto);
        $tipoID = tipo_usuario::where('tipo_usuario','Abastecimiento')->first()->id;
        $usuarios = usuario::where('tipo_usuario_id',$tipoID)
                        ->where('id','<>',$idu)->get();
        $proveedores = proveedor::all();
        return view('Abastecimiento.movimiento_bodegas',compact('almacen_origen','almacen_destino','producto','proveedores','usuarios','solicitante'));
    }


    public function store(Request $request)
    {
        //Insercion de la guia de despacho a la BDD

        $date = new DateTime('now');
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('local')->put($nombre,  \File::get($file));
        $almacen = DB::select('SELECT id,Nombre FROM bodegas WHERE Nombre = ?',[$request->get('nombre')]);
        DB::insert('INSERT INTO guia_despachos (Guia_despacho, Fecha_ingreso, bodega_id)
                            VALUES (?,?,?)',[$nombre,$date,$almacen[0]->id]);

        //UPDATE de los productos y sus cantidades y disponibles
        $codigos = $request->get('codigos');
        $cantidades = $request->get('cant');
        $proveedores = $request->get('proveedores');

        for($i = 0;$i < sizeof($codigos); $i++){
            $producto = DB::select('SELECT id,Disponible,proveedor_id FROM producto WHERE Codigo = ? AND proveedor_id = ?',[$codigos[$i],$proveedores[$i]]);
            $cant = $producto[0]->Disponible - $cantidades[$i];
            DB::update('UPDATE producto SET Disponible = ? WHERE id = ?',[$cant,$producto[0]->id]);
            //Actualizacion de almacenamiento
            DB::insert('INSERT INTO bodega_producto (cantidad_almacenada, bodega_id, producto_id) 
                                VALUES (?,?,?)',[$cantidades[$i],
                                                 $almacen[0]->id,
                                                 $producto[0]->id]);
        }

        //Envio de solicitud
        $id = Auth::id();
        $titulo = 'Guia de Despacho';
        $mensaje = 'Movimiento de articulos de stock hacia el almacen '. $almacen[0]->Nombre .' a traves de una guia de despacho';
        $destinatario = usuario::find($request->get('receptor'));
        DB::insert('INSERT INTO solicituds (Titulo,Mensaje,solicitante_id,destino_id,Fecha_inicio,Fecha_termino)
                            VALUES (?,?,?,?,?,?)', [$titulo,
                                                    $mensaje,
                                                    $id,
                                                    $destinatario->id,
                                                    $date,
                                                    $request->get('fecha_limite')]);

        return redirect()->route('guia_despacho.index');
    }

    public function devolver($id,$ida)
    {
        $cantidad = DB::select('SELECT a.Cantidad_almacenada,b.Disponible FROM bodega_producto a,bodegas b 
                                        WHERE b.id = a.producto_id AND a.bodega_id = ? AND a.producto_id = ?',[$ida,$id]);
        dd($cantidad);
        DB::delete('DELETE FROM bodega_producto WHERE producto_id = ? AND bodega_id = ?',[$id,$ida]);
        $disponible = $cantidad->Cantidad_almacenada + $cantidad->Disponible;
        DB::update('UPDATE bodega SET  Disponible = ? WHERE id = ?',[$disponible,$id]);
        return redirect()->action('BodegaController@show',$id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        //
    }

    public function updateMovimiento(Request $request, $ido, $idd)
    {
        $date = new DateTime('now');
        $file = $request->file('file');
        $nombre = $file->getClientOriginalName();
        \Storage::disk('local')->put($nombre,  \File::get($file));
        $almacen_origen = DB::select('SELECT id,Nombre FROM bodegas WHERE id = ?',[$ido]);
        $almacen_destino = DB::select('SELECT id,Nombre FROM bodegas WHERE id = ?',[$idd]);
        DB::insert('INSERT INTO guia_despachos (Guia_despacho, Fecha_ingreso, bodega_id)
                            VALUES (?,?,?)',[$nombre,$date,$almacen_origen[0]->id]);

        $ids = $request->get('ids');
        $cantidades = $request->get('cant');

        for($i = 0;$i < sizeof($ids); $i++){
            $a_s = DB::select('SELECT * FROM bodega_producto WHERE bodega_id = ? AND producto_id = ?',[$almacen_origen[0]->id,$ids[$i]]);

            if($a_s[0]->Cantidad_almacenada == $cantidades[$i]){//Si la cantidad enviada es igual a la cantidad almacenada
                DB::delete('DELETE FROM bodega_producto WHERE bodega_id = ? AND producto_id = ?',[$almacen_origen[0]->id,$ids[$i]]);
                DB::insert('INSERT INTO bodega_producto(Cantidad_almacenada, bodega_id, producto_id)
                                    VALUES (?,?,?)',[$cantidades[$i],$almacen_destino[0]->id,$ids[$i]]);

            }else{

                $cant = $a_s[0]->Cantidad_almacenada - $cantidades[$i];
                DB::update('UPDATE bodega_producto SET Cantidad_almacenada = ? WHERE bodega_id = ? 
                                      AND producto_id = ?',[$cant,$almacen_origen[0]->id,$ids[$i]]);
                $aux = DB::select('SELECT * FROM bodega_producto WHERE bodega_id = ? 
                                            AND producto_id = ?',[$almacen_destino[0]->id,$ids[$i]]);

                if($aux != null){//El producto existe en stock en el almacen de destino
                    $valor = $aux->Cantidad_almacenada + $cantidades[$i];
                    DB::update('UPDATE bodega_producto SET Cantidad_almacenada = ? WHERE bodega_id = ?
                                           AND producto_id = ?',[$valor,$almacen_destino[0]->id],$ids[$i]);
                }else{//El producto NO existe en stock en el almacen de destino
                    DB::insert('INSERT INTO bodega_producto(Cantidad_almacenada, bodega_id, producto_id)
                                        VALUES (?,?,?)',[$cantidades[$i],$almacen_destino[0]->id,$ids[$i]]);
                }
            }

        }

        //Envio de solicitud
        $id = Auth::id();
        $titulo = 'Movimiento entre bodegas';
        $mensaje = 'Movimiento de articulos de stock del almacen '.$almacen_origen[0]->Nombre.' hacia el almacen '. $almacen_destino[0]->Nombre .' a traves de una guia de despacho';
        $destinatario = usuario::find($request->get('receptor'));
        DB::insert('INSERT INTO solicituds (Titulo,Mensaje,solicitante_id,destino_id,Fecha_inicio,Fecha_termino)
                            VALUES (?,?,?,?,?,?)', [$titulo,
                                                    $mensaje,
                                                    $id,
                                                    $destinatario->id,
                                                    $date,
                                                    $request->get('fecha_limite'),]);

        return redirect()->action('BodegaController@show',$almacen_origen[0]->id);
    }

    public function destroy($id)
    {
        //
    }

    public function bodegas()
    {
        $bodegas = bodega::all();
        return view('Abastecimiento.movimiento.index',compact('bodegas'));
    }
}
