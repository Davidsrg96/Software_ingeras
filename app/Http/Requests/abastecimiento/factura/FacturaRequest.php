<?php

namespace App\Http\Requests\abastecimiento\factura;

use Illuminate\Foundation\Http\FormRequest;
use App\factura;

class FacturaRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Numero'          => 'required|numeric|min:0|unique:facturas,Numero,'. 
                                    $this->route('factura'). ',id,proveedor_id,' . $this->proveedor_id,
            'orden_compra_id' => 'nullable',
            'proveedor_id'    => 'required',
            'Documento'       => 'mimes:pdf',
            'descP'           => 'required',
            'Fecha_ingreso'   => 'required|date',
            'bodega'          => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'Numero'       => 'número de factura',
            'proveedor_id' => 'proveedor',
        ];
    }

    public function messages()
    {
        return [
            'descP.required' => 'Debe ingresar productos',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(!$this->route('factura')){
                if ($this->Documento == null || $this->Documento== "") {
                     $validator->errors()->add('Documento', 'El campo Documento es requerido');
                }
            }
            if($this->ordenRepetida()){
                $validator->errors()->add('orden_compra_id', 'La orden de compra ya se encuentra asociada a otra factura');
            }
        });
    }

    private function ordenRepetida()
    {

        $orden = factura::where('orden_compra_id', $this->orden_compra_id)->get();
        if(!$orden->isEmpty() && $this->orden_compra_id){
            if($this->route('factura')){
                $factura = factura::findOrFail($this->route('factura'));
                if( $factura->orden_compra_id != $orden->first()->orden_compra_id ){
                    return true;
                }
            }else{
                return true;
            }
        }
        return false;
    }
}
