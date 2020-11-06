<?php

namespace App\Http\Controllers;

use App\cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargosController extends Controller
{
    
    public function index()
    {
        $cargos = cargo::orderBy('id','ASC')->paginate();
        return view('Cargos.index',compact('cargos'));
    }

  
    public function create()
    {
        return view('Cargos.create');
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO cargos (Tipo_cargo, Descripcion) 
                            VALUES (?,?)',[$request->get('tipo_cargo'),$request->get('descripcion')]);
        return redirect()->route('cargos.index');
    }

    public function show($id)
    {
        $cargo = cargo::find($id);
        return view('Cargos.show',compact('cargo'));
    }

  
    public function edit($id)
    {
        $cargo = cargo::find($id);
        return view('Cargos.create',compact('cargo'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE cargos SET Tipo_cargo = ?, Descripcion = ? WHERE id = ?',
            [$request->get('tipo_cargo'),$request->get('descripcion'),$id]);
        return redirect()->route('cargos.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM cargos WHERE id = ?',[$id]);
        return redirect()->route('cargos.index');
    }
}
