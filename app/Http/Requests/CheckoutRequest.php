<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:100',
            'email'=>'required|min:5|max:100',
            'address'=>'required|min:5|max:100',
            'phone_number'=>'required|min:5|max:100',
            'note'=>'required|max:100'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute phải ít nhất 5 ký tự',
            'max' => ':attribute không quá 100 ký tự',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên Khách Hàng',
            'email'=>'Email Khách Hàng',
            'address'=>'Địa Chỉ Khách Hàng',
            'phone_number'=>'Số Điện Thoại Khách Hàng',
            'note'  =>  'Lời Nhắn',
        ];
    }
}
