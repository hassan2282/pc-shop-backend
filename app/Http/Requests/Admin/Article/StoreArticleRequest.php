<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:150',
            'description' => 'required|string|min:20|max:500',
            'text' => 'required',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'media' => 'required|mimes:jpeg,png,jpg,svg|max:10240',
            'tags' => 'required|array',
        ];
    }

    /**
     * Customize the validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان مقاله الزامی است.',
            'title.min' => 'عنوان باید حداقل ۲۰ کاراکتر باشد.',
            'description.required' => 'توضیحات الزامی است.',
            'description.min' => 'توضیحات باید حداقل ۵۰ کاراکتر باشد.',
            'text.required' => 'متن مقاله الزامی است.',
            // 'text.min' => 'متن باید حداقل 50 کاراکتر باشد.',
            'author_id.required' => 'شناسه نویسنده الزامی است.',
            'category_id.required' => 'شناسه دسته‌بندی الزامی است.',
            'media.required' => 'فایل رسانه‌ای الزامی است.',
            'media.mimes' => 'فایل رسانه‌ای باید از نوع jpeg، png، jpg، svg، mp4، mov، یا avi باشد.',
            'tags.required' => 'تگ الزامی است',
            'tags.array' => 'فرمت ارسال تگ صحیح نیست',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'views' => $this->views ?: 0, // مقدار پیش‌فرض برای views
        ]);
    }
}
