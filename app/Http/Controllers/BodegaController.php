<?php

namespace App\Http\Controllers;

use App\bodega;
use App\usuario;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\bodega\BodegaRequest;
use App\Http\Requests\administracion\bodega\BodegaDeleteRequest;

class BodegaController extends Controller
{
  
    public function index()
    {
        $bodegas = bodega::all()->sortBy('Nombre');
        return view('Bodega.index',compact('bodegas'));
    }

    public function create()
    {
        $usuarios = usuario::all();
        return view('Bodega.create', compact('usuarios'));
    }

    public function store(BodegaRequest $request)
    {
        bodega::create($request->input());
        return redirect()
            ->route('bodega.index')
            ->with('success', [
                'titulo'  => 'Creación de Bodega',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $bodega = bodega::find($id);
        $bodegas = DB::select('SELECT * FROM bodegas WHERE NOT id = ?',[$id]);
        $productos = $bodega->productos;
        return view('Bodega.show',compact('bodega','bodegas','productos'));
    }

    public function edit($id)
    {
        $bodega = bodega::findOrFail($id);
        $usuarios = usuario::all();
        return view('Bodega.edit',compact('bodega', 'usuarios'));
    }

    public function update(BodegaRequest $request, $id)
    {
        bodega::findOrFail($id)->update($request->input());
        return redirect()
            ->route('bodega.index')
            ->with('success', [
                'titulo'  => 'Actualización de Bodega',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy(BodegaDeleteRequest $request, $id)
    {
        bodega::findOrFail($id)->delete();
        return redirect()
          ->route('bodega.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Bodega',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
