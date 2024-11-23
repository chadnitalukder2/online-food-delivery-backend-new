<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistsRequest extends FormRequest
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
            'user_id' => 'sometimes|exists:users,id', 
            'restaurant_id' => 'sometimes|exists:restaurants,id',
            'menu_id' => 'sometimes|exists:menus,id',
        ];

        if ($this->isMethod('POST')) {
            $rules['user_id'] = 'required|exists:users,id';
            $rules['restaurant_id'] = 'required|exists:restaurants,id';
            $rules['menu_id'] = 'required|exists:menus,id';
        }

        return $rules;
    }
}