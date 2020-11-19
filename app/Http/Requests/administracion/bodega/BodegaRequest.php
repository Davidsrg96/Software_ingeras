<?php

namespace App\Http\Requests\administracion\bodega;

use Illuminate\Foundation\Http\FormRequest;

class BodegaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Codigo'          => 'required|numeric|min:0|unique:bodegas,Codigo,' . $this->route('bodega'),
            'Nombre_producto' => 'required',
            'Precio_producto' => 'required|numeric|min:0',
            'Cantidad'        => 'required|numeric|min:0',
            'proveedor_id'    => 'nullable',
        ];
    }
}
