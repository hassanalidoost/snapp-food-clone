<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:restaurants,name',
            'phone' => ['required' , 'unique:restaurants,phone' , 'regex:/^(021)([0-9]){8}$/'],
            'address' => 'required|min:10|max:100',
            'acc_number' => 'required|digits:16|unique:restaurants,acc_number',
            'restaurant_category_id' => 'required',
        ];
    }
}
