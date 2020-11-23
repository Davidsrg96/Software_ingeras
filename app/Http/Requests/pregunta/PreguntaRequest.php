<?php

namespace App\Http\Requests\pregunta;

use Illuminate\Foundation\Http\FormRequest;

class PreguntaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Pregunta'      => 'required',
            'Tipo_pregunta' => 'required',
        ];
    }
}
