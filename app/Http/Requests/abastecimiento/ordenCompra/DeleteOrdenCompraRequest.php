<?php

namespace App\Http\Requests\abastecimiento\ordenCompra;

use Illuminate\Foundation\Http\FormRequest;
use App\orden_de_compra;

class DeleteOrdenCompraRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules() { return []; }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!orden_de_compra::findOrFail($this->route('orden_de_compra'))->facturas->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Orden de Compra',
                    'mensaje' => 'No es posible eliminar debido a que posee facturas asociadas'
                ]);
                $validator->errors()->add('-', '-');
            }
        });
    }
}
