<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\CourseCreateStepController;
use App\Http\Controllers\ProfileManagementController;


use App\Http\Controllers\Student\StudentHomeController;
use App\Http\Controllers\Student\CheckoutBundleController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\StudentProfileController;

use App\Http\Controllers\Instructor\DashboardController;

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CourseManagementController;
use App\Http\Controllers\Admin\LessonManagementController;
use App\Http\Controllers\Admin\StudentManagementController;
use App\Http\Controllers\Admin\BundleCourseManagementController;
use App\Http\Controllers\Admin\AdminSubscriptionPackageController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ModuleManagementController;

use App\Models\User; 
use App\Models\InstructorModuleSetting; 
use App\Http\Controllers\Frontend\HomepageController;
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


// Route::get('/')->middleware('auth');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    return view('auth.verified');
});


// custom auth screen route
Route::get('/auth-login', function(){

    $subdomain = explode('.', request()->getHost())[0];
    
    $instrcutor = User::where('username', $subdomain)->firstOrFail();
    $instrcutorModuleSettings = InstructorModuleSetting::where('instructor_id', $instrcutor->id)->firstOrFail();
    $loginPageStyle = json_decode($instrcutorModuleSettings->value);

    if ($loginPageStyle->lp_layout == 'fullwidth') {
        return view('login/login2');
    }
    elseif($loginPageStyle->lp_layout == 'default'){
        return view('login/login3');
    }
    elseif($loginPageStyle->lp_layout == 'leftsidebar'){
        return view('login/login5');
    }
    elseif($loginPageStyle->lp_layout == 'rightsidebar'){
        return view('login/login4');
    }else{
        return view('login/login1');
    }

})->name('tlogin')->middleware('guest');

Route::get('/auth-register', function(){
    return view('custom-auth/register');
})->name('tregister')->middleware('guest'); 

Route::get('/auth/password/reset', function(){
    return view('custom-auth/passwords/email');
})->name('auth.password.request')->middleware('guest');


Route::get('/home', function(Request $request){
    $role = Auth::user()->user_role;
    $username = Auth::user()->username;
    $subdomain = explode('.', request()->getHost())[0];
    if($subdomain == 'app' && $role == 'admin'){
        return redirect('/admin/dashboard');
    }

    if($subdomain != 'app' &&  $role == 'student'){
        return redirect('/students/dashboard');
    }

    if($subdomain != 'app' &&  $role == 'instructor'){
        return redirect('/instructor/dashboard');
    }

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');

})->name('home')->middleware('auth');

// Route::group(['prefix' => 'home'], function () {
//     Route::get('/', 'App\Http\Controllers\Frontend\HomepageController@index')->name('home');
//      Route::get('/{id}', 'App\Http\Controllers\Frontend\HomepageController@show')->name('home.instructor.course');
//     Route::get('/instructor/{id}', 'App\Http\Controllers\Frontend\HomepageController@instructorHome')->name('home.instructor.details');
//     Route::get('/instructor/{id}/course', 'App\Http\Controllers\Frontend\HomepageController@instructorCourseDetails')->name('home.instructor.details');
//     Route::get('/instructor/{id}/course/{slug}', 'App\Http\Controllers\Frontend\HomepageController@instructorCourseDetailsWithSlug')->name('home.instructor.details.course.slug');
// });
// auth route 
Auth::routes(['verify' => true]);

// message pages routes
Route::middleware('auth')->prefix('course/messages')->controller(MessageController::class)->group(function () {  
    Route::get('/', 'index')->name('message'); 
    Route::post('/', 'sendMessage')->name('message-send'); 
    Route::get('/send/{id}', 'send')->name('get.message');
    Route::get('/chat_room/{id}', 'getChatRoomMessages')->name('get.chat_room.message');
    Route::post('/chat_room/{chat_room}', 'postChatRoomMessages')->name('post.chat_room.message');
    Route::post('/send/{course_id}', 'submitMessage')->name('post.message');
});

