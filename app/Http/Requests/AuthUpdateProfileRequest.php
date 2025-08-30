<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthUpdateProfileRequest extends FormRequest
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
            'first_name' => ['required','min:3', 'max:255', 'string'],
            'last_name' => 'required|min:3|max:255|string|',
            'phone' => 'digits:11|regex:/^[0][9][0-9]{9,9}$/',
            'email' => 'max:255|min:5|unique:users|regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i'
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'شماره تلفن وارد شده معتبر نمی باشد',
            'email.regex' => 'ایمیل وارد شده معتبر نمی باشد',
        ];
    }
}
