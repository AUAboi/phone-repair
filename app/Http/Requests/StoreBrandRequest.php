<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name' => 'required|unique:brands,name',
            'image' => 'required|file|mimes:png,jpg,webp|max:3000',
            'mobile' => 'boolean|nullable',
            'laptop' => 'boolean|nullable',
            'tablet' => 'boolean|nullable',
        ];
    }
}
