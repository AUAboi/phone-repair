<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
            'device_repair_id' => 'required|exists:device_repairs,id',
            'repair_type' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'nullable|string|max:255',
            'phone' => 'required|phone:UK',
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'device_repair_id.required' => 'Please select a repair.',
            'phone' => 'Please enter a valid phone number'
        ];
    }
}
