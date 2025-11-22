<?php

namespace App\Http\Requests\Admin\Tag;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
            'name' =>  'required|string|min:3|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام تگ الزامی است',
            'name.min' => 'حداقل تعداد کاراکتر 3 کاراکتر است',
            'name.max' => 'حداکثر تعداد کاراکتر 255 کاراکتر است',
        ];
    }
}
