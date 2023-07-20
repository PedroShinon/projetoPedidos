<?php

namespace App\Http\Requests\Api\v1\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'categoria' => ['required', 'max:255'],
            'user_id' => ['required', 'integer'],
            'atributos' => ['nullable'],
            'nome' => ['required', 'max:255'],
            'marca' => ['required', 'max:255'],
            'modelo' => ['required', 'max:255'],
            'preco_original' => ['nullable', 'decimal:2'],
            'preco_atual' => ['required', 'decimal:2'],
            'destaque' => ['nullable'],
            'status' => ['nullable'],
            'image.*' =>['nullable', 'image', 'mimes:jpeg,png,jpg,svg,gif', 'max:5120']
        ];
    }
}
