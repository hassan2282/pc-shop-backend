<?php

namespace App\Http\Requests\Admin\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
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
            'name' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام ویژگی الزامی است',
            'name.string' => 'فرمت ویژگی صحیح نیست',
            'name.max' => 'تعداد کاراکتر های ویژگی بیش از حد مجاز است',
        ];
    }
}
