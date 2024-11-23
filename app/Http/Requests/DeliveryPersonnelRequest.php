<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryPersonnelRequest extends FormRequest
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
        $rules = [
            'name' => 'sometimes|string|max:255', 
            'email' => 'sometimes|email|unique',
            'phone' => 'nullable|numeric',
            'vehicle_type' => 'sometimes|string',
            'availability' => 'sometimes|in:available, unavailable',

        ];

        // Adjust required rules for POST (store operation)
        if ($this->isMethod('POST')) {
            $rules['name'] = 'required|string|max:255';
            $rules['phone'] = 'required|numeric';
            $rules['email'] =  'required|email|unique';
            $rules['vehicle_type'] = 'required|string';
            $rules['availability'] = 'required|in:available, unavailable';
        }
        
        return $rules;
    }
}
