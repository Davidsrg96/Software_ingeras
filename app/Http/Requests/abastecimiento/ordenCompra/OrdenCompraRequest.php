<?php

namespace App\Http\Requests\abastecimiento\ordenCompra;

use Illuminate\Foundation\Http\FormRequest;

class OrdenCompraRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Numero'        => 'required|numeric|min:0|unique:orden_de_compras,Numero,'. 
                                    $this->route('orden_de_compra'). ',id,proveedor_id,' . $this->proveedor_id,
            'proveedor_id'  => 'required',
            'Documento'     => 'mimes:pdf',
            'descP'         => 'required',
            'Fecha_ingreso' => 'required|date'
        ];
    }

    public function attributes()
    {
        return [
            'Numero'       => 'número de orden de compra ',
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
            if(!$this->route('orden_de_compra')){
                if ($this->Documento == null || $this->Documento== "") {
                     $validator->errors()->add('Documento', 'El campo Documento es requerido');
                }
            }
            if( $this->menorCero($this->cantP) ){
                $validator->errors()->add('cantP', 'La cantidad de los productos debe ser mayor a 0');
            }
            if( $this->menorCero($this->precioP) ){
                $validator->errors()->add('precioP', 'El precio de los productos debe ser mayor a 0');
            }
            if($this->repetido() ){
                 $validator->errors()->add('descP', 'Tiene productos repetidos');
            }
            if(!$this->isNumerico($this->precioP) ){
                 $validator->errors()->add('precioP', 'Los precios deben ser numericos');
            }
            if(!$this->isNumerico($this->cantP) ){
                 $validator->errors()->add('cantP', 'Las cantidades deben ser numericas');
            }
            if($this->isEmpty($this->descP) ){
                 $validator->errors()->add('descP', 'Las descripciones de los productos no pueden estar en vacias');
            }
            if($this->isEmpty($this->cantP) ){
                 $validator->errors()->add('cantP', 'Las cantidades de los productos no pueden estar en vacias');
            }
            if($this->isEmpty($this->precioP) ){
                 $validator->errors()->add('precioP', 'Los precios de los productos no pueden estar en vacios');
            }
        });
    }

    private function menorCero($valores)
    {
        if($valores){
            foreach ($valores as $key => $cantidad) {
                if( $cantidad <= 0 && $cantidad){
                    return true;
                    break;
                }
            }
        }
        return false;
    }

    private function repetido()
    {
        if($this->descP){
            $cantidad = count($this->descP);
            for ($i=0; $i < $cantidad-1 ; $i++) { 
                for ($j=1; $j < $cantidad; $j++) { 
                    if($this->descP[$i] == $this->descP[$j] && $this->descP[$i] && $this->descP[$j]){
                        return true;
                    }
                }
            }
        }
        return false;
    }

    private function isNumerico( $valores )
    {
        if($valores){
            foreach ($valores as $key => $valor) {
                if( !is_numeric($valor) &&  $valor){
                    return false;
                    break;
                }
            }
        }
        return true;
    }
    private function isEmpty($valores){
        if($valores){
            foreach ($valores as $key => $valor) {
                if(!$valor){
                    return true;
                }
            }
        }
        return false;
    }
}
