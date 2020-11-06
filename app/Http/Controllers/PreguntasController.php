<?php

namespace App\Http\Controllers;

use App\pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        DB::insert('INSERT INTO preguntas (Pregunta, Tipo_pregunta)
                            VALUES (?,?)',[$request->get('pregunta'),$request->get('tipo_pregunta')]);
        return redirect()->route('preguntas.index');
    }

    public function show($id)
    {
        $pregunta = pregunta::find($id);
        return view('Preguntas.show',compact('pregunta'));
    }

    public function edit($id)
    {
        $pregunta = pregunta::find($id);
        return view('Preguntas.create',compact('pregunta'));
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE preguntas SET Pregunta = ?, Tipo_pregunta = ?
                            WHERE id = ?',[$request->get('pregunta'),$request->get('tipo_pregunta'),$id]);
        return redirect()->route('preguntas.index');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM preguntas WHERE id = ?',[$id]);
        return redirect()->route('preguntas.index');
    }
}
