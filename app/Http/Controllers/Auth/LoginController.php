<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Redirect;
use Session;

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
   // protected $redirectTo = '/dashboard';

    protected function redirectTo()
    {
        $user = Auth::user()->user_name;
        $disable = 'Lo sentimos.... El usuario ' . $user . ' Se encuentra deshabilitado';
        //dd($user);
        if (Auth::user()->enable == 1) {
            return '/dashboard';
        } else {
            Auth::logout();
           
           return '/';
            //return view('auth.login', ['disable' => $disable]);
        }

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
