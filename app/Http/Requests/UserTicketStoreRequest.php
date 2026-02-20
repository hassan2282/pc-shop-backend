<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTicketStoreRequest extends FormRequest
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
            'conversation_id' => 'nullable',
            'user_id' => 'required|exists:users,id',
            'text' => 'required|max:500',
        ];
    }



    public function messages()
    {
        return [
            'user_id.required' => 'آیدی کاربر الزامی است',
            'text.required' => 'متن الزامی است',
            'text.max' => 'متن پیام نباید بیشتر از 500 کاراکتر باشد',

        ];
    }
}
