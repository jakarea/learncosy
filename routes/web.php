<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Student\StudentHomeController;
use App\Http\Controllers\Admin\CourseManagementController;
use App\Http\Controllers\Admin\LessonManagementController;
use App\Http\Controllers\Admin\ModuleManagementController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Admin\StudentManagementController;
use App\Http\Controllers\Admin\BundleCourseManagementController;
use App\Http\Controllers\Admin\AdminSubscriptionPackageController;

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


Route::get('/test', function(){
    return 'Hello';
});

// new dashboard route
Route::get('/new-dashboard', function(){
    return view('dashboard/index');
});

Route::get('/new-dashboard/projects', function(){
    return view('dashboard/projects');
});
Route::get('/new-dashboard/contacts', function(){
    return view('dashboard/contacts');
});
Route::get('/new-dashboard/kanban', function(){
    return view('dashboard/kanban');
});
Route::get('/new-dashboard/calendar', function(){
    return view('dashboard/calendar');
});

Route::get('/new-dashboard/messages', function(){
    return view('dashboard/messages');
});

// login scrren route
Route::get('/{username}/login', function(){
    return view('login/login');
}); 


Route::get('/chart', 'App\Http\Controllers\Frontend\HomepageController@index')->name('home')->middleware('auth');

Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'App\Http\Controllers\Frontend\HomepageController@index')->name('home');
    Route::get('/{id}', 'App\Http\Controllers\Frontend\HomepageController@show')->name('home.instructor.course');
    Route::get('/instructor/{id}', 'App\Http\Controllers\Frontend\HomepageController@instructorHome')->name('home.instructor.details');
    Route::get('/instructor/{id}/course', 'App\Http\Controllers\Frontend\HomepageController@instructorCourseDetails')->name('home.instructor.details');
    Route::get('/instructor/{id}/course/{slug}', 'App\Http\Controllers\Frontend\HomepageController@instructorCourseDetailsWithSlug')->name('home.instructor.details.course.slug');
});

// all admin profile manage routes for admin
Route::middleware('auth')->prefix('admin/alladmin')->controller(AdminManagementController::class)->group(function () {
    Route::get('/', 'index')->name('allAdmin'); 
    Route::get('/create', 'create'); 
    Route::post('/create', 'store')->name('allAdmin.add');
    Route::get('/profile/{id}', 'show')->name('allAdmin.profile'); 
    Route::get('/{id}/edit', 'edit'); 
    Route::post('/{id}/edit', 'update')->name('updateAllAdminProfile');
    Route::delete('/{id}/destroy', 'destroy')->name('allAdmin.destroy');
});


Route::middleware('auth')->get('/', function () {
    if(Auth::user()->user_role == 'student')
        return redirect('/students/dashboard');
    if(Auth::user()->user_role == 'admin')
        return redirect('/admin/dashboard');
    return redirect('/instructor/dashboard');
});

// instructor payment history static pages
Route::middleware('auth')->prefix('instructor/payments')->controller(HomeController::class)->group(function () {  
    Route::get('/', 'studentsPayment');  
    Route::get('/platform-fee', 'adminPayment');  
    Route::get('/platform-fee/data', 'adminPaymentData')->name('instructor.admin-payment');
});

// message pages routes
Route::middleware('auth')->prefix('course/messages')->controller(MessageController::class)->group(function () {  
    Route::get('/', 'index'); 
    Route::get('/send/{id}', 'send')->name('get.message');
    Route::get('/chat_room/{id}', 'getChatRoomMessages')->name('get.chat_room.message');
    Route::post('/chat_room/{chat_room}', 'postChatRoomMessages')->name('post.chat_room.message');
    Route::post('/send/{course_id}', 'submitMessage')->name('post.message');
});

// course page routes
Route::group(['middleware' => ['subscription.check']], function () {
    // course page routes
    Route::middleware('auth')->prefix('instructor/courses')->controller(CourseController::class)->group(function () {
        Route::get('/', 'index')->name('instructor.courses'); 
        // data table route 
        Route::get('/datatable', 'courseDataTable')->name('courses.data.table'); 
        Route::get('/create', 'create');
        Route::post('/create', 'store')->name('course.store');
        Route::get('/{slug}', 'show')->name('course.show');   
        Route::get('/{slug}/edit', 'edit')->name('course.edit');
        Route::post('/{slug}/edit', 'update')->name('course.update'); 
        Route::delete('/{slug}/destroy', 'destroy')->name('course.destroy');
    });
});

