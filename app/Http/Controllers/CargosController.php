<?php

namespace App\Http\Controllers;

use App\cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\cargo\CargoRequest;
use App\Http\Requests\administracion\cargo\CargoDeleteRequest;

class CargosController extends Controller
{
    
    public function index()
    {
        $cargos = cargo::all()->sortBy('Tipo_cargo');
        return view('cargos.index',compact('cargos'));
    }

  
    public function create()
    {
        return view('cargos.create');
    }

    public function store(CargoRequest $request)
    {
        
        cargo::create($request->input());
        return redirect()
            ->route('cargos.index')
            ->with('success', [
                'titulo'  => 'Creación de Cargo',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $cargo = cargo::find($id);
        return view('cargos.show',compact('cargo'));
    }

  
    public function edit($id)
    {
        $cargo = cargo::find($id);
        return view('cargos.edit', compact('cargo'));
    }

    public function update(CargoRequest $request, $id)
    {
        cargo::findOrFail($id)->update($request->input());
        
        return redirect()
          ->route('cargos.index')
          ->with('success', [
            'titulo'  => 'Actualización de Cargo',
            'mensaje' => 'Actualización realizada de forma correcta',
          ]);
    }

    public function destroy(CargoDeleteRequest $request, $id)
    {
        cargo::findOrFail($id)->delete();
        
        return redirect()
          ->route('cargos.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Tipo de Usuario',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
