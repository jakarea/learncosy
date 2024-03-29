<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\InstructorModuleSetting;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TypingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Student\StudentHomeController;
use App\Http\Controllers\Instructor\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// all cache clear route
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    return redirect('/');
});


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return redirect('/');
});

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    return view('auth.verified');
});

// custom 404 page view
Route::get('/error-design', function () {
    return view('errors.404');
});


// custom auth screen route
Route::get('login-as-instructor/{userSessionId}/{userId}/{insId}', [HomepageController::class, 'loginAsinstructor']);
Route::get('login-as-student/{userSessionId}/{userId}/{stuId}', [HomepageController::class, 'loginAsStudent']);
Route::get('ins-login-as-student/{userSessionId}/{userId}/{stuId}', [DashboardController::class, 'loginAsStudent']);
Route::get('back-to-pavilion/{userId}', [StudentHomeController::class, 'backToPavilion'])->name('backto-pavilion');





// theme settings register page
Route::get('/auth-register', function () {

    $subdomain = config('app.subdomain');
    $instrcutor = User::where('subdomain', $subdomain)->first();
    if($instrcutor){
        $instrcutorModuleSettings = InstructorModuleSetting::where('instructor_id', $instrcutor->id)->firstOrFail();
        $value = '{"primary_color":"","secondary_color":"","lp_layout":"","meta_title":"","meta_desc":""}';
        $registerPageStyle = json_decode($instrcutorModuleSettings->value ? $instrcutorModuleSettings->value : $value);

        if ($registerPageStyle) {
            if ($registerPageStyle->lp_layout == 'fullwidth') {
                return view('custom-auth/register/register2');
            } elseif ($registerPageStyle->lp_layout == 'default') {
                return view('custom-auth/register/register');
            } elseif ($registerPageStyle->lp_layout == 'leftsidebar') {
                return view('custom-auth/register/register3');
            } elseif ($registerPageStyle->lp_layout == 'rightsidebar') {
                return view('custom-auth/register/register4');
            } else {
                return view('custom-auth/register/register');
            }
        }
    } else {
        return view('custom-auth/register/register');
    }
})->name('tregister')->middleware('guest');

Route::get('courses/overview-courses/{slug}', [HomepageController::class, 'courseDetails']);

// password reset
Route::get('/auth/password/reset', function () {
    return view('custom-auth/passwords/email');
})->name('auth.password.request')->middleware('guest');

// after registration redirect user
Route::get('/home', function (Request $request) {
    // user role
    $role = Auth::user()->user_role;

    // instructor rediretion
    if ($role == 'instructor' && isset(Auth::user()->email_verified_at)) {
        return redirect('instructor/dashboard');
    } elseif ($role == 'instructor' && !isset(Auth::user()->email_verified_at)) {
        return redirect('instructor/profile/step-1/complete');
    }

    // admin rediretion
    if ($role == 'admin') {
        return redirect('/admin/dashboard');
    }

    // students rediretion
    if ($role == 'student') {
        return redirect('/student/dashboard');
    }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('home')->middleware('auth');

// auth route
Auth::routes(['verify' => true]);
Route::get('student/lessons/{id}', function ($id) {

    $lesson = App\Models\Lesson::findorfail($id);
    return response()->json($lesson);
});

// One to one chat system
Route::middleware('auth')->prefix('messages')->controller(MessageController::class)->group(function () {
    Route::get('/', 'index')->name('messages.message');

    Route::get('/all-chats-groups', 'allChatsAndGroups')->name('messages.chats');
    Route::get('/all-user', 'getUserList')->name('messages.users');
    Route::get('/all-groups', 'allGroups')->name('messages.groups');

    Route::get('/chat', 'getChatMessage')->name('messages.chat');
    Route::post('/chat', 'sendChatMessage')->name('messages.chat');
    Route::get('/group/chat', 'getGroupChatMessage')->name('messages.group.chat');
    Route::post('/group/chat', 'sendGroupMessage')->name('messages.group.chat');
    Route::get('/search-user', 'searchChatUser')->name('messages.search');
    Route::get('/chat/download/{filename}', 'downloadChatFile')->name('messages.file.download');
    Route::get('/delete/single-chat-history', 'deleteSingleChatHistory')->name('messages.delete.singlechat');
    Route::get('/delete/group-chat-history', 'deleteGroupChatHistory')->name('messages.delete.groupchat');

    Route::get('/user/details', 'getUserDetails')->name('messages.user.details');
    Route::get('/user/sender/details', 'getSenderUserDetails')->name('messages.sender.user.details');
});

Route::middleware('auth')->prefix('messages')->controller(TypingController::class)->group(function () {
    // One to one
    Route::post('/start-typing', 'startTyping')->name('messages.typing.start');
    Route::post('/stop-typing', 'stopTyping')->name('messages.typing.stop');

    // Group chate
    Route::post('/group/start-typing', 'startGroupTyping')->name('messages.group.typing.start');
    Route::post('/group/stop-typing', 'stopGroupTyping')->name('messages.group.typing.stop');
});

// Group message
Route::middleware('auth')->prefix('messages')->controller(GroupController::class)->group(function () {
    Route::post('/create-group', 'createGroup')->name('messages.group');
    Route::post('/add-people/group', 'addPeopleToGroup')->name('messages.group.add.people');
    Route::post('/update-group', 'updateGroup')->name('messages.update.group');
    Route::post('/delete-group', 'deleteGroup')->name('messages.delete.group');
    Route::get('/load/suggested/people', 'loadSuggestedPeople')->name('messages.suggested.people');
});

Route::middleware('auth')->prefix('preference')->controller(UserPreferenceController::class)->group(function () {
    Route::post('mode/setting', 'updateDarkModePreference')->name('preference.mode.setting');
});

// Route::get('/generate-pdf/{id}',[GeneratepdfController::class, 'generatePdf'])->name('generate-pdf');

Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/');
});

/**
 * if page not found then redirect to 404 page
 */
Route::fallback(function () {
    // return redirect()->route('login',['subdomain' => config('app.subdomain')]);
    return response()->view('errors.404', [], 404);
});


$domain = env('APP_DOMAIN', 'learncosy.com');

Route::domain('{subdomain}.' . $domain)->middleware(['web', 'auth', 'verified', 'role:instructor'])->group(function () {
// custom login for student and instructor
Route::get('/login', function () {

    // match user sessionId
    if(isset(request()->singnature)){
        $user = User::where('session_id', request()->singnature)->first();
        if($user){
            Auth::login($user);
            $user->session_id = null;
            $user->save();
            return redirect()->intended($user->user_role.'/dashboard');
        }
    }

    $subdomain = explode('.', request()->getHost())[0];
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

})->middleware('guest')->name('login');
});


// Social Login
Route::get('/login/{social}',[LoginController::class,'socialLogin'])->where('social','facebook|google|apple')->name('social.login');
Route::get('/login/{social}/callback',[LoginController::class,'handleProviderCallback'])->where('social','facebook|google|apple')->name('social.callback');
