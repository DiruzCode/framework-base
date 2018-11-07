<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        /*
         * Dado que utilizo este request tanto para la creación
         * como para la edición, debo considerar que hay variación
         * en las reglas de validación en cada caso.
         */
        $rules = [
            'email'             => 'required|email',
            'role_id'             => 'required|array|min:1',
        ];

        /*
         * Verifico si estoy haciendo un update y agrego las reglas que se necesiten.
         *
         * Por ejemplo el email debo validar que no se este usando pero dejando fuera
         * de la validación al registro que se esta editando.
         */
        if ($this->isMethod('patch')){
            $rules = array_merge(
                $rules,
                [
                    'email'                 => 'required|email|unique:users,email,'.$this->user,
                ]
            );
        }

        return $rules;
    }
}
