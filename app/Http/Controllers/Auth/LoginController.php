<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/my/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request)
    {
        try {
            $this->validate ($request, [
//                'user_name' => 'required|min:3|max:30',
                'email' => 'required|min:3|max:128',
                'password' => 'required|min:6',
            ]);

            $remember = $request->has('remember') ? true : false;

            if (Auth::attempt([/*'user_name' => $request->input('user_name'),*/'email' => $request->input('email'), 'password' => $request->input('password')], $remember)) {
                return redirect(route('account'))->with('success', trans('messages.auth.successLogin'));
            }

            return back()->with('error', trans('messages.auth.errorLogin'));

        } catch (ValidationException $e) {
            \Log::error($e->getMessage());
            return back()->with('error', trans('messages.auth.errorLogin'));
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
