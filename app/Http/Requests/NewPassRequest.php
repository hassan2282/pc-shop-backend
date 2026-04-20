<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPassRequest extends FormRequest
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
            'email' => 'required|exists:users',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'email.required' => 'ایمیل الزامی است',
            'email.exists' => 'ایمیل یافت نشد',
            'password.required' => 'رمز عبور الزامی است',
            'password.min' => 'رمز عبور باید حداقل 6 کاراکتر باشد',
            'password.max' => 'تعداد کاراکتر های رمز عبور بیش از حد مجاز است',
            'password.confirmed' => 'رمز عبور های وارد شده مطابقت ندارند',
            'password_confirmation.required' => 'تکرار رمز عبور الزامی است',
        ];
    }
}
