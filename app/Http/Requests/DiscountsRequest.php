<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountsRequest extends FormRequest
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
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'code' => 'sometimes|string|max:255', 
            'discount_percentage' => 'sometimes|numeric|min:0|max:100', 
            'start_date' => 'sometimes|date', 
            'end_date' => 'sometimes|date|after_or_equal:start_date', 
            'usage_limit' => 'sometimes|integer|min:0', 
            'min_order_amount' => 'sometimes|numeric|min:0',
        ];

        if ($this->isMethod('POST')) {
            $rules['restaurant_id'] = 'required|exists:restaurants,id';
            $rules['code'] = 'required|string|max:255';
            $rules['discount_percentage'] = 'required|numeric|min:0|max:100';
            $rules['start_date'] = 'required|date';
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
            $rules['usage_limit'] = 'required|integer|min:0';
            $rules['min_order_amount'] = 'required|numeric|min:0';
        }

        return $rules;
    }
}
