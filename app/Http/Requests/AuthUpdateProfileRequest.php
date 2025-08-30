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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first-name' => ['required','min:3', 'max:255', 'string'],
            'last-name' => 'required|min:3|max:255|string|',
            'phone' => 'numeric|max:11|regex:/^09\d{9}$/',
            'email' => 'max:255|min:5|unique:users|regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i'
        ];
    }
}
