<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'max:100' ],
            'nome_loja' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email', 'max:100' ],
            'cnpj_cpf' => ['required', 'unique:users,cnpj_cpf', 'min:11', 'max:14'],
            'telefone' => ['required', 'min:9' , 'max:21' ],
            'logradouro' => ['required', 'max:200'],
            'tipo_usuario' => ['required', 'min:3', 'max:7'],
            'numero' => ['required', 'max:20'],
            'bairro' => ['required', 'max:100'],
            'cidade' => ['required', 'max:100'],
            'permissao' => ['required'],
            'uf' => ['required', 'max:2']
            
        ];
    }
}
