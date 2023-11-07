<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserCreated;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return $data;

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'user_role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $serverName = $_SERVER['SERVER_NAME'];
        $subdomain = explode('.', $serverName);

        if (count($subdomain) > 1) {
            $subdomain = $subdomain[0];
        }

        // return $data;
        $email_verified_at = null;
        if ($data['user_role'] == 'student') {
            $email_verified_at = now()->format('Y-m-d H:i:s');
        }

        if( $data['user_role'] == 'instructor'){
            $subdomain = null;
        }
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => $email_verified_at,
            'company_name' => isset( $data['company_name']) ? $data['company_name'] : "",
            'user_role' => $data['user_role'],
            'password' => Hash::make($data['password']),
            'subdomain' =>  $subdomain
        ]);
        return $user;
    }

    protected function registered(Request $request, $user)
    {
        // Send the registration email
        Mail::to($user)->send(new UserCreated($user));

        // Show the success message
        // session()->flash('success', 'Your account has been created. Please login to continue!');

        // auth()->logout();

        // return redirect()->route('login')->with('success', 'Your account has been created. Please login to continue!');
    }

}
