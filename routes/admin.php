<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminCourseStepController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CourseManagementController;
use App\Http\Controllers\Admin\LessonManagementController;
use App\Http\Controllers\Admin\ModuleManagementController;
use App\Http\Controllers\Admin\StudentManagementController;
use App\Http\Controllers\Admin\BundleCourseManagementController;
use App\Http\Controllers\Admin\AdminSubscriptionPackageController;



Route::middleware('auth')->prefix('admin')->controller(AdminHomeController::class)->group(function () {
    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/notifications', 'notification')->name('admin.notification');
        Route::get('/top-perform/courses', 'perform');

        // all admin profile manage routes for admin
        Route::prefix('alladmin')->controller(AdminManagementController::class)->group(function () {
            Route::get('/', 'index')->name('allAdmin');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('allAdmin.add');
            Route::post('/cover/upload', 'coverUpload');
            Route::get('/profile/{id}', 'show')->name('allAdmin.profile');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/edit', 'update')->name('updateAllAdminProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('allAdmin.destroy');
        });
        // admin instructor routes
        Route::prefix('instructor')->controller(InstructorController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('instructor.add');
            Route::post('/cover/upload', 'coverUpload');
            Route::get('/profile/{id}', 'show')->name('instructorProfile');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/edit', 'update')->name('updateInstructorProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('instructor.destroy');
        });
        // all students manage routes for admin
        Route::prefix('student')->controller(StudentManagementController::class)->group(function () {
            Route::get('/', 'index')->name('admin.allStudents');
            Route::get('/create', 'create');
            Route::post('/create', 'store')->name('admin.student.add');
            Route::post('/cover/upload', 'coverUpload');
            Route::get('/profile/{id}', 'show')->name('admin.studentProfile');
            Route::get('/{id}/edit', 'edit');
            Route::post('/{id}/edit', 'update')->name('admin.updateStudentProfile');
            Route::delete('/{id}/destroy', 'destroy')->name('admin.student.destroy');
        });
        // course page routes for admin
        Route::prefix('courses')->controller(CourseManagementController::class)->group(function () {
            Route::get('/', 'index')->name('admin.courses');
            // Route::get('/file-download/{course_id}/{extension}', 'filePreview')->name('admin.file.download');
            Route::get('/{slug}/show', 'show')->name('admin.course.show');
            Route::get('/overview/{slug}', 'overview')->name('admin.course.overview');
            Route::get('courses-log', 'storeCourseLog')->name('admin.log.courses');
            Route::delete('/{slug}/destroy', 'destroy')->name('admin.course.destroy');
        });

        // admin course edit
        Route::prefix('courses/create')->controller(AdminCourseStepController::class)->group(function () {

            Route::get('/{id}/facts', 'step1');
            Route::post('/{id}/facts', 'step1c')->name('admin.course.store.step-1');

            Route::get('{id}', 'step3');
            Route::post('{id}', 'step3c');

            Route::post('{id}/factsd', 'step3cd')->name('admin.course.module.step.create');
            Route::post('{id}/factsu', 'step3cu')->name('admin.course.module.step.update');
            Route::post('{id}/facts-update', 'step3d')->name('admin.course.lesson.step.update');

            Route::get('{id}/text/{module_id}/content/{lesson_id}', 'stepLessonText');
            Route::post('{id}/step-lesson-content', 'stepLessonContent')->name('admin.course.lesson.text.update');

            Route::get('{id}/audio/{module_id}/content/{lesson_id}', 'stepLessonAudio');
            Route::post('{id}/audio/{module_id}/content/{lesson_id}', 'stepLessonAudioSet')->name('admin.course.lesson.audio.create');
            Route::get('{id}/audio/{module_id}/content/{lesson_id}/remove', 'stepLessonAudioRemove');

            Route::get('file/remove/{lesson_id}', 'stepLessonFileRemove');

            Route::get('{id}/video/{module_id}/content/{lesson_id}', 'stepLessonVideo');
            Route::post('{id}/video/{module_id}/content/{lesson_id}', 'stepLessonVideoSet');
            Route::get('{id}/video/{module_id}/content/{lesson_id}/remove', 'stepLessonVideoRemove');

            Route::get('{id}/lesson/{module_id}/institute/{lesson_id}', 'stepLessonInstitue');

            Route::get('{id}/objects', 'courseObjects');

            Route::post('{id}/objects', 'courseObjectsSet');
            Route::post('/{courseId}/delete-objects/{dataIndex}', 'deleteObjective');

            Route::post('/updateObjectives/{id}', 'updateObjectives')->name('admin.updateObjectives');

            Route::get('{id}/price', 'coursePrice');
            Route::post('{id}/price', 'coursePriceSet');

            Route::get('{id}/design', 'courseDesign');
            Route::post('{id}/design', 'courseDesignSet');

            Route::get('{id}/certificate', 'courseCertificate');
            Route::post('{id}/certificate', 'courseCertificateSet');

            Route::get('{id}/visibility', 'visibility');
            Route::post('{id}/visibility', 'visibilitySet');

            Route::get('{id}/share', 'courseShare');


            // Module Resorting
            Route::post('module/sortable','moduleResorting');
            Route::post('lesson/sortable','moduleLessonResorting');


        });

        // Subscription paege modify routes for admin
        Route::prefix('manage/subscriptionpackage')->controller(AdminSubscriptionPackageController::class)->group(function () {
            Route::get('/', 'index')->name('admin.subscription');
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
            Route::get('/{slug}/view', 'view')->name('admin.course.bundle.show');

            Route::get('{slug}/edit', 'edit1')->name('admin.select.again.bundle.course');
            Route::post('{id}/select-update', 'update1');

            Route::get('{slug}/edit-final', 'edit2');
            Route::post('{slug}/edit-final', 'update2')->name('admin.create.update.bundle.course');

            Route::post('/remove-new/{course_id}', 'removeSelectNew')->name('admin.reove.select.bundle.course');
            Route::post('/remove/{course_id}', 'removeSelect')->name('admin.reove.select.bundle.course');

            Route::delete('/{id}/delete', 'delete')->name('admin.course.bundle.destroy');
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
            Route::post('/cover/upload', 'coverUpload')->name('account.cover.upload');
            Route::post('/edit', 'update')->name('admin.profile.update');
            Route::get('/change-password', 'passwordUpdate');
            Route::post('/change-password', 'postChangePassword')->name('admin.password.update');
        });

        // admin payment routes
        Route::prefix('payments')->controller(AdminPaymentController::class)->group(function () {
            Route::get('/platform-fee', 'adminPayment');
            Route::get('/platform-fee/{stripe_plan}', 'details')->name('admin.payment.details');
            Route::get('/admin-export/{stripe_plan}', 'export')->name('admin-export');
            Route::get('/generate-pdf/{stripe_plan}', 'generatePdf')->name('admin.generate-pdf');
            Route::get('/invoice-mail/{stripe_plan}', 'invoiceMail')->name('admin.invoice-mail');

            // ins
        });
    });
});
