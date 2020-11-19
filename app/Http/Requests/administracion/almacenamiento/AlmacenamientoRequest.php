<?php

namespace App\Http\Requests\administracion\almacenamiento;

use Illuminate\Foundation\Http\FormRequest;
use App\almacenamiento;

class AlmacenamientoRequest extends FormRequest
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
            $almacenamientos = almacenamiento::all();
            if($this->route('almacenamiento')){
                foreach ($almacenamientos as $key => $almacenamiento) {
                    if($almacenamiento->Nombre == $this->Nombre && 
                        $almacenamiento->Ubicacion == $this->Ubicacion && 
                        $almacenamiento->id != $this->route('almacenamiento') ){
                            $validator->errors()->add('Nombre', 'Este nombre ya ha sido registrado para esta ubicacion');
                    }
                }
                
            }else{
                foreach ($almacenamientos as $key => $almacenamiento) {
                    if($almacenamiento->Nombre == $this->Nombre && 
                        $almacenamiento->Ubicacion == $this->Ubicacion){
                            $validator->errors()->add('Nombre', 'Este nombre ya ha sido registrado para esta ubicacion');
                    }
                }
            }
        });
    }
}
