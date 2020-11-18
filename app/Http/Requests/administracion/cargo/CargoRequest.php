<?php

namespace App\Http\Requests\administracion\cargo;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Tipo_cargo' => 'required|unique:cargos,Tipo_cargo,' . 
                                        $this->route('cargo'),
            'Descripcion'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'Tipo_cargo' => 'Cargo',
        ];
    }
}
