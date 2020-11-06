<?php

namespace App\Http\Controllers;


use App\orden_de_compra;
use App\proveedor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenDeCompraController extends Controller
{

    public function index()
    {
        $orden_compra = orden_de_compra::orderBy('id','ASC')->paginate();
        $proveedores = proveedor::all();
        return view('Abastecimiento.index_orden_de_compra', compact('orden_compra', 'proveedores'));
    }

    public function create()
    {
        $proveedores = proveedor::all();
        return view('Abastecimiento.create_orden_de_compra',compact('proveedores'));
    }

    public function store(Request $request)
    {
        $date = new DateTime('now');
        //obtenemos el campo file definido en el formulario
        $file = $request->file('file');
        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();
        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre,  \File::get($file));
        DB::insert('INSERT INTO orden_de_compras (Orden_De_compra, Fecha_ingreso, proveedor_id) 
                            VALUES (?,?,?)',[$nombre,
                                             $date,
                                             $request->get('proveedor')]);
        return redirect()->route('orden_de_compra.index');
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
