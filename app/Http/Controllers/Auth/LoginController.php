<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /*
     * Login
     */

    public function login(Request $request)
    {
        $userIdentifier = isset( $_COOKIE['userIdentifier']) ?? NULL;

        $domain = env('APP_DOMAIN', 'learncosy.com');
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        $carts = Cart::where('user_identifier', $userIdentifier)->get();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // Auth::login($user);
                // check if already logged in then logout
                Auth::login($user);
                if ($user->user_role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->user_role == 'instructor') {
                    // for live domain $user->subdomain
                    if ($user->subdomain && !$request->is('//app.',$domain)) {
                        return redirect()->to('//' . $user->subdomain . '.' . $domain . '/instructor/dashboard');
                    } else {
                        // return redirect('/instructor/dashboard');
                        return redirect()->intended('/instructor/dashboard');
                    }
                } elseif ($user->user_role == 'student') {
                    $carts = Cart::where('user_identifier', $userIdentifier)->get();
                    foreach ($carts as $cart) {
                        $cart->user_id = Auth::id();
                        $cart->save();
                    }
                    return redirect('/students/dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Credentials');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }
}
