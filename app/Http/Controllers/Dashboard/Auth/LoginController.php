<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;



class LoginController extends Controller
{
    public function loginPage()
    {
        return view("dashboard.auth.login-page");
    }
    public function login(LoginRequest $request)
    {

        if (auth()->guard('admin')->attempt(['username' => $request->input('email'), 'password' => $request->input('password')])) {

            return redirect()->route('dashboard.dashboard');
        } elseif (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

            return redirect()->route('dashboard.dashboard');
        } elseif (auth()->guard('admin')->attempt(['phone_number' => $request->input('email'), 'password' => $request->input('password')])) {

            return redirect()->route('dashboard.dashboard');
        };
        return back()->withErrors([
            'loginError' => 'Error in email or password . please try again',
            // 'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);    
    }
    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login-page');
    }
}
