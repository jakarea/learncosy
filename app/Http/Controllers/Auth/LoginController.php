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

        if(isset(request()->singnature)){
            $user = User::where('session_id', request()->singnature)->first();
            if($user){
                Auth::login($user);
                $user->session_id = null;
                $user->save();
                if( request()->step == 4 ){
                    return redirect()->to('//' . $user->subdomain . '.' . env('APP_DOMAIN').'/instructor/profile/step-4/complete');
                }
                return redirect($user->user_role.'/dashboard');
            }
        }

        $subdomain = explode('.', request()->getHost())[0];
        if ($subdomain == 'app') {
            return view('auth/login');
        }

        $instrcutor = User::where('subdomain', $subdomain)->where('user_role','instructor')->firstOrFail();

        // module settings
        $instrcutorModuleSettings = InstructorModuleSetting::where('instructor_id', $instrcutor->id)->first();

        if ($instrcutorModuleSettings) {
            $loginPageStyle = json_decode($instrcutorModuleSettings->value);
        } else {
            $loginPageStyle = json_decode("{'primary_color':','menu_color':','secondary_color':','lp_layout':','meta_title':','meta_desc':'}");
        }

        if (isset($loginPageStyle) && property_exists($loginPageStyle, 'lp_layout')) {
            if ($loginPageStyle->lp_layout == 'fullwidth') {
                return view('custom-auth/login/login2');
            } elseif ($loginPageStyle->lp_layout == 'default') {
                return view('custom-auth/login/login');
            } elseif ($loginPageStyle->lp_layout == 'leftsidebar') {
                return view('custom-auth/login/login5');
            } elseif ($loginPageStyle->lp_layout == 'rightsidebar') {
                return view('custom-auth/login/login4');
            } else {
                return view('custom-auth/login/login');
            }
        } else {
            return view('auth/login');
        }

    }

    public function login(Request $request)
    {

        $domain = env('APP_DOMAIN', 'learncosy.com');
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->session_id = null;
            $user->save();
            Auth::login($user);

            if ($user->user_role == 'admin' && !$request->is('//app.', $domain)) {
                $sessionId = session()->getId();
                $user->session_id = $sessionId;
                $user->save();
                $defaultUrl = '//' . $user->subdomain . '.' . $domain . '/login?singnature=' . $sessionId;
                return redirect()->to($defaultUrl);
            } elseif($user->user_role == 'admin' && $request->is('//app.', $domain)){
                return redirect()->route('admin.dashboard');
            }elseif ($user->user_role == 'instructor') {
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
                $defaultUrl = '//' . $user->subdomain . '.' . $domain . '/login?singnature=' . $sessionId;
                return redirect()->to($defaultUrl);
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


    public function logout(){
        auth()->logout();
        cookie()->forget(config('app.subdomain'));
        return redirect('/');
    }
}
