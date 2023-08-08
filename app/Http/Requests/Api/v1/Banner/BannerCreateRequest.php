<?php

namespace App\Http\Requests\Api\v1\Banner;

use Illuminate\Foundation\Http\FormRequest;

class BannerCreateRequest extends FormRequest
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
        //dd($this->request);
        return [
            'nome' => ['required'],
            'image.*' =>['required', 'image', 'mimes:jpeg,png,jpg,svg,gif,webp', 'max:5120']
        ];
    }
}