/* ============================================================= */
/* ===================== Instructor Routes ===================== */
/* ============================================================= */
Route::middleware(['auth', 'verified', 'role:instructor'])->prefix('instructor')->group(function () {
    Route::get('/profile/step-1/complete', function(){
        if (Auth::user()->email_verified_at == null) {
            return view('auth.verify');
        } else {
            return redirect('/profile/step-2/complete');
        }
    });
    Route::get('/profile/step-2/complete', function(){
        return view('latest-auth.price');
    });
    Route::get('/profile/step-3/complete', function(){
        return view('latest-auth.subdomain');
    });
    Route::get('/profile/step-4/complete', function(){
        return view('latest-auth.connect');
    });
    Route::get('/profile/step-5/complete', function(){
        return view('latest-auth.theme-settings');
    });
    Route::get('/profile/step-6/complete', function(){
        return view('latest-auth.make-course');
    });
    // settings page routes
    Route::prefix('settings')->controller(SettingsController::class)->group(function () {
        Route::post('/stripe/request', 'stripeUpdate')->name('instructor.stripe.update');
        Route::post('/vimeo/request', 'vimeoUpdate')->name('instructor.vimeo.update');
    });
    Route::prefix('theme/setting')->controller(ModuleSettingController::class)->group(function() {
        Route::post('/updateorinsert', 'store')->name('module.setting.update');
    });
    // profile management page routes
    Route::prefix('profile')->controller(DashboardController::class)->group(function () {
        Route::post('/edit/{id}', 'username')->name('instructor.username.update'); 
    });
    // only subscription instructor can access this route
    Route::group(['middleware' => ['subscription.check']], function () {
        Route::get('dashboard', [DashboardController::class,'analytics'])->name('instructor.dashboard.analytics');
        Route::get('analytics', [DashboardController::class,'index'])->name('instructor.dashboard.index');
        // instructor payment history static pages
        Route::prefix('payments')->controller(HomeController::class)->group(function () {  
            Route::get('/', 'studentsPayment');  
            
            Route::get('/{payment_id}', 'details');  
            Route::get('/platform-fee', 'adminPayment');  
            Route::get('/platform-fee/data', 'adminPaymentData')->name('instructor.admin-payment');
        });
        // course page routes
        // Route::prefix('courses')->controller(CourseController::class)->group(function () {
        //     Route::get('/', 'index')->name('instructor.courses'); 
        //     // data table route 
        //     Route::get('/datatable', 'courseDataTable')->name('courses.data.table'); 
        //     //Route::get('/create', 'create');
        //     Route::post('/create', 'store')->name('course.store');
        //     Route::get('/{slug}', 'show')->name('course.show');   
        //     Route::get('/{slug}/edit', 'edit')->name('course.edit');
        //     Route::post('/{slug}/edit', 'update')->name('course.update'); 
        //     Route::delete('/{slug}/destroy', 'destroy')->name('course.destroy');
        // });

        Route::prefix('courses/create')->controller(CourseCreateStepController::class)->group(function () {
            
            // add course static route
            Route::get('/', 'step1')->name('course.create.step-1');

            Route::post('/{id}', 'step1c')->name('course.store.step-1');
            Route::post('/', 'step1c')->name('course.store.step-1');
            Route::get('/{id}', 'step1')->where('id', '[0-9]+')->name('course.store.step-1');


            Route::get('/{id}/content', 'step2');
            Route::post('/{id}/content', 'step2c');

            Route::get('{id}/facts', 'step3');
            Route::post('{id}/facts', 'step3c');

            Route::get('{id}/audio', 'step4');
            Route::post('step-4', 'step4c');

            Route::get('/{id}/video', 'step5');
            Route::post('step-5', 'step5c');

            Route::get('step-6', function () {
                return view('e-learning/course/instructor/create/step-3');
            });

            Route::get('step-7', 'step7');
            Route::post('step-7', 'step7c');

            Route::get('step-8', 'step8');
            Route::post('step-8', 'step8c');

            Route::get('step-9', 'step9');
            Route::post('step-9', 'step9c');

            Route::get('step-10', 'step10');
            Route::post('step-10', 'step10c');

            Route::get('step-11', 'step11');
            Route::post('step-11', 'step11c');

        });
        // module page routes
        Route::prefix('modules')->controller(ModuleController::class)->group(function () {
            Route::get('/', 'index');
            // data table route 
            Route::get('/datatable', 'modulesDataTable')->name('modules.data.table'); 
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('module.store');
            Route::get('/{slug}/edit', 'edit')->name('module.edit'); 
            Route::post('/{slug}/edit', 'update')->name('module.update'); 
            Route::delete('/{slug}/destroy', 'destroy')->name('module.destroy');
        });
    
        // lesson page routes
        Route::prefix('lessons')->controller(LessonController::class)->group(function () {
            Route::get('/', 'index');
            // data table route 
            Route::get('/datatable', 'lessonsDataTable')->name('lessons.data.table'); 
            Route::get('/create', 'create'); 
    
            Route::get('/create/video-upload', 'videoUpload')->name('lesson.upload.video');
            Route::get('/upload-vimeo', 'uploadVimeoPage')->name('lesson.upload.vimeo');
            Route::post('/upload-vimeo-submit', 'uploadViewToVimeo')->name('lesson.vimeo');
            Route::get('/progress', 'getProgress')->name('upload.progress'); 
            Route::get('/upload', function() {
                return view('e-learning/lesson/instructor/upload_vimeo');
            });
            Route::post('/create', 'store')->name('lesson.store');
            Route::get('/{slug}/edit', 'edit')->name('lesson.edit'); 
            Route::post('/{slug}/edit', 'update')->name('lesson.update');
            Route::delete('/{slug}/destroy', 'destroy')->name('lesson.destroy');
        });
    
        // course bundle page routes
        Route::prefix('bundle/courses')->controller(CourseBundleController::class)->group(function () {
            Route::get('/', 'index'); 
            Route::get('/create', 'create'); 
            Route::get('/select/course/1', 'step1'); 
            Route::get('/select/course/2', 'step2'); 
            Route::post('/create', 'store')->name('course.bundle.store');
            Route::get('/{slug}', 'show')->name('course.bundle.show'); 
            Route::get('/{slug}/edit', 'edit')->name('course.bundle.edit'); 
            Route::post('/{slug}/edit', 'update')->name('course.bundle.update'); 
            Route::delete('/{slug}/destroy', 'destroy')->name('course.bundle.destroy');
        });
        // theme settings page routes
        Route::prefix('theme/setting')->controller(ModuleSettingController::class)->group(function() {
            Route::get('/{id}', 'index')->name('module.setting');
            Route::get('dns/{id}', 'dnsTheme')->name('module.dns.setting');
            Route::get('/{id}/edit', 'edit')->name('module.setting.edit');
            // Route::post('/updateorinsert', 'store')->name('module.setting.update');
        });
        // profile management page routes
        Route::prefix('profile')->controller(ProfileManagementController::class)->group(function () {
            Route::get('/myprofile', 'show')->name('instructor.profile'); 
            Route::get('/edit', 'edit'); 
            Route::post('/edit', 'update')->name('instructor.profile.update'); 
            Route::get('/change-password', 'passwordUpdate');
            Route::post('/change-password', 'postChangePassword')->name('instructor.password.update');
        });
        Route::prefix('profile')->controller(ExperienceController::class)->group(function () {
            Route::post('/experience','store')->name('instructor.profile.experience');
        });

        // settings page routes
        Route::prefix('settings')->controller(SettingsController::class)->group(function () {
            Route::get('/stripe', 'stripeIndex')->name('instructor.stripe');
            Route::get('/vimeo', 'vimeoIndex')->name('instructor.vimeo');
        });
        // all students profile page routes for instructor
        Route::prefix('students')->controller(StudentController::class)->group(function () {
            Route::get('/', 'index')->name('allStudents'); 
            Route::get('/datatable', 'studentsDataTable')->name('students.data.table');
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('student.add');
            Route::get('/profile/{id}', 'show')->name('studentProfile'); 
            Route::get('/{id}/edit', 'edit'); 
            Route::post('/{id}/edit', 'update')->name('updateStudentProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('student.destroy');
        });
    });
    // SubscriptionController
    Route::prefix('subscription')->controller(SubscriptionController::class)->group(function () {
        Route::get('/', 'index')->name('instructor.subscription'); 
        Route::get('/create/{id}', 'create')->name('instructor.subscription.create');
        Route::get('success', 'success')->name('instructor.subscription.success');
        Route::get('/cancel', 'cancel')->name('instructor.subscription.cancel');
    });
});

// review page routes
Route::middleware('auth')->prefix('review')->controller(ReviewController::class)->group(function () {
    Route::get('/', 'index'); 
});

/* ========================================================== */
/* ===================== Student Routes ===================== */
/* ========================================================== */
Route::get('/dashboard1', function(){
    return 'Student dashboard!';
});
Route::middleware(['auth', 'verified', 'role:student'])->prefix('students')->controller(StudentHomeController::class)->group(function () {
    // Student routes
    Route::get('/dashboard1', function(){
        return 'Student dashboard from auth!';
    });
    Route::get('/dashboard', 'dashboard')->name('students.dashboard');
    Route::get('/dashboard/enrolled', 'enrolled')->name('students.dashboard.enrolled');
    Route::get('/home','catalog')->name('students.catalog.courses');
    Route::get('/catalog/courses', 'catalog')->name('students.catalog.courses');
    Route::get('/courses/{slug}', 'show')->name('students.show.courses'); 
    Route::get('/courses/overview/{slug}', 'overview')->name('students.overview.courses'); 
    Route::get('/courses/my-courses/details/{slug}', 'courseDetails')->name('students.overview.myCourses'); 
    Route::get('/courses-log', 'storeCourseLog')->name('students.log.courses'); 
    Route::get('/courses-activies', 'storeActivities')->name('students.complete.lesson'); 
    Route::get('/courses-certificate', 'certificate')->name('students.certificate.course'); 
    Route::post('/courses/{slug}', 'review')->name('students.review.courses'); 
    Route::get('/courses/{slug}/message', 'message')->name('students.courses.message');  
    Route::get('/account-management', 'accountManagement')->name('students.account.management');

    
    // student checkout page routes
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
        Route::get('/{slug}', 'index')->name('students.checkout'); 
        Route::post('/{slug}', 'store')->name('students.checkout.store'); 
        Route::get('/{slug}/success', 'success')->name('checkout.success'); 
        Route::get('/{slug}/cancel', 'cancel')->name('checkout.cancel'); 
    });

    // student bundle course checkout
    Route::prefix('bundle/checkout')->controller(CheckoutBundleController::class)->group(function () {
        Route::get('/{slug}', 'index')->name('students.bundle.checkout'); 
        Route::post('/{slug}', 'store')->name('students.bundle.checkout.store'); 
        Route::get('/{slug}/success', 'success')->name('bundle.checkout.success'); 
        Route::get('/{slug}/cancel', 'cancel')->name('bundle.checkout.cancel'); 
    });

    // student own profile management page routes
    Route::prefix('profile')->controller(StudentProfileController::class)->group(function () {
        Route::get('/myprofile', 'show')->name('students.profile'); 
        Route::get('/edit', 'edit'); 
        Route::post('/edit', 'update')->name('students.profile.update'); 
        Route::get('/change-password', 'passwordUpdate');
        Route::post('/change-password', 'postChangePassword')->name('students.password.update');
    });
});

