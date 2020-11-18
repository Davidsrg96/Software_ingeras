<?php

namespace App\Http\Requests\administracion\cargo;

use Illuminate\Foundation\Http\FormRequest;
use App\cargo;

class CargoDeleteRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!cargo::findOrFail($this->route('cargo'))->usuarios->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Cargo',
                    'mensaje' => 'No es posible eliminar debido a que posee usuarios asociados'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
