<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveriesRequest extends FormRequest
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
         // Common rules for both store and update
         $rules = [
            'order_id' => 'sometimes|exists:orders,id',  // Optional for update
            'delivery_personnel_id' => 'sometimes|exists:delivery_personnels,id',
            'estimated_time' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:pending,on the way,delivered,failed',
        ];
   
        // Adjust required rules for POST (store operation)
        if ($this->isMethod('POST')) {
            $rules['order_id'] = 'required|exists:orders,id';
            $rules['delivery_personnel_id'] = 'required|exists:delivery_personnels,id';
            $rules['estimated_time'] = 'required|numeric|min:0';
            $rules['status'] = 'required|in:pending,on the way,delivered,failed';
        }
     
        return $rules;
    }
}
