<?php

namespace App\Http\Requests\administracion\proveedor;

use Illuminate\Foundation\Http\FormRequest;
use App\proveedor;

class ProveedorDeleteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules() {return [];}

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $proveedor = proveedor::findOrFail($this->route('proveedore'));
            if (!$proveedor->facturas->isEmpty() && !$proveedor->ordenesCompra->isEmpty()) {
                $this->session()->flash('fail', [
                    'titulo'  => 'Eliminación de Proveedor',
                    'mensaje' => 'No es posible eliminar debido a que posee ordenes de compra y facturas asociadas'
                ]);
                $validator->errors()->add('-', '-');
            }else{
                if(!$proveedor->facturas->isEmpty()){
                    $this->session()->flash('fail', [
                        'titulo'  => 'Eliminación de Proveedor',
                        'mensaje' => 'No es posible eliminar debido a que posee facturas asociadas'
                    ]);
                $validator->errors()->add('-', '-');
                }else{
                    if(!$proveedor->ordenesCompra->isEmpty()){
                        $this->session()->flash('fail', [
                            'titulo'  => 'Eliminación de Proveedor',
                            'mensaje' => 'No es posible eliminar debido a que posee ordenes de compra asociadas'
                        ]);
                        $validator->errors()->add('-', '-');
                    }
                }
            }
        });
    }
}
