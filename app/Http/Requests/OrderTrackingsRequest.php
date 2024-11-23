<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderTrackingsRequest extends FormRequest
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
            'order_id' => 'sometimes|exists:orders,id',
            'current_status' => 'sometimes|in:pending, processing,shipped,delivered,cancelled',
            'status_update_time' => 'sometimes|date',
            'estimated_delivery_time' => 'sometimes|date',
        ];

        if ($this->isMethod('POST')) {
            $rules['order_id'] = 'required|exists:orders,id';
            $rules['current_status'] = 'required|in:pending, processing,shipped,delivered,cancelled';
            $rules['status_update_time'] = 'required|date';
            $rules['estimated_delivery_time'] = 'required|date';
        }

        return $rules;
    }
}
