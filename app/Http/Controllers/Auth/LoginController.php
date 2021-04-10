<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    public function __construct()
    {
        $this->middleware('guest')->only('formLogin');
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function login()
    {
        $credentials = $this->validate(request(), [
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home.index');
        }

        return back()
            ->withErrors(['email' => trans('auth.failed')])
            ->withInput(request(['email']));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }}
