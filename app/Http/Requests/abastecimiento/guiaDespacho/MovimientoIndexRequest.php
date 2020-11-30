<?php

namespace App\Http\Requests\abastecimiento\guiaDespacho;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoIndexRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bodegaID' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'bodegaID.required' => 'Debe seleccionar la bodega de destino',
        ];
    }
}
