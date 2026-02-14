<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => 'nullable|string|min:5',
            'amount' => 'nullable|numeric',
            'description' => 'nullable|string|min:20',
            'text' => 'nullable|string|min:20',
            'category_id' => 'nullable',
            'media' => 'nullable|file|jpeg,png,jpg,svg|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string' => 'نوع عنوان اشتباه است',
            'title.min' => 'عنوان باید حداقل 5 کاراکتر باشد.',
            'description.min' => 'توضیحات باید حداقل 20 کاراکتر باشد.',
            'text.min' => 'متن باید حداقل 20 کاراکتر باشد.',
            'media.mimes' => 'فایل رسانه‌ای باید از نوع jpeg، png، jpg، svg، mp4، mov، یا avi باشد.',
        ];
    }
}
