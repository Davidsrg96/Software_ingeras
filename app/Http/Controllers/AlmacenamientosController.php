<?php

namespace App\Http\Controllers;

use App\almacenamiento;
use App\usuario;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\almacenamiento\AlmacenamientoRequest;
use App\Http\Requests\administracion\almacenamiento\AlmacenamientoDeleteRequest;

class AlmacenamientosController extends Controller
{
   
    public function index()
    {
        $almacenamientos = almacenamiento::orderBy('id','ASC')->paginate();
        return view('Almacenamiento.index_almacenamiento',compact('almacenamientos'));
    }

    public function create()
    {
        $usuarios = usuario::all();
        return view('Almacenamiento.create_almacenamiento', compact('usuarios'));
    }

    public function store(AlmacenamientoRequest $request)
    {
        almacenamiento::create($request->input());
        return redirect()
            ->route('almacenamiento.index')
            ->with('success', [
                'titulo'  => 'Creación de Almacén',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $almacen = almacenamiento::find($id);
        $almacenes = DB::select('SELECT * FROM almacenamientos WHERE NOT id = ?',[$id]);
        $productos = DB::select('SELECT * FROM almacenamiento_stocks a, bodegas b, proveedors p 
                              WHERE a.almacenamiento_id = ? AND a.bodega_id = b.id AND b.proveedor_id = p.id',[$id]);
        return view('Almacenamiento.show',compact('almacen','productos','almacenes'));
    }

    public function edit($id)
    {
        $almacenamiento = almacenamiento::findOrFail($id);
        $usuarios = usuario::all();
        return view('Almacenamiento.edit',compact('almacenamiento', 'usuarios'));
    }

    public function update(AlmacenamientoRequest $request, $id)
    {
        almacenamiento::findOrFail($id)->update($request->input());
        return redirect()
            ->route('almacenamiento.index')
            ->with('success', [
                'titulo'  => 'Actualización de Almacén',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy(AlmacenamientoDeleteRequest $request, $id)
    {
        almacenamiento::findOrFail($id)->delete();
        return redirect()
          ->route('almacenamiento.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Almacén',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
