<?php

namespace App\Http\Controllers;

use App\actividad;
use App\departamento;
use App\departamento_actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\administracion\departamento\DepartamentoRequest;

class DepartamentosController extends Controller
{
    
    public function index()
    {
        $departamentos = departamento::orderBy('id','ASC')->paginate();
        return view('Departamentos.index_depto', compact('departamentos'));
    }

    public function create()
    {
        return view('Departamentos.create_depto');
    }

    public function store(DepartamentoRequest $request)
    {
        departamento::create($request->input());

        return redirect()
          ->route('departamentos.index')
          ->with('success', [
            'titulo'  => 'Creación de Departamento',
            'mensaje' => 'Creación realizada de forma correcta',
          ]);
    }

    public function show($id)
    {
        $d = departamento::find($id);
        return view('Departamentos.show_depto', compact(['id', 'd']));
    }

    public function edit($id)
    {
        $depto = departamento::findOrFail($id);
        return view('Departamentos.edit_depto',compact('depto'));
    }
  
    public function update(DepartamentoRequest $request, $id)
    {
        departamento::findOrFail($id)->update($request->input());
        return redirect()
          ->route('departamentos.index')
          ->with('success', [
            'titulo'  => 'Actualización de Departamento',
            'mensaje' => 'Actualización realizada de forma correcta',
        ]);
    }

    public function destroy($id)
    {
        // DB::delete('DELETE FROM departamento WHERE id = ?',[$id]);
        return redirect()
          ->route('departamentos.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Departamento',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    } 

    public function editActividades($id)
    {
        $depto = departamento::find($id);

        $act = actividad::all();
        foreach ($act as $actividad){
            $actividades[] = [
                'id'     => $actividad->id,
                'nombre' => $actividad->Nombre_actividad,
                'desc'   => $actividad->Descripcion,
                'kp'     => $actividad->KPI,
            ];
        }

        return view('Departamentos.editActividades',compact('depto','actividades'));
    }
    public function updateActividades(Request $request, $id)
    {
        dd($request->all());
        return redirect()
          ->route('departamentos.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Departamento',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
