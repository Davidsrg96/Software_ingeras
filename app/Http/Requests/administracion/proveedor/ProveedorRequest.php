<?php

namespace App\Http\Requests\administracion\proveedor;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Nombre_proveedor' => 'required|unique:proveedors,Nombre_proveedor,' . $this->route('proveedore'),
            'Rut_proveedor'    => 'required|unique:proveedors,Rut_proveedor,' . $this->route('proveedore'),
            'Nombre_vendedor'  => 'required',
            'Rubro'            => 'required',
            'Direccion'        => 'required',
            'Correo'           => 'required|email',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ( !$this->verificarDV() ) {
                $validator->errors()->add('Rut_proveedor', 'El rut no es valido');
            }
            if ( $this->telefonoIsEmpty() ) {
                $validator->errors()->add('Telefono', 'El campo telefono es obligatorio');
            }
        });
    }

    private function verificarDV()
    {
        if( $this->Rut_proveedor && count(explode('-', $this->Rut_proveedor)) == 2){
            $rut  = explode('-', $this->Rut_proveedor)[0];
            $dv   = explode('-', $this->Rut_proveedor)[1];
            $i    = 2;
            $suma = 0;

            while ($rut > 0)
            {
                $dig = $rut % 10;
                $rut = floor($rut / 10);
                $suma = $suma + ($dig * $i++);
                if ($i == 8) $i = 2;
            }
            $d = 11 - ($suma % 11);
            if ($d == 10) $d = 'k';
            if ($d == 11) $d = '0';
            return $d == $dv;
        }else{
            return false;
        }
    }

    private function telefonoIsEmpty()
    {
        if( strlen($this->Telefono) <= 3 ){
            return true;
        }else{
            if( $this->Telefono[3] == "_"){
                return true;
            }
        }
        return false;
    }
}
