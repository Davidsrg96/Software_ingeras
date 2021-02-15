<?php

namespace App\Http\Requests\abastecimiento\factura;

use Illuminate\Foundation\Http\FormRequest;

class ValidarFacturaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Estado'      => 'required',
            'Observacion' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if($this->Estado && 
                    $this->Estado != "Gestionando" &&
                    $this->Estado != "Incompleta" &&
                    $this->Estado != "Completa"){
                $validator->errors()->add('Estado', 'El valor de estado no es valido');
            }
        });
    }
}
