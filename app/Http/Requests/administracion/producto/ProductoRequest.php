<?php

namespace App\Http\Requests\administracion\producto;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Codigo'          => 'required|numeric|min:0|unique:producto,Codigo,' . $this->route('producto'),
            'Nombre_producto' => 'required',
            'Precio_producto' => 'required|numeric|min:0',
            'Cantidad'        => 'required|numeric|min:0',
            'Tipo_producto'   => 'required',
            'proveedor_id'    => 'nullable',
        ];
    }
}
