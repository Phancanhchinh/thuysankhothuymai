<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
class UsersRequest extends FormRequest
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
            'full_name' => 'required|string|min:5|max:255',
            'email'=>'required|string|email|max:255|unique:users,email,'.$request->id,
            'password'=>'required|string|min:5|max:255',
            'phone'=>'required|min:5|max:255',
            'address'  =>  'required|min:5|max:255',
            'role' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute phải ít nhất 5 ký tự',
            'max' => ':attribute không quá 255 ký tự',
            'unique' => ':attribute đã tồn tại',
            'string' => ':attribute phải là kiểu chuỗi',
            'email.email' => 'không đúng định dạng email',
        ];
    }
    public function attributes()
    {
        return [
            'full_name' => 'Tên Người Dùng',
            'email'=>'Địa chỉ email',
            'password'=>'Mật khẩu',
            'phone'=>'Điện thoại',
            'address'  =>  'Địa chỉ',
            'role' => 'Quyền'
        ];
    }
}
