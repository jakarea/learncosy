<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\StudentHomeController;
use App\Http\Controllers\Student\CheckoutBundleController;
use App\Http\Controllers\Student\StudentProfileController;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Student routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Student" middleware group. Enjoy building your API!
|
*/

Route::post('/students/stripe-process-payment', [PaymentController::class, 'processPayment'])->name('process-payment');


//Start Notification
Route::get('students/notification-details', [NotificationController::class, 'notificationDetails'])->name('notification.details');
Route::post('students/notification-details/destroy/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
//End Notification

$domain = env('APP_DOMAIN', 'learncosy.com');


Route::domain('{subdomain}.' . $domain)->middleware(['auth', 'role:student'])->group(function () {

    Route::get('students/dashboard', [StudentHomeController::class, 'dashboard'])->name('students.dashboard')->middleware('page.access');
    Route::get('students/dashboard/enrolled', [StudentHomeController::class,'enrolled'])->name('students.dashboard.enrolled');
    Route::get('students/home', [StudentHomeController::class, 'catalog'])->name('students.catalog.courses')->middleware('page.access');
    Route::get('students/catalog/courses', [StudentHomeController::class,'catalog'])->name('students.catalog.courses');
    Route::get('students/courses/{slug}', [StudentHomeController::class,'show'])->name('students.show.courses');
    Route::get('students/file-download/{course_id}/{extension}', [StudentHomeController::class, 'fileDownload'])->name('file.download');
    Route::get('students/certificate-download/{slug}', [StudentHomeController::class, 'certificateDownload'])->name('students.download.courses-certificate');
    Route::get('students/certificate-view/{slug}', [StudentHomeController::class, 'certificateView'])->name('students.view.courses-certificate');
    Route::get('students/courses/overview/{slug}', [StudentHomeController::class, 'overview'])->name('students.overview.courses');
    Route::get('students/courses/my-courses/details/{slug}', [StudentHomeController::class, 'courseDetails'])->name('students.overview.myCourses');
    Route::get('students/courses-log', [StudentHomeController::class, 'storeCourseLog'])->name('students.log.courses');
    Route::get('students/courses-activies/list', [StudentHomeController::class, 'activitiesList'])->name('students.activity.lesson');
    Route::get('students/courses-activies', [StudentHomeController::class, 'storeActivities'])->name('students.complete.lesson');
    Route::get('students/courses-certificate', [StudentHomeController::class, 'certificate'])->name('students.certificate.course')->middleware('page.access');
    Route::post('students/courses/{slug}', [StudentHomeController::class, 'review'])->name('students.review.courses');
    Route::get('students/courses/{slug}/message', [StudentHomeController::class, 'message'])->name('students.courses.message');
    Route::get('students/account-management', [StudentHomeController::class, 'accountManagement'])->name('students.account.management');
    Route::post('students/course-like/{course_id}/{ins_id}', [StudentHomeController::class, 'courseLike'])->name('students.course.like');
    Route::post('students/course-unlike/{course_id}/{ins_id}', [StudentHomeController::class, 'courseUnLike'])->name('students.course.unlike');

    // student checkout page routes

    Route::get('checkout/{slug}', [CheckoutController::class, 'index'])->name('students.checkout');
    Route::get('checkout/', [CheckoutController::class, 'indexOfCart'])->name('students.checkout.cart');
    Route::post('checkout/{slug}', [CheckoutController::class, 'store'])->name('students.checkout.store');
    Route::get('checkout/{slug}/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('checkout/{slug}/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');


    // // student bundle course checkout
    Route::get('bundle/checkout/{slug}', [CheckoutBundleController::class, 'index'])->name('students.bundle.checkout');
    Route::post('bundle/checkout/{slug}', [CheckoutBundleController::class, 'store'])->name('students.bundle.checkout.store');
    Route::get('bundle/checkout/{slug}/success', [CheckoutBundleController::class, 'success'])->name('bundle.checkout.success');
    Route::get('bundle/checkout/{slug}/cancel', [CheckoutBundleController::class, 'cancel'])->name('bundle.checkout.cancel');


    // // student own profile management page routes
    Route::get('students/profile/myprofile', [StudentProfileController::class, 'show'])->name('students.profile');
    Route::get('students/profile/edit', [StudentProfileController::class, 'edit']);
    Route::post('students/profile/cover/upload', [StudentProfileController::class, 'coverUpload']);
    Route::post('students/profile/edit', [StudentProfileController::class, 'update'])->name('students.profile.update');
    Route::get('students/profile/change-password', [StudentProfileController::class, 'passwordUpdate']);
    Route::post('students/profile/change-password', [StudentProfileController::class, 'postChangePassword'])->name('students.password.update');

});



Route::domain('{subdomain}.' . $domain)->group(function () {
    Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
        Route::get('students/cart', [CartController::class, 'index'])->name('cart.index');

        // Route::post('students/cart/buycourse/{id}', [CartController::class, 'buyCourse'])->name('buy.course');
        Route::post('students/cart/add/{course}', [CartController::class, 'add'])->name('cart.add');
        Route::post('students/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    });



    Route::post('students/cart/buycourse/{id}', [CartController::class, 'buyCourse'])->name('buy.course');


    Route::post('students/cart/added/{course}', [CartController::class, 'addToCartSkippLogin'])->name('cart.added');
    Route::post('students/cart/bundle/{bundlecourse}', [CartController::class, 'addToCartBundlekippLogin'])->name('cart.added.bundle');

});

