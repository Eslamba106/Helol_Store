<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:255|min:3",
            // "image" => "image|max:1028576",
            "email" => ['required',
            'max:255', 'min:6',
            Rule::unique('users' , 'email')
        ],
            "password" => "required|min:6",
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'This field (:attribute) is required',
            'unique' => 'This (:attribute) is already exists!',
            'confirmed'=> 'password should be confierm',
        ];
    }
}
