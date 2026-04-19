<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckEmailRequest extends FormRequest
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
            'otp' => 'required|string',
            'email' => 'required|exists:users'
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'کد تایید الزامی است',
            'otp.string' => 'فرمت کد تایید صحیح نیست',
            'email.required' => 'ایمیل الزامی است',
            'email.exists' => 'ایمیل وارد شده یافت نشد',
        ];
    }
}
