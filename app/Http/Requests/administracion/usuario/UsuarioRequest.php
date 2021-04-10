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
            'Apellido'        => 'required|alpha',
            'rutEs'           => 'required',
<<<<<<< HEAD
            'Confiabilidad'   => 'required',
=======
>>>>>>> parent of c4bc801 (Revert "a")
            'email'           => 'required|email|unique:usuario,email,' . $this->route('usuario'),
            'password'        => 'required_if:' . $this->route('usuario') . ',==,0',
            'Es_externo'      => 'required',
            'ciudad_id'       => 'required',
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
                        usuario::findOrFail($this->route('usuario'))->Rut != $this->rutEs ){
                            $validator->errors()->add('rutEs', 'Este rut ya ha sido registrado');
                }
                if( strlen($this->password) > 0 && strlen($this->password) < 4){
                    $validator->errors()->add('password', 'password debe contener al menos 4 caracteres.');
                }
            }else{
                if ( $this->isExiste()){
                    $validator->errors()->add('rutEs', 'Este rut ya ha sido registrado');
                }
                if( strlen($this->password) < 4 ){
                    $validator->errors()->add('password', 'password debe contener al menos 4 caracteres.');
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
