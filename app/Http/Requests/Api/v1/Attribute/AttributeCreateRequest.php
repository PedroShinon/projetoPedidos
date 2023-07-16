<?php

namespace App\Http\Requests\Api\v1\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class AttributeCreateRequest extends FormRequest
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
            'nome' => ['required', 'max:255']
            //'code' => ['required', 'max:255'],   
        ];
    }
}
