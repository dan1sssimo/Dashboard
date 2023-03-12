<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Lang;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function validateLogin(Request $request)
    {
        $validateData = $request->validate([
            "password" => "required|string",
            "g-recaptcha-response" => "required|captcha",
            "email" => "required"
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $notification = array(
            'message' => 'Login or Password is incorrect',
            'alert-type' => 'error'
        );
        return view('auth.login', compact('notification'));
    }
}
