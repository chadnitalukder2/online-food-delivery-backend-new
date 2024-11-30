<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',  // Optional for update
            'description' => 'nullable|string',
            'email' => 'sometimes|email|unique:restaurants,email',
            'phone' => 'nullable|numeric',
            'address' => 'sometimes|string',
            'status' => 'sometimes|string',
            'delivery_fee' => 'sometimes|numeric|min:0',
            'delivery_time' => 'sometimes|integer|min:1',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',

        ];

        // Adjust required rules for POST (store operation)
        if ($this->isMethod('POST')) {
            $rules['name'] = 'required|string|max:255';
            $rules['phone'] = 'required|numeric';
            $rules['email'] =  'required|email|unique:restaurants,email';
            $rules['address'] = 'required|string';
        }


        return $rules;
    }
}
