<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'estado_civil' => 'required',
            'fecha_nacimiento' => 'required|date',
            'sexo' => [
                'required',
                Rule::in(['f', 'm'])
            ],
            'nivel_academico' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'telefono_fijo' => 'required|digits:11',
            'telefono_movil' => 'required|digits:11',
            'email' => 'email|required',
        ];
    }
}
