<?php

namespace App\Http\Requests\Admin\Product;

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
            'title' => 'required|string|max:150|min:5',
            'amount' => 'required|numeric',
            'description' => 'required|string|min:20|max:500',
            'text' => 'required|string|min:100|max:10000',
            'category_id' => 'required|exists:categories',
            'media' => 'required|file|jpeg,png,jpg,svg,mp4,mov,avi|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الزامی است',
            'title.string' => 'نوع عنوان اشتباه است',
            'title.min' => 'عنوان باید حداقل 5 کاراکتر باشد.',
            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'توضیحات باید حداقل 20 کاراکتر باشد.',
            'text.required' => 'متن مقاله الزامی است.',
            'text.min' => 'متن باید حداقل ۱۰۰ کاراکتر باشد.',
            'category_id.required' => 'شناسه دسته‌بندی الزامی است.',
            'media.required' => 'فایل رسانه‌ای الزامی است.',
            'media.mimes' => 'فایل رسانه‌ای باید از نوع jpeg، png، jpg، svg، mp4، mov، یا avi باشد.',
        ];
    }
}
