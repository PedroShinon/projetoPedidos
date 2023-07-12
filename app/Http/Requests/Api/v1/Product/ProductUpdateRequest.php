<?php

namespace App\Http\Requests\Api\v1\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        //$this->preco_atual = str_replace('.', ',', $this->preco_atual);
        
        return [
            'category_id' => ['required'],
            'nome' => ['sometimes', 'max:255'],
            'marca' => ['sometimes', 'max:255'],
            'modelo' => ['sometimes', 'max:255'],
            'descricao' => ['sometimes', 'max:255'],
            'preco_original' => ['sometimes', 'numeric'],
            'preco_atual' => ['sometimes', 'numeric'],
            'destaque' => ['nullable'],
            'status' => ['nullable'],
            'image' =>['nullable']
        ];
    }
}
