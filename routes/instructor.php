<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomepageController;
/*
|--------------------------------------------------------------------------
| Instructor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register instructor routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "instructor" middleware group. Enjoy building your API!
|
*/

// Route::get('/', function ($instructor) {
//     // return "Hello from teacher instructor $instructor";
//     return redirect()->route('instructor.home', ['username' => 'instructor']);
// });
Route::get('/', [HomepageController::class, 'instructorHome'])->name('instructor.home');
Route::get('/courses', [HomepageController::class, 'instructorHome']);
Route::get('/courses/{slug}', [HomepageController::class, 'homeInstructorCourseDetails']);

// Route::get('/{instructor}', [HomepageController::class, 'instructorHome'])->name('instructor.home');
