<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'restaurant_id' => 'sometimes|integer|exists:restaurants,id',
            'menu_id' => 'sometimes|integer|exists:menus,id',
            'quantity' => 'sometimes|integer|min:1',
            'line_total' => 'sometimes|numeric|min:0',
            'status' => 'nullable|string',
        ];

      
        return $rules;
    }
}
