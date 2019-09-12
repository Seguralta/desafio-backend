<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
            'nome' => 'required',
            'email'  => 'required|unique:usuarios',
            'cpf' => 'required|cpf',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Campo nome é obrigatório',
            'email.required' => "E-mail é obrigatório",
            'email.unique' => "Coloque outro E-mail",
            'cpf.cpf' => "CPF inválido",
        ];
    }
}
