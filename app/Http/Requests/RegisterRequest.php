<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
class RegisterRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'email' => 'required|unique:users,email|min:5|max:50',
            'full_name'=>'required|min:5|max:50',
            'address'=>'required|min:5|max:50',
            'phone'=>'required|min:5|max:50',
            'password'  =>  'required|min:5|max:50',
            'rePassword' => 'same:password'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute phải ít nhất 5 ký tự',
            'max' => ':attribute không quá 50 ký tự',
            'unique' => ':attribute đã tồn tại',
            'string' => ':attribute phải là kiểu chuỗi',
            'email' => 'không đúng định dạng email',
            'same' => '2 mật khẩu không trùng nhau',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ email',
            'full_name'=>'Tên người dùng',
            'address'=>'Địa Chỉ',
            'phone'=>'Điện thoại',
            'password'  =>  'Mật Khẩu',
        ];
    }
}

