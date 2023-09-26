<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'usernameLogin' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'emailLogin' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'passwordLogin' => ['required', 'string']
        ];
    }    
    public function messages()
    {
        return [
            'required' => ':attribute không được bỏ trống',            
            'unique' => ':attribute đã tồn tại',                              
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'max' => ':attribute không lớn hơn :max ký tự',
            'confirmed' => ':attribute không khớp',            
            'email' => ':attribute không hợp lệ',            
        ];
    }    
    public function attributes()
    {
        return [
            'username' => 'Tài khoản',
            'usernameLogin' => 'Tài khoản',
            'name' => 'Họ và tên',
            'email' => 'Địa chỉ email',
            'emailLogin' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'passwordLogin' => 'Mật khẩu',
        ];
    }
}
