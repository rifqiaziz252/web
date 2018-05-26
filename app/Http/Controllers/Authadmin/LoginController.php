<?php

namespace App\Http\Controllers\Authadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

     /**
     *create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()
    {
        return view('authadmin.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
        'email'=> 'request | email',
        'password'=> 'request | min:6'
        ]);
        $credential = [
        'email' => $request->email,
        'password' => $request->password
        ];
        if (Auth::guard('admin')->attempt($credential, $request->member)){
            return redirect()->intended(route('admin.home'));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
