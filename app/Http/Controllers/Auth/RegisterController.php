<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Entities\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        try {
            $this->validator($request->all())->validate();
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }

        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $isAuth = $request->has('remember') ? true : false;
        $objUser = $this->create(['user_name' => $user_name, 'email' => $email, 'password' => $password]);

        if (!($objUser instanceof User)) {
            //throw new \Exception("Can't create object");
            return back()->With('error', "Can't create object" );
        }

        if ($isAuth) {
            $this->guard()->login($objUser);
        }

        return redirect(route('account'))->With('success', 'Registration successfully');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'min:3','max:30', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:128', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
