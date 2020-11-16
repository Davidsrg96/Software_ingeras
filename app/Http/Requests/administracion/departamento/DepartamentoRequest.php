<?php

namespace App\Http\Requests\administracion\departamento;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Nombre_departamento' => 'required|unique:departamento,Nombre_departamento,' . 
                                        $this->route('departamento'),
            'Objetivo'            => 'required',
        ];
    }
}
