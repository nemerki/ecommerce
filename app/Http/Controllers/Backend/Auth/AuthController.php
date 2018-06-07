<?php

namespace App\Http\Controllers\Backend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Backend\User\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(UserLoginRequest $request)
    {


//            if (auth()->attempt(['email'=>$request->email,'password'=>$request->password,'yetki'=>1],$request->has('rememberme')))
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'yetki' => 1
        ];
        if (Auth::guard('admin')->attempt($credentials, $request->has('rememberme'))) {
            return route("backend.home.index");
        } else {
            return ["status" => "error", "title" => "Hatalı", "message" => "Şifre veya Mail adresi hatalı"];
        }


    }

    public function login()
    {
//        dd(route("backend.home.index"));
        return view("backend.auth.login");
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route("backend.auth.login");
    }
}
