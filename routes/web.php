<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StudentController;

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

// Route::get('/home', function () {
//     return view('blank');
// });


Route::middleware('auth')->get('/', function () {
    return view('blank');
});

// course page routes
Route::prefix('course')->controller(CourseController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/create', 'store')->name('course.store');
    Route::get('/{slug}', 'show')->name('course.show'); 
});

// module page routes
Route::prefix('module')->controller(ModuleController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create'); 
});

// lesson page routes
Route::prefix('lesson')->controller(LessonController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create'); 
});

// course bundle page routes
Route::prefix('bundle/course')->controller(CourseBundleController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create'); 
});

// profile management page routes
Route::middleware('auth')->prefix('profile')->controller(ProfileManagementController::class)->group(function () {
    // Route::get('/', 'index');
    // Route::get('/create', 'create');
    Route::get('/myprofile', 'show')->name('myProfile'); 
    Route::get('/edit', 'edit'); 
    Route::post('/edit', 'update')->name('updateMyProfile'); 
    Route::get('/change-password', 'passwordUpdate');
    Route::post('/change-password', 'postChangePassword')->name('postChangePassword');
});

// settings page routes
Route::prefix('settings')->controller(SettingsController::class)->group(function () {
    Route::get('/instructor/stripe', 'stripeIndex');
    Route::get('/instructor/vimeo', 'vimeoIndex');
});

// review page routes
Route::prefix('review')->controller(ReviewController::class)->group(function () {
    Route::get('/', 'index'); 
});

// student page routes
Route::prefix('students')->controller(StudentController::class)->group(function () {
    Route::get('/', 'index'); 
    Route::get('/create', 'create'); 
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
