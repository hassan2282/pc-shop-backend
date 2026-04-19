<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVerification_codeRequest extends FormRequest
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
            'phone' => 'required|digits:11|regex:/^[0][9][0-9]{9,9}$/',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'شماره تلفن الزامی است',
            'phone.digits' => 'فرمت  شماره تلفن صحیح نیست',
            'phone.regex' => 'فرمت شماره تلفن صحیح نیست',
        ];
    }
}
