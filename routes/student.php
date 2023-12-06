<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Student\StudentHomeController;
use App\Http\Controllers\Student\CheckoutBundleController;
use App\Http\Controllers\Student\StudentProfileController;


Route::post('/students/stripe-process-payment', [PaymentController::class, 'processPayment'])->name('process-payment');


//Start Notification
Route::get('students/notification-details', [NotificationController::class, 'notificationDetails'])->name('notification.details');
Route::post('students/notification-details/destroy/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
//End Notification



Route::middleware(['auth', 'verified', 'role:student'])->prefix('students')->controller(StudentHomeController::class)->group(function () {

    Route::get('/dashboard', 'dashboard')->name('students.dashboard')->middleware('page.access');
    Route::get('/dashboard/enrolled', 'enrolled')->name('students.dashboard.enrolled');
    Route::get('/home', 'catalog')->name('students.catalog.courses')->middleware('page.access');
    Route::get('/catalog/courses', 'catalog')->name('students.catalog.courses');
    Route::get('/courses/{slug}', 'show')->name('students.show.courses');
    Route::get('/file-download/{course_id}/{extension}', 'fileDownload')->name('file.download');
    Route::get('/certificate-download/{slug}', 'certificateDownload')->name('students.download.courses-certificate');
    Route::get('/certificate-view/{slug}', 'certificateView')->name('students.view.courses-certificate');
    Route::get('/courses/overview/{slug}', 'overview')->name('students.overview.courses');
    Route::get('/courses/my-courses/details/{slug}', 'courseDetails')->name('students.overview.myCourses');
    Route::get('/courses-log', 'storeCourseLog')->name('students.log.courses');
    Route::get('/courses-activies/list', 'activitiesList')->name('students.activity.lesson');
    Route::get('/courses-activies', 'storeActivities')->name('students.complete.lesson');
    Route::get('/courses-certificate', 'certificate')->name('students.certificate.course')->middleware('page.access');
    Route::post('/courses/{slug}', 'review')->name('students.review.courses');
    Route::get('/courses/{slug}/message', 'message')->name('students.courses.message');
    Route::get('/account-management', 'accountManagement')->name('students.account.management');
    Route::post('/course-like/{course_id}/{ins_id}', 'courseLike')->name('students.course.like');
    Route::post('/course-unlike/{course_id}/{ins_id}', 'courseUnLike')->name('students.course.unlike');

    // student checkout page routes
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
        Route::get('/{slug}', 'index')->name('students.checkout');
        Route::get('/', 'indexOfCart')->name('students.checkout.cart');
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
        Route::post('/cover/upload', 'coverUpload');
        Route::post('/edit', 'update')->name('students.profile.update');
        Route::get('/change-password', 'passwordUpdate');
        Route::post('/change-password', 'postChangePassword')->name('students.password.update');
    });
});

Route::middleware(['auth', 'verified', 'role:student'])->prefix('students')->controller(CartController::class)->group(function () {
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/add/{course}', 'add')->name('cart.add');
    Route::post('/cart/remove/{id}', 'remove')->name('cart.remove');
});



Route::prefix('students')->controller(CartController::class)->group(function () {
    Route::post('/cart/added/{course}', 'addToCartSkippLogin')->name('cart.added');
});

Route::prefix('students')->controller(CartController::class)->group(function () {
    Route::post('/cart/bundle/{bundlecourse}', 'addToCartBundlekippLogin')->name('cart.added.bundle');
});
