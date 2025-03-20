<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|phone:PK',
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,card',
            'card.token' => 'required_if:payment_method,card',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'phone.phone' => "Phone number must be a valid Pakistan number",
            'payment_method.in' => 'Must Either be Cash on Delivery or Card',
            'card.token.required_if' => 'You must enter card for selected payment method'
        ];
    }
}
