<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'status' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường bắt buộc nhập.',
            'email.required' => 'Trường bắt buộc nhập.',
            'category_id.required' => 'Trường bắt buộc nhập.',
            'status.required' => 'Trường bắt buộc nhập.',

        ];
    }
}
