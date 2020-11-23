<?php

namespace App\Http\Requests\proyecto;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Nombre_proyecto'     => 'required|unique:proyectos,Nombre_proyecto,' . $this->route('proyecto'),
            'Fecha_inicio'        => 'required|date',
            'Fecha_termino'       => 'required|date',
            'Presupuesto_oferta'  => 'required|numeric|min:0',
            'Presupuesto_control' => 'required|numeric|min:0',
            'encargado_id'        => 'nullable',
        ];
    }
}
