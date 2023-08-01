<?php

namespace App\Http\Requests\Api\v1\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'loja_id' => ['sometimes'],
            'nome_completo' => ['sometimes'],
            'status_pedidos' => ['sometimes'],
            'preco_total' => ['sometimes', 'numeric']
        ];
    }
}
