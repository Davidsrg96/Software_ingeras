<?php

namespace App\Http\Requests\administracion\almacenamiento;

use Illuminate\Foundation\Http\FormRequest;
use App\almacenamiento;

class AlmacenamientoDeleteRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!almacenamiento::findOrFail($this->route('almacenamiento'))->guiasDespacho->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Almacén',
                    'mensaje' => 'No es posible eliminar debido a que posee guias de despacho asociadas'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
