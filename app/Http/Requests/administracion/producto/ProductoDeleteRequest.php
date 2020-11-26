<?php

namespace App\Http\Requests\administracion\producto;

use Illuminate\Foundation\Http\FormRequest;

class ProductoDeleteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!producto::findOrFail($this->route('producto'))->almacenamientos->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Producto',
                    'mensaje' => 'No es posible eliminar debido a que posee almacenamientos asociadas'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
