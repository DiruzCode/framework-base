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
        if (!$this->user()->hasRole('super-administrador')) {
            if ($this->isMethod('patch')) {
                $id = $this->input('id');
                $user = User::findOrFail($id);
                // If logged in user is not super-administrador but the editing user is,
                // then logged in user cannot modify the super-administrador user
                if ($user->hasRole('super-administrador'))
                    return false;
            }
            // Only super-administrador users can modify hidden property of the editing user
            if ($this->has('hidden'))
                return false;
        }
        return $this->user()->can(['crear-usuarios', 'editar-usuarios']);
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
            'password'          => 'required_without:id|confirmed|min:2|max:30',
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
