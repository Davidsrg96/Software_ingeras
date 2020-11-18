<?php

namespace App\Http\Requests\administracion\tipoUsuario;

use Illuminate\Foundation\Http\FormRequest;
use App\tipo_usuario;

class TipoUsuarioDeleteRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!tipo_usuario::findOrFail($this->route('tipo_usuario'))->usuarios->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Tipo de Usuario',
                    'mensaje' => 'No es posible eliminar debido a que posee usuarios asociados'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
