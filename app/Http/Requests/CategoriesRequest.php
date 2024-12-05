<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'user_id' => 'sometimes|exists:users,id',
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'name' => 'sometimes|string|max:255',  // Optional for update
            'image' =>  'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ];

        // Adjust required rules for POST (store operation)
        if ($this->isMethod('POST')) {
            $rules['name'] = 'required|string|max:255';
            $rules['restaurant_id'] = 'required|exists:restaurants,id';
        }
        
        return $rules;
    }
}
