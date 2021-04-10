<?php

namespace App\Http\Controllers;

use App\trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrabajadoresController extends Controller
{

    public function index()
    {
        $trabajadores = trabajador::orderBy('id','ASC')->paginate();
        return view('Trabajadores.index',compact('trabajadores'));
    }

    public function create()
    {
        return view('Trabajadores.create');
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO trabajadors (Nombre,Rut)
                            VALUES (?,?)',[$request->get('nombre'),$request->get('rut')]);
        return redirect()->route('trabajadores.index');
    }

    public function show($id)
    {
        $trabajador = trabajador::find($id);
        return view('Trabajadores.show',compact('trabajador'));
    }

    public function edit($id)
    {
        $t = trabajador::find($id);
        return view('Trabajadores.create',compact('t'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE trabajadors SET Nombre = ?, Rut = ? WHERE id = ?',
                            [$request->get('nombre'),$request->get('rut'),$id]);
        return redirect()->route('trabajadores.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM trabajadors WHERE id = ?',[$id]);
        return redirect()->route('trabajadores.index');
    }
}
