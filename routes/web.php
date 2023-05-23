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

Route::get('/home', function () {
    return view('home');
});


Route::middleware('auth')->get('/', function () {
    return view('home');
});

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

// profile management page routes
Route::middleware('auth')->middleware('auth')->prefix('profile')->controller(ProfileManagementController::class)->group(function () {
    Route::get('/myprofile', 'show')->name('myProfile'); 
    Route::get('/edit', 'edit'); 
    Route::post('/edit', 'update')->name('updateMyProfile'); 
    Route::get('/change-password', 'passwordUpdate');
    Route::post('/change-password', 'postChangePassword')->name('postChangePassword');
});

// settings page routes
Route::middleware('auth')->prefix('settings')->controller(SettingsController::class)->group(function () {
    Route::get('/instructor/stripe', 'stripeIndex');
    Route::get('/instructor/vimeo', 'vimeoIndex');
});

// review page routes
Route::middleware('auth')->prefix('review')->controller(ReviewController::class)->group(function () {
    Route::get('/', 'index'); 
});

// student page routes
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// auth route 
Auth::routes();