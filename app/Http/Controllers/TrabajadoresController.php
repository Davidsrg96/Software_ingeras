<?php

namespace App\Http\Controllers;

use App\trabajador;
use App\usuario;
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
        $users = usuario::all();
        foreach ($users as $usuario){
            $usuarios[] = [
                'id'           => $usuario->id,
                'rut'          => $usuario->Rut,
                'nombre'       => $usuario->getNombreCompleto(),
                'ciudad'       => $usuario->ciudad->Nombre,
                'correo'       => $usuario->email,
                'tipo_usuario' => $usuario->tipo_usuario->Tipo_usuario,
                'cargo'        => $usuario->cargo? $usuario->cargo->Tipo_cargo : 'Sin asignar',
            ];
        }
        return view('Trabajadores.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        return redirect()->route('trabajadores.index');
    }

    public function show($id)
    {
        $trabajador = trabajador::find($id);
        return view('Trabajadores.show',compact('trabajador'));
    }

    public function edit($id)
    {
        $trabajador = trabajador::findOrFail($id);
        return view('Trabajadores.create',compact('trabajador'));
    }

    public function update(Request $request, $id)
    {
        dd($id);

        return redirect()->route('trabajadores.index');
    }

    public function destroy($id)
    {
        dd($id);
        return redirect()->route('trabajadores.index');
    }
}
