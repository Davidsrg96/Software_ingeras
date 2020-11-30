<?php

namespace App\Http\Controllers;

use App\Repositories\ProveedorRepository;
use App\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\proveedor\ProveedorRequest;
use App\Http\Requests\administracion\proveedor\ProveedorDeleteRequest;

class  ProveedoresController extends Controller
{

    public function index()
    {
        $proveedores = proveedor::all();
        return view('Proveedores.index_proveedores', compact('proveedores'));
    }

    public function create()
    {
        return view('Proveedores.create_proveedores');
    }

    public function store(ProveedorRequest $request)
    {
        proveedor::create($request->input());
        return redirect()
            ->route('proveedores.index')
            ->with('success', [
                'titulo'  => 'Creación de Proveedor',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $proveedor = proveedor::find($id);
        return view('Proveedores.edit', compact('proveedor'));
    }

    public function update(ProveedorRequest $request, $id)
    {
        proveedor::findOrFail($id)->update($request->input());
        return redirect()
            ->route('proveedores.index')
            ->with('success', [
                'titulo'  => 'Actualización de Proveedor',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy(ProveedorDeleteRequest $request, $id)
    {
        proveedor::findOrFail($id)->delete();
        return redirect()
            ->route('proveedores.index')
            ->with('success', [
                'titulo'  => 'Eliminación de Proveedor',
                'mensaje' => 'Eliminación realizada de forma correcta',
            ]);
    }
}
