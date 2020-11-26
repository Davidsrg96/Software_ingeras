<?php

namespace App\Http\Requests\administracion\bodega;

use Illuminate\Foundation\Http\FormRequest;
use App\bodega;

class BodegaRequest extends FormRequest
{

     public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Nombre'       => 'required',
            'Ubicacion'    => 'required',
            'encargado_id' => 'nullable',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $bodegas = bodega::all();
            if($this->route('bodega')){
                foreach ($bodegas as $key => $bodega) {
                    if($bodega->Nombre == $this->Nombre && 
                        $bodega->Ubicacion == $this->Ubicacion && 
                        $bodega->id != $this->route('bodega') ){
                            $validator->errors()->add('Nombre', 'Este nombre ya ha sido registrado para esta ubicacion');
                    }
                }
                
            }else{
                foreach ($bodegas as $key => $bodega) {
                    if($bodega->Nombre == $this->Nombre && 
                        $bodega->Ubicacion == $this->Ubicacion){
                            $validator->errors()->add('Nombre', 'Este nombre ya ha sido registrado para esta ubicacion');
                    }
                }
            }
        });
    }
}
