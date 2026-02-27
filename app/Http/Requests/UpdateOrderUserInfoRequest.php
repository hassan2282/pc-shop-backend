<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderUserInfoRequest extends FormRequest
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
            'id' => 'required|exists:users,id|',
            'first_name' => 'min:3|max:255|string',
            'last_name' => 'min:3|max:255|string|',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'postal_code' => 'required|numeric|digits:10',
            'address' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'آیدی کاربر الزامی است',
            'id.exists' => 'آیدی کاربر یافت نشد',
            'first_name.required' => 'نام الزامی است',
            'first_name.min' => 'نام حداقل 3 کاراکتر باید داشته باشد',
            'first_name.max' => 'نام حداکثر 255 کاراکتر باید باشد',
            'first_name.string' => 'فرمت نام صحیح نیست',
            'last_name.min' => 'نام خانوادگی حداقل 3 کاراکتر باید داشته باشد',
            'last_name.max' => 'نام خانوادگی حداکثر 255 کاراکتر باید باشد',
            'last_name.string' => 'فرمت نام خانوادگی صحیح نیست',
            'province_id.required' => 'استان الزامی است',
            'province_id.exists' => ' استان وارد شده موجود نیست',
            'city_id.required' => 'شهر الزامی است',
            'city_id.exists' => 'شهر وارد شده موجود نیست',
            'postal_code.required' => 'کد پستی الزامی است',
            'postal_code.numeric' => 'فرمت کد پستی صحیح نیست',
            'postal_code.digits' => 'فرمت کد پستی صحیح نیست',
            'address.required' => 'آدرس الزامی است',
            'address.string' => 'فرمت آدرس وارد شده صحیح نیست',
            'address.min' => 'آدرس باید حداقل شامل 10 کاراکتر باشد',
            'address.max' => 'آدرس باید حداکثر شامل 1000 کاراکتر باشد',
        ];
    }
}
