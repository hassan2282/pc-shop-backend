<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => 'nullable|string|min:5|max:150',
            'description' => 'nullable|string|min:20|max:500',
            'text' => 'nullable|string|min:20|max:10000',
            'category_id' => 'nullable|exists:categories,id',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,svg,mp4,mov,avi|max:10240',
            'tags' => 'nullable|array',
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
            'title.min' => 'عنوان باید حداقل ۲۰ کاراکتر باشد.',
            'description.min' => 'توضیحات باید حداقل ۵۰ کاراکتر باشد.',
            'text.min' => 'متن باید حداقل ۱۰۰ کاراکتر باشد.',
            'media.mimes' => 'فایل رسانه‌ای باید از نوع jpeg، png، jpg، svg، mp4، mov، یا avi باشد.',
            'tags.array' => 'فرمت ارسالی تگ ها صحیح نیست',
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
