<?php

namespace App\Http\Requests\administracion\usuario;

use Illuminate\Foundation\Http\FormRequest;
use App\usuario;

class UsuarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Nombre'          => 'required|alpha',
            'rutEs'           => 'required',
            'Confiabilidad'   => 'required',
            'Ciudad'          => 'required|alpha',
            'email'           => 'required|email|unique:Usuario,email,' . $this->route('usuario'),
            'password'        => 'required',
            'Es_externo'      => 'required',
            'cargo_id'        => 'required',
            'tipo_usuario_id' => 'required'      
        ];
    }

    public function attributes()
    {
        return [
            'rutEs'           => 'rut',
            'cargo_id'        => 'cargo',
            'tipo_usuario_id' => 'tipo de usuario',
        ];
    }

    public function messages()
    {
        return [
            'Es_externo.required' => 'Este campo es obligatorio.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ( !$this->verificarDV() ) {
                $validator->errors()->add('rutEs', 'El rut no es valido');
            }
            if($this->route('usuario')){
                if ( $this->isExiste() &&
                        usuario::where('Rut',$this->route('usuario')->get() != $this->rutEs)){
                    $validator->errors()->add('rutEs', 'Este rut ya ha sido registrado');
                }
            }else{
                if ( $this->isExiste()){
                    $validator->errors()->add('rutEs', 'Este rut ya ha sido registrado');
                }
            }
        });
    }

    private function verificarDV()
    {
        if( $this->rutEs && count(explode('-', $this->rutEs)) == 2){
            $rut  = explode('-', $this->rutEs)[0];
            $dv   = explode('-', $this->rutEs)[1];
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

    private function isExiste()
    {
        $usuario = usuario::where('Rut', $this->rutEs)->get()->isEmpty();
        if(!$usuario){
            return true;
        }else{
            return false;
        }
    }
}
