<?php

use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\CourseCreateStepController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\Instructor\DashboardController;

/* ============================================================= */
/* ===================== Instructor Routes ===================== */
/* ============================================================= */

Route::middleware(['auth', 'verified', 'role:instructor'])->prefix('instructor')->group(function () {
    Route::get('/profile/step-1/complete', function () {
        if (Auth::user()->email_verified_at == null) {
            return view('auth.verify');
        } else {
            return redirect('/profile/step-2/complete');
        }
    });
    Route::get('/profile/step-2/complete', function () {
        return view('latest-auth.price');
    });
    Route::get('/profile/step-2/payment/{id}', function ($id) {
        $package = SubscriptionPackage::findorfail($id);
        return view('latest-auth.payment', compact('package'));
    });

    Route::get('/profile/step-3/complete', [DashboardController::class, 'subdomain']);

    // Instructor Notification
    Route::get('/notifications', [DashboardController::class, 'notifications'])->name('instructor.notify');
    Route::post('/notification/destroy/{id}', [DashboardController::class, 'notifyDestroy'])->name('instructor.notify.destroy');

    Route::get('/profile/step-4/complete', function () {
        return view('latest-auth.connect');
    });
    Route::get('/profile/step-5/complete', function () {
        return view('latest-auth.theme-settings');
    });
    Route::get('/profile/step-6/complete', function () {
        return view('latest-auth.make-course');
    });
    // settings page routes
    Route::prefix('settings')->controller(SettingsController::class)->group(function () {
        Route::post('/stripe/request', 'stripeUpdate')->name('instructor.stripe.update');
        Route::post('/vimeo/request', 'vimeoUpdate')->name('instructor.vimeo.update');
    });

    Route::prefix('theme/setting')->controller(ModuleSettingController::class)->group(function () {
        Route::post('/updateorinsert', 'store')->name('module.setting.update');
    });

    // profile management page routes
    Route::prefix('profile')->controller(DashboardController::class)->group(function () {
        Route::post('/edit/{id}', 'checkSubdomain')->name('instructor.subdomain.update');
    });
    // only subscription instructor can access this route
    Route::group(['middleware' => ['subscription.check']], function () {
        Route::get('dashboard', [DashboardController::class, 'analytics'])->name('instructor.dashboard.analytics');
        Route::get('analytics', [DashboardController::class, 'index'])->name('instructor.dashboard.index');
        Route::get('manage-access', [DashboardController::class, 'manageAccess'])->name('instructor.manage.access');
        Route::post('manage-access', [DashboardController::class, 'pageAccess'])->name('instructor.manage.pages');
        // instructor payment history pages
        Route::prefix('payments')->controller(HomeController::class)->group(function () {
            Route::get('/', 'studentsPayment');
            Route::get('/{payment_id}', 'details');
            Route::get('/generate-pdf/{id}', 'generatePdf')->name('generate-pdf');
            Route::get('/invoice-mail/{id}', 'invoiceMail')->name('invoice-mail');
            Route::get('/instructor-export/{id}', 'export')->name('instructor-export');
            Route::get('/platform-fee', 'adminPayment');
            Route::get('/platform-fee/data', 'adminPaymentData')->name('instructor.admin-payment');
        });
        // course page routes
        Route::prefix('courses')->controller(CourseController::class)->group(function () {
            Route::get('/', 'index')->name('instructor.courses');
            Route::get('/overview/{slug}', 'overview')->name('instructor.course.overview');
            Route::get('/file-download/{course_id}/{extension}', 'fileDownload')->name('instructor.file.download');
            Route::get('/{id}', 'show')->name('course.show')->where('id', '[0-9]+');
            Route::delete('/{id}/destroy', 'destroy')->name('course.destroy');
        });

        Route::prefix('courses/create')->controller(CourseCreateStepController::class)->group(function () {
            // add course static route
            Route::get('/', 'start')->name('course.create.step-1');
            Route::post('created/', 'startSet')->name('course.create.start');

            Route::get('/{id}/facts', 'step1');
            Route::post('/{id}/facts', 'step1c')->name('course.store.step-1');

            // Route::get('{id}', 'step3');
            Route::post('{id}', 'step3c');

            Route::post('{id}/factsd', 'step3cd')->name('course.module.step.create');
            Route::post('{id}/factsu', 'step3cu')->name('course.module.step.update');
            Route::post('{id}/facts-update', 'step3d')->name('course.lesson.step.update');

            Route::get('{id}/text/{module_id}/content/{lesson_id}', 'stepLessonText');
            Route::post('{lesson_id}/step-lesson-content', 'stepLessonContent')->name('course.lesson.text.update');

            Route::get('{id}/audio/{module_id}/content/{lesson_id}', 'stepLessonAudio');
            Route::post('{id}/audio/{module_id}/content/{lesson_id}', 'stepLessonAudioSet')->name('course.lesson.audio.create');

            Route::get('{id}/video/{module_id}/content/{lesson_id}', 'stepLessonVideo');
            Route::post('{id}/video/{module_id}/content/{lesson_id}', 'stepLessonVideoSet');

            Route::get('{id}/lesson/{module_id}/institute/{lesson_id}', 'stepLessonInstitue');

            Route::get('{id}/objects', 'courseObjects');

            Route::post('{id}/objects', 'courseObjectsSet');
            Route::post('/{courseId}/delete-objects/{dataIndex}', 'deleteObjective');

            Route::post('/updateObjectives/{id}', 'updateObjectives')->name('updateObjectives');

            Route::get('{id}/price', 'coursePrice');
            Route::post('{id}/price', 'coursePriceSet');

            Route::get('{id}/design', 'courseDesign');
            Route::post('{id}/design', 'courseDesignSet');

            Route::get('{id}/certificate', 'courseCertificate');
            Route::post('{id}/certificate', 'courseCertificateSet');

            Route::get('{id}/visibility', 'visibility');
            Route::post('{id}/visibility', 'visibilitySet');

            Route::get('{id}/share', 'courseShare');
        });
        // module page routes
        Route::prefix('modules')->controller(ModuleController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('module.store');
            Route::get('/{slug}/edit', 'edit')->name('module.edit');
            Route::post('/{slug}/edit', 'update')->name('module.update');
            Route::delete('/{slug}/destroy', 'destroy')->name('module.destroy');
        });

        // lesson page routes
        Route::prefix('lessons')->controller(LessonController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');

            Route::get('/create/video-upload', 'videoUpload')->name('lesson.upload.video');
            Route::get('/upload-vimeo', 'uploadVimeoPage')->name('lesson.upload.vimeo');
            Route::post('/upload-vimeo-submit', 'uploadViewToVimeo')->name('lesson.vimeo');
            Route::get('/progress', 'getProgress')->name('upload.progress');
            Route::get('/upload', function () {
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
            Route::get('/{slug}/view', 'view');

            Route::get('/select', 'step1');
            Route::post('/select/{course_id}', 'selectBundle')->name('select.bundle.course');

            Route::get('/create', 'step2');
            Route::post('/create', 'createBundle')->name('create.bundle.course');

            Route::get('{slug}/edit', 'edit1')->name('select.again.bundle.course');
            Route::post('{id}/select-update', 'update1');

            Route::get('{slug}/edit-final', 'edit2');
            Route::post('{slug}/edit-final', 'update2')->name('create.update.bundle.course');

            Route::post('/remove-new/{course_id}', 'removeSelectNew')->name('reove.select.bundle.course');
            Route::post('/remove/{course_id}', 'removeSelect')->name('reove.select.bundle.course');

            Route::post('/delete/{bundle_id}', 'delete')->name('delete.bundle.course');
        });
        // theme settings page routes
        Route::prefix('theme/setting')->controller(ModuleSettingController::class)->group(function () {
            Route::get('/', 'index')->name('module.setting');
            Route::get('/dns', 'dnsTheme')->name('module.setting.dns');
            Route::get('/{id}/edit', 'edit')->name('module.setting.edit');
            Route::post('/reset/{id}', 'reset')->name('module.theme.reset');
            // Route::post('/updateorinsert', 'store')->name('module.setting.update');
        });
        // profile management page routes
        Route::prefix('profile')->controller(ProfileManagementController::class)->group(function () {
            Route::get('/myprofile', 'show')->name('instructor.profile');
            Route::post('/cover/upload', 'coverUpload');
            Route::get('/account-settings', 'edit')->name('account.settings');
            Route::post('/edit', 'update')->name('instructor.profile.update');
            Route::get('/change-password', 'passwordUpdate');
            Route::post('/change-password', 'postChangePassword')->name('instructor.password.update');
        });

        // latest certificate route for instructor -> 3rd feedback
        Route::prefix('profile')->controller(CertificateController::class)->group(function () {
            Route::post('/certificate-settings', 'certificateUpdate')->name('certificate.update');
            Route::post('/certificate-generate', 'customCertificate')->name('certificate.generate');
            Route::post('/certificate-delete/{id}', 'certificateDelete')->name('certificate.delete');
        });

        // experience route
        Route::prefix('profile')->controller(ExperienceController::class)->group(function () {
            Route::post('/experience', 'store')->name('instructor.profile.experience');
        });

        // settings page routes
        Route::prefix('settings')->controller(SettingsController::class)->group(function () {
            Route::get('/stripe', 'stripeIndex')->name('instructor.stripe');
            Route::get('/vimeo', 'vimeoIndex')->name('instructor.vimeo');
        });
        // all students profile page routes for instructor
        Route::prefix('students')->controller(StudentController::class)->group(function () {
            Route::get('/', 'index')->name('allStudents');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('student.add');
            Route::post('/cover/upload', 'coverUpload');
            Route::get('/profile/{id}', 'show')->name('studentProfile');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/edit', 'update')->name('updateStudentProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('student.destroy');
        });
    });
});


// SubscriptionPaymentController


Route::middleware(['auth', 'verified'])->prefix('instructor/subscription')->controller(SubscriptionPaymentController::class)->group(function () {
    Route::get('/', 'index')->name('instructor.subscription');
    Route::get('/create-payment/{id}', 'createPayment')->name('instructor.subscription.create.payment');
    Route::post('/payment', 'payment')->name('instructor.subscription.payment');
    Route::get('/cancel', 'cancel')->name('instructor.subscription.cancel');
    Route::get('/status/{id}', 'status')->name('instructor.subscription.status');
});

// SubscriptionController

// Route::prefix('instructor/subscription')->controller(SubscriptionController::class)->group(function () {
Route::middleware(['auth', 'verified'])->prefix('instructor/subscription')->controller(SubscriptionController::class)->group(function () {
    // Route::get('/create/{id}', 'create')->name('instructor.subscription.create');
    Route::get('success', 'success')->name('instructor.subscription.success');
});
// });

// review page routes
// Route::middleware('auth')->prefix('review')->controller(ReviewController::class)->group(function () {
//     Route::get('/', 'index');
// });
