<?php

namespace App\Http\Controllers;

use App\pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\pregunta\PreguntaRequest;

class PreguntasController extends Controller
{

    public function index()
    {
        $preguntas = pregunta::orderBy('id','ASC')->paginate();
        return view('Preguntas.index',compact('preguntas'));
    }

    public function create()
    {
        return view('Preguntas.create');
    }

    public function store(PreguntaRequest $request)
    {
        pregunta::create($request->input());
        return redirect()
            ->route('preguntas.index')
            ->with('success', [
                'titulo'  => 'Creación de Pregunta',
                'mensaje' => 'Creación realizada de forma correcta',
            ]);
    }

    public function show($id)
    {
        $pregunta = pregunta::find($id);
        return view('Preguntas.show',compact('pregunta'));
    }

    public function edit($id)
    {
        $pregunta = pregunta::find($id);
        return view('Preguntas.edit', compact('pregunta'));
    }

    public function update(PreguntaRequest $request, $id)
    {
        pregunta::findOrFail($id)->update($request->input());
        return redirect()
            ->route('preguntas.index')
            ->with('success', [
                'titulo'  => 'Actualización de Pregunta',
                'mensaje' => 'Actualización realizada de forma correcta',
            ]);
    }

    public function destroy($id)
    {
        dd($id);
        pregunta::findOrFail($id)->delete();
        return redirect()
          ->route('preguntas.index')
          ->with('success', [
            'titulo'  => 'Eliminación de Producto',
            'mensaje' => 'Eliminación realizada de forma correcta',
        ]);
    }
}
