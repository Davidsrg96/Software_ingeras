<?php

namespace App\Http\Requests\administracion\bodega;

use Illuminate\Foundation\Http\FormRequest;
use App\bodega;

class BodegaDeleteRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!bodega::findOrFail($this->route('bodega'))->guiasDespacho->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Bodega',
                    'mensaje' => 'No es posible eliminar debido a que posee guias de despacho asociadas'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
