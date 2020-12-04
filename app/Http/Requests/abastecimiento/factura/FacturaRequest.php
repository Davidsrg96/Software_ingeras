<?php

namespace App\Http\Requests\abastecimiento\factura;

use Illuminate\Foundation\Http\FormRequest;

class FacturaRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Numero'       => 'required|numeric|min:0|unique:facturas,Numero,'. 
                                    $this->route('factura'). ',id,proveedor_id,' . $this->proveedor_id,
            'proveedor_id' => 'required',
            'Documento'    => 'required|mimes:pdf',
            'descP'        => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'Numero'       => 'número de factura',
            'proveedor_id' => 'proveedor',
        ];
    }

    public function messages()
    {
        return [
            'descP.required' => 'Debe ingresar productos',
        ];
    }
}
