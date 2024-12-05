<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
    public function rules()
    {
        // Common rules for both store and update
        $rules = [
            'name' => 'sometimes|string|max:255',
            'role' => 'sometimes|string',
            'email' => 'sometimes|string|email',
            'password' => 'sometimes|string|min:8|confirmed',
        ];
        if ($this->isMethod('POST')) {
            $rules['name'] = 'required|string|max:255';
            $rules['role'] = 'required|string';
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        }
      
        return $rules;
    }
}
