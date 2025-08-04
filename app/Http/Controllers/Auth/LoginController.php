<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Models\InstructorModuleSetting;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
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

    public function showLoginForm()
    {
        // set dark mode after user change domain
        if(isset(request()->preferenceMode)){
            session(['preferenceMode' => request()->preferenceMode]);
        }

        return view('auth/login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->user_role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_role == 'instructor') {
                return redirect()->intended('/instructor/dashboard');
            } elseif ($user->user_role == 'student') {
                return redirect()->intended('/student/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }



    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();

        if ($user) {
            Auth::login($user);
            if ($user->user_role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_role == 'instructor') {
                return redirect()->intended('/instructor/dashboard');
            } elseif ($user->user_role == 'student') {
                return redirect()->intended('/student/dashboard');
            }
        } else {
            $newUser = new User;
            $newUser->name = $userSocial->name;
            $newUser->user_role = "student";
            $newUser->email = $userSocial->email;
            $newUser->avatar = $userSocial->avatar;
            $newUser->password = bcrypt("123465");
            $newUser->email_verified_at = now()->format('Y-m-d H:i:s');
            $newUser->save();
            Auth::login($newUser);
            return redirect()->intended('/student/dashboard');
        }
    }


    public function logout(){
        auth()->logout();
        cookie()->forget(config('app.subdomain'));
        return redirect('/');
    }
}
