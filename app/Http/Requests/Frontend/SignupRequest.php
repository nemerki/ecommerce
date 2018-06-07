<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            "name" => 'required|min:5|max:60',
            "email" => 'required|email|unique:users',
            "password" =>'required|confirmed|min:5|max:15'


        ];
    }

//    public function messages()
//    {
//        return [
//            "name.required" => "Bu alan gerekli",
//            "name.max" => "En fazla :max karakter olabilir",
//            "name.min" => "En az :min karakter olmalıdır",
//
//            "email.required" => "Bu alan gerekli",
//            "email.email" => "Lütfen geçerli bir email adresi giriniz",
//            "email.unique" => "Bu eposta adresi kullanılıyor",
//
//
//            "password.required" => "Bu alan gerekli",
//            "password.confirmed" => "Şifreler Eşleşmiyor",
//            "password.max" => "En fazla :max karakter olabilir",
//            "password.min" => "En az :min karakter olmalıdır",
//
//        ];
//    }

}
