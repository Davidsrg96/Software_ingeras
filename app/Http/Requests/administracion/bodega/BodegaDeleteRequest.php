<?php

namespace App\Http\Requests\administracion\bodega;

use Illuminate\Foundation\Http\FormRequest;

class BodegaDeleteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!bodega::findOrFail($this->route('bodega'))->almacenamientos->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Producto',
                    'mensaje' => 'No es posible eliminar debido a que posee almacenamientos asociadas'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
