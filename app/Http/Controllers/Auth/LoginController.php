<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
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
        return view('auth.login');
    }



    public function login(Request $request)
    {

        $domain = env('APP_DOMAIN', 'learncosy.com');
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $user->session_id = null;
                $user->save();
                Auth::login($user);

                if ($user->user_role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->user_role == 'instructor') {
                    // for live domain $user->subdomain
                    if ($user->subdomain && !$request->is('//app.', $domain)) {
                        $sessionId = session()->getId();
                        $user->session_id = $sessionId;
                        $user->save();
                        return redirect()->to('//' . $user->subdomain . '.' . $domain . '/login?singnature=' . $sessionId);
                    } else {
                        return redirect()->intended('/instructor/dashboard');
                    }
                } elseif ($user->user_role == 'student') {
                    $sessionId = session()->getId();
                    $user->session_id = $sessionId;
                    $user->save();
                    return redirect()->to('//' . $user->subdomain . '.' . $domain . '/login?singnature=' . $sessionId);
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Credentials');
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


        $domain = env('APP_DOMAIN', 'learncosy.com');

        $userSocial = Socialite::driver($social)->user();

        $user = User::where(['email' => $userSocial->getEmail()])->first();

        if ($user) {
            $user->session_id = null;
            $user->save();
            Auth::login($user);

            if ($user->user_role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->user_role == 'instructor') {
                // for live domain $user->subdomain
                if ($user->subdomain && !request()->is('//app.', $domain)) {
                    $sessionId = session()->getId();
                    $user->session_id = $sessionId;
                    $user->save();
                    return redirect()->to('//' . $user->subdomain . '.' . $domain . '/login?singnature=' . $sessionId);
                } else {
                    return redirect()->intended('/instructor/dashboard');
                }
            } elseif ($user->user_role == 'student') {
                $sessionId = session()->getId();
                $user->session_id = $sessionId;
                $user->save();
                return redirect()->to('//' . $user->subdomain . '.' . $domain . '/login?singnature=' . $sessionId);
            }
        } else {

            $sessionId = session()->getId();
            $serverName = $_SERVER['SERVER_NAME'];
            $subdomain = explode('.', $serverName);

            if (count($subdomain) > 1) {
                $subdomain = $subdomain[0];
            }

            $newUser                  = new User;
            $newUser->name            = $userSocial->name;
            $newUser->user_role       = "student";

            $newUser->email           = $userSocial->email;
            $newUser->avatar          = $userSocial->avatar;
            $newUser->email_verified_at = null;
            $newUser->subdomain = $subdomain;
            $newUser->password = bcrypt("123465");

            $newUser->email_verified_at = now()->format('Y-m-d H:i:s');

            $newUser->session_id = $sessionId;

            $newUser->save();

            return redirect()->to('//' . $newUser->subdomain . '.' . $domain . '/login?singnature=' . $sessionId);
        }


    }
}
