<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdmUserRequest extends FormRequest
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
            'username' => 'nullable|min:6|max:255|unique:users',
            'first_name' => 'nullable|min:3|max:255|string',
            'last_name' => 'nullable|min:3|max:255|string',
            'phone' => 'nullable|unique:users|digits:11|regex:/^[0][9][0-9]{9,9}$/',
            'email' => 'nullable|unique:users|max:255|regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i',
//            'password' => 'nullable|min:6|max:255|confirmed',
//            'password_confirmation' => 'nullable',
//            'role_id' => 'required|exists:roles',
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
