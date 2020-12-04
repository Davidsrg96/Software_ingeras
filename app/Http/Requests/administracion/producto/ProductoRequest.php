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
            'Codigo'          => ($this->route('producto'))? 'required|unique:producto,Codigo,'
                                    . $this->route('producto') : '',
            'Descripcion'     => 'required',
            'Precio_producto' => 'required|numeric|min:0',
            'Cantidad'        => ($this->route('producto'))? '' : 'required|numeric|min:0',
            'Tipo_producto'   => 'required',
            'proveedor_id'    => 'nullable',
        ];
    }
}
