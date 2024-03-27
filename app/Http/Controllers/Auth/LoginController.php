<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;



class LoginController extends Controller
{
    public function registerPage(){
        return view('front.auth.register-page');
    }
    public function register(RegisterRequest $request){

        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request , 'admin_profile_images');
        }
       $user =  User::create([
           'email'=> $request->email . '.admin',
           'user_name'=> $request->username ?? null,
           'image'=> $image,
           'password'=> bcrypt($request->password),
            'name'=> $request->name,
        ]);
        auth()->attempt(['email'=>$request->input('email') , 'password'=>$request->input('password')]);
        return redirect()->route('admin.dashboard');
    // return "Ok";
    }
    public function loginPage()
    {
        return view("front.auth.login-page");
    }
    public function login(LoginRequest $request)
    {

        // if (auth()->guard('admin')->attempt(['username' => $request->input('email'), 'password' => $request->input('password')])) {

        //     return redirect()->route('dashboard.dashboard');
        // }
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {

            return redirect('/');
        } elseif (auth()->attempt(['phone_number' => $request->input('email'), 'password' => $request->input('password')])) {

            return redirect('/');
        };
        return back()->withErrors([
            'loginError' => 'Error in email or password . please try again',
            // 'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
        ]);    
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login-page');
    }
    function uploadImage(Request $request , $file_name)
{

        $file = $request->file('image');
        $path = $file->store($file_name, [
            'disk' => 'public',
        ]);
        return $path;
    
}
}
