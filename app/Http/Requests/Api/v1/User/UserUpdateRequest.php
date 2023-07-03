<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'nome' => ['sometimes','required', 'max:100' ],
            'nome_loja' => ['sometimes','required', 'max:100' ],
            'email' => ['sometimes','required', 'email', 'max:100' ],
            'cnpj_cpf' => ['sometimes','required', 'unique:users,cnpj_cpf', 'min:11', 'max:14'],
            'telefone' => ['sometimes','required', 'min:9' , 'max:21' ],
            'logradouro' => ['sometimes','required', 'max:200'],
            'numero' => ['sometimes','required', 'max:20'],
            'bairro' => ['sometimes','required', 'max:100'],
            'cidade' => ['sometimes','required', 'max:100'],
            'uf' => ['sometimes','required', 'max:2']
        ];
    }
}