/* ======================================================== */
/* ===================== Admin Routes ===================== */
/* ======================================================== */
Route::middleware('auth')->prefix('admin')->controller(AdminHomeController::class)->group(function () {
    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/dashboard/top-perform/courses', 'perform');
        // all admin profile manage routes for admin
        Route::prefix('alladmin')->controller(AdminManagementController::class)->group(function () {
            Route::get('/', 'index')->name('allAdmin'); 
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('allAdmin.add');
            Route::get('/profile/{id}', 'show')->name('allAdmin.profile'); 
            Route::get('/{id}/edit', 'edit'); 
            Route::post('/{id}/edit', 'update')->name('updateAllAdminProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('allAdmin.destroy');
        });
        // admin instructor routes 
        Route::prefix('instructor')->controller(InstructorController::class)->group(function () {
            Route::get('/', 'index');  
            Route::get('/datatable', 'instructorDataTable')->name('instructor.data.table');
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('instructor.add');
            Route::get('/profile/{id}', 'show')->name('instructorProfile');
            Route::get('/{id}/edit', 'edit'); 
            Route::post('/{id}/edit', 'update')->name('updateInstructorProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('instructor.destroy');
        });
        // all students manage routes for admin
        Route::prefix('students')->controller(StudentManagementController::class)->group(function () {
            Route::get('/', 'index')->name('admin.allStudents');  
            // data table route 
            Route::get('/datatable', 'studentsDataTable')->name('admin.students.data.table');
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('admin.student.add');
            Route::get('/profile/{id}', 'show')->name('admin.studentProfile'); 
            Route::get('/{id}/edit', 'edit'); 
            Route::post('/{id}/edit', 'update')->name('admin.updateStudentProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('admin.student.destroy');
        });
        // course page routes for admin
        Route::prefix('courses')->controller(CourseManagementController::class)->group(function () {
            Route::get('/', 'index')->name('admin.courses'); 
            // data table route 
            Route::get('/datatable', 'courseDataTable')->name('admin.courses.data.table'); 
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('admin.course.store');
            Route::get('/{slug}', 'show')->name('admin.course.show'); 
            Route::get('/{slug}/edit', 'edit')->name('admin.course.edit');
            Route::post('/{slug}/edit', 'update')->name('admin.course.update'); 
            Route::delete('/{slug}/destroy', 'destroy')->name('admin.course.destroy');
        });
        // Subscription paege modify routes for admin
        Route::prefix('manage/subscriptionpackage')->controller(AdminSubscriptionPackageController::class)->group(function () {
            Route::get('/', 'index')->name('admin.subscription'); 
            Route::get('/datatable', 'subscriptionDataTable')->name('admin.subscription.data.table');
            Route::get('/create', 'create')->name('admin.subscription.create');
            Route::post('/store', 'store')->name('admin.subscription.store');
            Route::get('/{slug}', 'show')->name('admin.subscription.show'); 
            Route::get('/{slug}/edit', 'edit')->name('admin.subscription.edit');
            Route::post('/{slug}/edit', 'update')->name('admin.subscription.update'); 
            Route::delete('/{slug}/destroy', 'destroy')->name('admin.subscription.destroy');
        });
        // course bundle page routes for admin
        Route::prefix('bundle/courses')->controller(BundleCourseManagementController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/datatable', 'bundleDataTable')->name('admin.bundle.data.table');
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('admin.course.bundle.store');
            Route::get('/{slug}', 'show')->name('admin.course.bundle.show'); 
            Route::get('/{slug}/edit', 'edit')->name('admin.course.bundle.edit'); 
            Route::post('/{slug}/edit', 'update')->name('admin.course.bundle.update'); 
            Route::delete('/{slug}/destroy', 'destroy')->name('admin.course.bundle.destroy');
        });
        // module page routes for admin
        Route::prefix('modules')->controller(ModuleManagementController::class)->group(function () {
            Route::get('/', 'index');  
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('admin.module.store');
            Route::get('/{slug}/edit', 'edit')->name('admin.module.edit'); 
            Route::post('/{slug}/edit', 'update')->name('admin.module.update'); 
            Route::delete('/{slug}/destroy', 'destroy')->name('admin.module.destroy');
        });
        // lesson page routes for admin
        Route::prefix('lessons')->controller(LessonManagementController::class)->group(function () {
            Route::get('/', 'index');
            // data table route 
            Route::get('/datatable', 'lessonsDataTable')->name('admin.lessons.data.table'); 
            Route::get('/create', 'create'); 
            Route::post('/create', 'store')->name('admin.lesson.store');
            Route::get('/{slug}/edit', 'edit')->name('admin.lesson.edit'); 
            Route::post('/{slug}/edit', 'update')->name('admin.lesson.update');
            Route::delete('/{slug}/destroy', 'destroy')->name('admin.lesson.destroy');
        });
        // admin own profile management page routes
        Route::prefix('profile')->controller(AdminProfileController::class)->group(function () {
            Route::get('/myprofile', 'show')->name('admin.profile'); 
            Route::get('/edit', 'edit'); 
            Route::post('/edit', 'update')->name('admin.profile.update'); 
            Route::get('/change-password', 'passwordUpdate');
            Route::post('/change-password', 'postChangePassword')->name('admin.password.update');
            Route::get('/platform-fee', 'adminPayment');  
            Route::get('/platform-fee/data', 'adminPaymentData')->name('admin.admin-payment');
        });
    });
});

Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/login');
});

/**
 * if page not found then redirect to 404 page
 */
Route::fallback(function () {
    return redirect()->route('tlogin');
});