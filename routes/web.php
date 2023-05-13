<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\ProfileManagementController;

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

Route::get('/', function () {
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
Route::prefix('instructors')->controller(ProfileManagementController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/profile/{slug}', 'show'); 
    Route::get('/profile/{slug}/edit', 'edit'); 
});