Route::middleware('auth')->prefix('instructor')->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('instructor.dashboard.index');
});

Route::group(['middleware' => ['subscription.check']], function () {
    // module page routes
    Route::middleware('auth')->prefix('instructor/modules')->controller(ModuleController::class)->group(function () {
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
    Route::middleware('auth')->prefix('instructor/lessons')->controller(LessonController::class)->group(function () {
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
    Route::middleware('auth')->prefix('instructor/bundle/courses')->controller(CourseBundleController::class)->group(function () {
        Route::get('/', 'index');
        // data table route 
        Route::get('/datatable', 'bundleDataTable')->name('bundle.data.table');
        Route::get('/create', 'create'); 
        Route::post('/create', 'store')->name('course.bundle.store');
        Route::get('/{slug}', 'show')->name('course.bundle.show'); 
        Route::get('/{slug}/edit', 'edit')->name('course.bundle.edit'); 
        Route::post('/{slug}/edit', 'update')->name('course.bundle.update'); 
        Route::delete('/{slug}/destroy', 'destroy')->name('course.bundle.destroy');
    });
    // theme settings page routes
    Route::middleware('auth')->prefix('instructor/theme/setting')->controller(ModuleSettingController::class)->group(function() {
        Route::get('/{id}', 'index')->name('module.setting');
        Route::get('/{id}/edit', 'edit')->name('module.setting.edit');
        Route::post('/updateorinsert', 'store')->name('module.setting.update');
    });
});
// profile management page routes
Route::middleware('auth')->prefix('instructor/profile')->controller(ProfileManagementController::class)->group(function () {
    Route::get('/myprofile', 'show')->name('instructor.profile'); 
    Route::get('/edit', 'edit'); 
    Route::post('/edit', 'update')->name('instructor.profile.update'); 
    Route::get('/change-password', 'passwordUpdate');
    Route::post('/change-password', 'postChangePassword')->name('instructor.password.update');
});

// SubscriptionController
Route::middleware('auth')->prefix('instructor/subscription')->controller(SubscriptionController::class)->group(function () {
    Route::get('/', 'index')->name('instructor.subscription'); 
    Route::get('/create/{id}', 'create')->name('instructor.subscription.create');
    Route::get('success', 'success')->name('instructor.subscription.success');
    Route::get('/cancel', 'cancel')->name('instructor.subscription.cancel');
});

// settings page routes
Route::middleware('auth')->prefix('instructor/settings')->controller(SettingsController::class)->group(function () {
    Route::get('/stripe', 'stripeIndex')->name('instructor.stripe');
    Route::post('/stripe/request', 'stripeUpdate')->name('instructor.stripe.update');
    Route::get('/vimeo', 'vimeoIndex')->name('instructor.vimeo');
    Route::post('/vimeo/request', 'vimeoUpdate')->name('instructor.vimeo.update');
});

// review page routes
Route::middleware('auth')->prefix('review')->controller(ReviewController::class)->group(function () {
    Route::get('/', 'index'); 
});

// all students profile page routes for instructor
Route::middleware('auth')->prefix('instructor/students')->controller(StudentController::class)->group(function () {
    Route::get('/', 'index')->name('allStudents'); 
    // data table route 
    Route::get('/datatable', 'studentsDataTable')->name('students.data.table');
    Route::get('/create', 'create'); 
    Route::post('/create', 'store')->name('student.add');
    Route::get('/profile/{id}', 'show')->name('studentProfile'); 
    Route::get('/{id}/edit', 'edit'); 
    Route::post('/{id}/edit', 'update')->name('updateStudentProfile');
    Route::delete('/{id}/destroy', 'destroy')->name('student.destroy');
});
 
// student home page routes
Route::middleware('auth')->prefix('students')->controller(StudentHomeController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('students.dashboard');
    Route::get('/dashboard/enrolled', 'enrolled')->name('students.dashboard.enrolled');
    Route::get('/home','catalog')->name('students.catalog.courses');
    Route::get('/catalog/courses', 'catalog')->name('students.catalog.courses');
    Route::get('/courses/{slug}', 'show')->name('students.show.courses'); 
    Route::get('/courses-log', 'storeCourseLog')->name('students.log.courses'); 
    Route::get('/courses-activies', 'storeActivities')->name('students.complete.lesson'); 
    Route::post('/courses/{slug}', 'review')->name('students.review.courses'); 
    Route::get('/courses/{slug}/message', 'message')->name('students.courses.message');  
    Route::get('/account-management', 'accountManagement')->name('students.account.management');
});

// student checkout page routes
Route::middleware('auth')->prefix('students/checkout')->controller(CheckoutController::class)->group(function () {
    Route::get('/{slug}', 'index')->name('students.checkout'); 
    Route::post('/{slug}', 'store')->name('students.checkout.store'); 
    Route::get('/{slug}/success', 'success')->name('checkout.success'); 
    Route::get('/{slug}/cancel', 'cancel')->name('checkout.cancel'); 
});

// student own profile management page routes
Route::middleware('auth')->prefix('students/profile')->controller(StudentProfileController::class)->group(function () {
    Route::get('/myprofile', 'show')->name('students.profile'); 
    Route::get('/edit', 'edit'); 
    Route::post('/edit', 'update')->name('students.profile.update'); 
    Route::get('/change-password', 'passwordUpdate');
    Route::post('/change-password', 'postChangePassword')->name('students.password.update');
});

// admin homepage routes 
Route::middleware('auth')->prefix('admin')->controller(AdminHomeController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('admin.dashboard');  
});

// admin instructor routes 
Route::middleware('auth')->prefix('admin/instructor')->controller(InstructorController::class)->group(function () {
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
Route::middleware('auth')->prefix('admin/students')->controller(StudentManagementController::class)->group(function () {
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
Route::middleware('auth')->prefix('admin/courses')->controller(CourseManagementController::class)->group(function () {
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
Route::middleware('auth')->prefix('admin/manage/subscriptionpackage')->controller(AdminSubscriptionPackageController::class)->group(function () {
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
Route::middleware('auth')->prefix('admin/bundle/courses')->controller(BundleCourseManagementController::class)->group(function () {
    Route::get('/', 'index');
     // data table route 
     Route::get('/datatable', 'bundleDataTable')->name('admin.bundle.data.table');
    Route::get('/create', 'create'); 
    Route::post('/create', 'store')->name('admin.course.bundle.store');
    Route::get('/{slug}', 'show')->name('admin.course.bundle.show'); 
    Route::get('/{slug}/edit', 'edit')->name('admin.course.bundle.edit'); 
    Route::post('/{slug}/edit', 'update')->name('admin.course.bundle.update'); 
    Route::delete('/{slug}/destroy', 'destroy')->name('admin.course.bundle.destroy');
});

// module page routes for admin
Route::middleware('auth')->prefix('admin/modules')->controller(ModuleManagementController::class)->group(function () {
    Route::get('/', 'index');
    // data table route 
    Route::get('/datatable', 'modulesDataTable')->name('admin.modules.data.table'); 
    Route::get('/create', 'create'); 
    Route::post('/create', 'store')->name('admin.module.store');
    Route::get('/{slug}/edit', 'edit')->name('admin.module.edit'); 
    Route::post('/{slug}/edit', 'update')->name('admin.module.update'); 
    Route::delete('/{slug}/destroy', 'destroy')->name('admin.module.destroy');
});

// lesson page routes for admin
Route::middleware('auth')->prefix('admin/lessons')->controller(LessonManagementController::class)->group(function () {
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
Route::middleware('auth')->prefix('admin/profile')->controller(AdminProfileController::class)->group(function () {
    Route::get('/myprofile', 'show')->name('admin.profile'); 
    Route::get('/edit', 'edit'); 
    Route::post('/edit', 'update')->name('admin.profile.update'); 
    Route::get('/change-password', 'passwordUpdate');
    Route::post('/change-password', 'postChangePassword')->name('admin.password.update');

    Route::get('/platform-fee', 'adminPayment');  
    Route::get('/platform-fee/data', 'adminPaymentData')->name('admin.admin-payment');
});

// auth route 
Auth::routes();
Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/login');
});

Route::get('/{username}', [HomepageController::class, 'instructorHome']);
Route::get('/{username}/courses', [HomepageController::class, 'instructorHome']);
Route::get('/{username}/courses/{slug}', [HomepageController::class, 'homeInstructorCourseDetails']);
