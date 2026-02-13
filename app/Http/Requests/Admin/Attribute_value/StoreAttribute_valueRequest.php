<?php

namespace App\Http\Requests\Admin\Attribute_value;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttribute_valueRequest extends FormRequest
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
            'attribute_id' => 'required|numeric|exists:attributes',
            'value' => 'required',
        ];
    }


    public function messages(): array
    {
        return [
            'attribute_id.required' => 'ویژگی محصول الزامی است',
            'attribute_id.numeric' => 'فرمت ویژگی صحیح نیست',
            'attribute_id.exists' => 'مقدار آیدی وجود ندارد',
            'value.required' => 'ویژگی الزامی است',
        ];
    }

}
