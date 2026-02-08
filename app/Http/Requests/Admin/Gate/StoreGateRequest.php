<?php

namespace App\Http\Requests\Admin\Gate;

use Illuminate\Foundation\Http\FormRequest;

class StoreGateRequest extends FormRequest
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
            'gkey' => 'required|min:15|max:255',
        ];
    }

    public function messages()
    {
        return [
            'gkey.required' => 'کلید الزامی است',
            'gkey.min' => 'کلید باید حداقل 15 کاراکتر باشد',
            'gkey.max' => 'کلید باید حداکثر 255 کاراکتر باشد',
        ];
    }
}
