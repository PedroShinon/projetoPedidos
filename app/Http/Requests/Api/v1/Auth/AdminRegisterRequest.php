<?php

namespace App\Http\Requests\Api\v1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('super_privilege');
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'max:255' ],
            'lastName' => ['required', 'max:255' ],
            'email' => ['required', 'unique:users,email', 'email', 'max:255' ],
            'password' => ['required', 'min:6', 'confirmed' ],
            'password_confirmation' => ['required' ],
            
        ];
    }
}
