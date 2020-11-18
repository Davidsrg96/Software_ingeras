<?php

namespace App\Http\Requests\administracion\tipoUsuario;

use Illuminate\Foundation\Http\FormRequest;

class TipoUsuarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Tipo_usuario' => 'required|unique:tipo_usuario,Tipo_usuario,' . 
                                        $this->route('tipo_usuario'),
            'Descripcion'            => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'Tipo_usuario' => 'tipo de usuario',
        ];
    }
}
