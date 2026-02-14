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
            'title' => 'required|string|min:5',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'description' => 'required|string|min:20',
            'text' => 'required|string|min:10',
            'category_id' => 'required|exists:categories,id',
            'media_1' => 'required|file|mimes:jpeg,png,jpg,svg|max:10240',
            'tags' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الزامی است',
            'title.string' => 'نوع عنوان اشتباه است',
            'title.min' => 'عنوان باید حداقل 5 کاراکتر باشد.',
            'price.required' => 'قیمت الزامی است' ,
            'price.numeric' => 'فرمت قیمت صحیح نیست',
            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'توضیحات باید حداقل 20 کاراکتر باشد.',
            'text.required' => 'متن مقاله الزامی است.',
            'text.min' => 'متن باید حداقل ۱۰۰ کاراکتر باشد.',
            'category_id.required' => 'شناسه دسته‌بندی الزامی است.',
            'media_1.required' => 'فایل رسانه‌ای الزامی است.',
            'tags.required' => 'تگ الزامی است',
            'tags.array' => 'فرمت تگ صحیح نیست',
            'media.mimes' => 'فایل رسانه‌ای باید از نوع jpeg، png، jpg، svg، mp4، mov، یا avi باشد.',
        ];
    }
}
