<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:50',
            'description'=>'required|string|max:50',
            'unit_price'=>'required|min:3|max:50',
            'promotion_price'  => 'max:50',
            'unit' => 'required|string|min:3|max:50',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',
            'min' => ':attribute phải ít nhất 3 ký tự',
            'max' => ':attribute không quá 50 ký tự',
            'string' => ':attribute phải là kiểu chuỗi',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên Sản Phẩm',
            'description'=>'Mô Tả',
            'unit_price'=>'Giá Sản Phẩm',
            'promotion_price'=>'Giá Giảm',
            'unit'  =>  'Đơn vị',
        ];
    }
}
