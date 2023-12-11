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
use App\Http\Controllers\DNSSettingController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\CourseCreateStepController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\Instructor\DashboardController;
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




Route::get('/', function ($instructor) {
     return "Hello from teacher instructor $instructor";
    //return redirect()->route('instructor.home', ['subdomain' => 'instructor']);
});
Route::get('/', [HomepageController::class, 'instructorHome'])->name('instructor.home');


Route::get('/courses', [HomepageController::class, 'instructorHome']);
Route::get('/courses/{slug}', [HomepageController::class, 'homeInstructorCourseDetails']);

// Route::get('/{instructor}', [HomepageController::class, 'instructorHome'])->name('instructor.home');



$domain = env('APP_DOMAIN', 'learncosy.com');

Route::domain('{subdomain}.' . $domain)->middleware(['web', 'auth', 'verified', 'role:instructor'])->group(function () {

    Route::group(['middleware' => ['subscription.check']], function () {

        // Dashboard controller
        Route::get('instructor/manage-access', [DashboardController::class, 'manageAccess'])->name('instructor.manage.access');
        Route::post('instructor/manage-access', [DashboardController::class, 'pageAccess'])->name('instructor.manage.pages');


        Route::get('instructor/dashboard', [DashboardController::class, 'analytics'])->name('instructor.dashboard.analytics');
        Route::get('/instructor/analytics', [DashboardController::class, 'index'])->name('instructor.dashboard.index');
        Route::get('/instructor/dashboard', [DashboardController::class, 'analytics'])->name('instructor.dashboard.analytics');


        // Course controller
        Route::get('instructor/courses', [CourseController::class, 'index'])->name('instructor.courses');
        Route::delete('/instructor/courses/{id}/destroy', [CourseController::class, 'destroy'])->name('course.destroy');
        Route::get('/instructor/courses/overview/{slug}', [CourseController::class,'overview'])->name('instructor.course.overview');
        Route::get('/instructor/courses/file-download/{course_id}/{extension}', [CourseController::class,'fileDownload'])->name('instructor.file.download');
        Route::get('/instructor/courses/{id}', [CourseController::class,'show'])->name('course.show')->where('id', '[0-9]+');
        // Route::delete('/{id}/destroy', 'destroy')->name('course.destroy');


        // add course static route
        Route::get('instructor/courses/create', [CourseCreateStepController::class, 'start'])->name('course.create.step-1');
        Route::get('instructor/courses/create/{id}', [CourseCreateStepController::class, 'step3']);
        Route::post('instructor/courses/create/{id}', [CourseCreateStepController::class, 'step3c']);
        Route::post('instructor/courses/created/', [CourseCreateStepController::class, 'startSet'])->name('course.create.start');

        Route::get('instructor/courses/create/{id}/facts', [CourseCreateStepController::class, 'step1'])->name('courses.create.facts');
        Route::post('instructor/courses/create/{id}/facts', [CourseCreateStepController::class, 'step1c'])->name('course.store.step-1');


        Route::post('instructor/courses/create/{id}/factsd', [CourseCreateStepController::class, 'step3cd'])->name('course.module.step.create');
        Route::post('instructor/courses/create/{id}/factsu', [CourseCreateStepController::class, 'step3cu'])->name('course.module.step.update');
        Route::post('instructor/courses/create/{id}/facts-update', [CourseCreateStepController::class, 'step3d'])->name('course.lesson.step.update');



        Route::get('instructor/courses/create/{id}/text/{module_id}/content/{lesson_id}', [CourseCreateStepController::class, 'stepLessonText']);
        Route::post('instructor/courses/create/{lesson_id}/step-lesson-content', [CourseCreateStepController::class, 'stepLessonContent'])->name('course.lesson.text.update');

        Route::get('instructor/courses/create/{id}/audio/{module_id}/content/{lesson_id}', [CourseCreateStepController::class, 'stepLessonAudio']);
        Route::post('instructor/courses/create/{id}/audio/{module_id}/content/{lesson_id}', [CourseCreateStepController::class, 'stepLessonAudioSet'])->name('course.lesson.audio.create');

        Route::get('instructor/courses/create/{id}/video/{module_id}/content/{lesson_id}', [CourseCreateStepController::class, 'stepLessonVideo']);
        Route::post('instructor/courses/create/{id}/video/{module_id}/content/{lesson_id}', [CourseCreateStepController::class, 'stepLessonVideoSet']);

        Route::get('instructor/courses/create/{id}/lesson/{module_id}/institute/{lesson_id}', [CourseCreateStepController::class, 'stepLessonInstitue']);

        Route::get('instructor/courses/create/{id}/objects', [CourseCreateStepController::class, 'courseObjects'])->name('course.create.object');
        Route::post('instructor/courses/create/{id}/objects', [CourseCreateStepController::class, 'courseObjectsSet']);

        Route::post('instructor/courses/create/{courseId}/delete-objects/{dataIndex}', [CourseCreateStepController::class, 'deleteObjective']);

        Route::post('instructor/courses/create/updateObjectives/{id}', [CourseCreateStepController::class, 'updateObjectives'])->name('updateObjectives');

        Route::get('instructor/courses/create/{id}/price', [CourseCreateStepController::class, 'coursePrice']);
        Route::post('instructor/courses/create/{id}/price', [CourseCreateStepController::class, 'coursePriceSet']);

        Route::get('instructor/courses/create/{id}/design', [CourseCreateStepController::class, 'courseDesign']);
        Route::post('instructor/courses/create/{id}/design', [CourseCreateStepController::class, 'courseDesignSet']);

        Route::get('instructor/courses/create/{id}/certificate', [CourseCreateStepController::class, 'courseCertificate']);
        Route::post('instructor/courses/create/{id}/certificate', [CourseCreateStepController::class, 'courseCertificateSet']);

        Route::get('instructor/courses/create/{id}/visibility', [CourseCreateStepController::class, 'visibility']);
        Route::post('instructor/courses/create/{id}/visibility', [CourseCreateStepController::class, 'visibilitySet'])->name('course.create.setvisibility');

        Route::get('instructor/courses/create/{id}/share', [CourseCreateStepController::class, 'courseShare']);




        // Course bundle
        Route::get('instructor/bundle/courses', [CourseBundleController::class,'index']);
        Route::get('instructor/bundle/courses/{slug}/view',  [CourseBundleController::class,'view']);

        Route::get('instructor/bundle/courses/select',  [CourseBundleController::class,'step1']);
        Route::post('instructor/bundle/courses/select/{course_id}',  [CourseBundleController::class,'selectBundle'])->name('select.bundle.course');

        Route::get('instructor/bundle/courses/create',  [CourseBundleController::class,'step2']);
        Route::post('instructor/bundle/courses/create',  [CourseBundleController::class,'createBundle'])->name('create.bundle.course');

        Route::get('instructor/bundle/courses/{slug}/edit',  [CourseBundleController::class, 'edit1'])->name('select.again.bundle.course');
        Route::post('instructor/bundle/courses/{id}/select-update',  [CourseBundleController::class,'update1']);

        Route::get('instructor/bundle/courses/{slug}/edit-final',  [CourseBundleController::class,'edit2']);
        Route::post('instructor/bundle/courses/{slug}/edit-final',  [CourseBundleController::class,'update2'])->name('create.update.bundle.course');

        Route::post('instructor/bundle/courses/remove-new/{course_id}',  [CourseBundleController::class,'removeSelectNew'])->name('reove.select.bundle.course');
        Route::post('instructor/bundle/courses/remove/{course_id}',  [CourseBundleController::class,'removeSelect'])->name('reove.select.bundle.course');

        Route::post('instructor/bundle/courses/delete/{bundle_id}',  [CourseBundleController::class,'delete'])->name('delete.bundle.course');


        // Payment controller
        Route::get('instructor/payments', [HomeController::class,'studentsPayment']);
        Route::get('instructor/payments/{payment_id}', [HomeController::class,'details'])->name('viewPayment');
        Route::get('instructor/payments/generate-pdf/{id}', [HomeController::class,'generatePdf'])->name('generate-pdf');
        Route::get('instructor/payments/invoice-mail/{id}', [HomeController::class,'invoiceMail'])->name('invoice-mail');
        Route::get('instructor/payments/instructor-export/{id}', [HomeController::class,'export'])->name('instructor-export');
        Route::get('instructor/payments/platform-fee', [HomeController::class,'adminPayment']);
        Route::get('instructor/payments/platform-fee/data', [HomeController::class,'adminPaymentData'])->name('instructor.admin-payment');


        // Setting controller
        Route::post('instructor/settings/stripe/request', [SettingsController::class, 'stripeUpdate'])->name('instructor.stripe.update');
        Route::post('instructor/settings//vimeo/request', [SettingsController::class,'vimeoUpdate'])->name('instructor.vimeo.update');


        // ModuleSetting controller
        Route::post('instructor/theme/setting/updateorinsert', [ModuleSettingController::class, 'store'])->name('module.setting.update');
        Route::get('instructor/theme/setting', [ModuleSettingController::class, 'index'])->name('module.setting');
        Route::get('instructor/theme/setting/dns', [ModuleSettingController::class, 'dnsTheme'])->name('module.setting.dns');
        Route::get('instructor/theme/setting/{id}/edit', [ModuleSettingController::class, 'edit'])->name('module.setting.edit');
        Route::post('instructor/theme/setting/reset/{id}', [ModuleSettingController::class, 'reset'])->name('module.theme.reset');

        // Route::post('/updateorinsert', [ModuleSettingController::class, 'store'])->name('module.setting.update');

        // DNS Setting

        // Route::post('instructor/dns/add', [DNSSettingController::class, 'storeDNS'])->name('dns.setting.store');
        Route::post('instructor/dns/verify', [DNSSettingController::class, 'verifyDNS'])->name('dns.setting.verify-view');
        Route::post('instructor/dns/store', [DNSSettingController::class, 'verifyDNSStore'])->name('dns.setting.verify');
        Route::get('instructor/dns/connect', [DNSSettingController::class, 'connectDNS'])->name('dns.setting.connect.dns');
        Route::post('instructor/dns/connect/store', [DNSSettingController::class, 'connectDNSStore'])->name('dns.setting.connect.store');

        // profile management page routes
        Route::post('instructor/profile/edit/{id}', [DashboardController::class,'checkSubdomain'])->name('instructor.subdomain.update');

        // Module controller
        Route::get('instructor/modules', [ModuleController::class, 'index']);
        Route::get('instructor/modules/create', [ModuleController::class,'create']);
        Route::post('instructor/modules/create', [ModuleController::class,'store'])->name('module.store');
        Route::get('instructor/modules/{slug}/edit', [ModuleController::class,'edit'])->name('module.edit');
        Route::post('instructor/modules/{slug}/edit', [ModuleController::class,'update'])->name('module.update');
        Route::delete('instructor/modules/{slug}/destroy', [ModuleController::class,'destroy'])->name('module.destroy');


        // lesson page routes
        Route::get('instructor/lessons', [LessonController::class, 'index']);
        Route::get('instructor/create', [LessonController::class,'create']);

        Route::get('instructor/create/video-upload', [LessonController::class,'videoUpload'])->name('lesson.upload.video');
        Route::get('instructor/upload-vimeo', [LessonController::class,'uploadVimeoPage'])->name('lesson.upload.vimeo');
        Route::post('instructor/upload-vimeo-submit', [LessonController::class,'uploadViewToVimeo'])->name('lesson.vimeo');
        Route::get('instructor/progress', [LessonController::class,'getProgress'])->name('upload.progress');
        Route::get('instructor/upload', function () {
            return view('e-learning/lesson/instructor/upload_vimeo');
        });
        Route::post('instructor/create', [LessonController::class,'store'])->name('lesson.store');
        Route::get('instructor/{slug}/edit', [LessonController::class,'edit'])->name('lesson.edit');
        Route::post('instructor/{slug}/edit', [LessonController::class,'update'])->name('lesson.update');
        Route::delete('instructor/{slug}/destroy', [LessonController::class,'destroy'])->name('lesson.destroy');


        // profile management page routes
        Route::get('instructor/profile/myprofile', [ProfileManagementController::class ,'show'])->name('instructor.profile');
        Route::post('instructor/profile/cover/upload', [ProfileManagementController::class ,'coverUpload']);
        Route::get('instructor/profile/account-settings', [ProfileManagementController::class ,'edit'])->name('account.settings');
        Route::post('instructor/profile/edit', [ProfileManagementController::class ,'update'])->name('instructor.profile.update');
        Route::get('instructor/profile/change-password', [ProfileManagementController::class ,'passwordUpdate']);
        Route::post('instructor/profile/change-password', [ProfileManagementController::class ,'postChangePassword'])->name('instructor.password.update');

        // latest certificate route for instructor -> 3rd feedback
        Route::post('instructor/profile/certificate-settings', [CertificateController::class, 'certificateUpdate'])->name('certificate.update');
        Route::post('instructor/profile/certificate-generate', [CertificateController::class,'customCertificate'])->name('certificate.generate');
        Route::post('instructor/profile/certificate-delete/{id}', [CertificateController::class,'certificateDelete'])->name('certificate.delete');

        // experience route
        Route::post('instructor/profile/experience', [ExperienceController::class, 'store'])->name('instructor.profile.experience');


        // settings page routes
        Route::get('instructor/settings/stripe', [SettingsController::class, 'stripeIndex'])->name('instructor.stripe');
        Route::get('instructor/settings/vimeo', [SettingsController::class,'vimeoIndex'])->name('instructor.vimeo');

        // all students profile page routes for instructor
        Route::get('instructor/students', [StudentController::class, 'index'])->name('allStudents');
        Route::get('instructor/students/create', [StudentController::class, 'create']);
        Route::post('instructor/students/create', [StudentController::class, 'store'])->name('student.add');
        Route::post('instructor/students/cover/upload', [StudentController::class, 'coverUpload']);
        Route::get('instructor/students/profile/{id}', [StudentController::class, 'show'])->name('studentProfile');
        Route::get('instructor/students/{id}/edit', [StudentController::class, 'edit']);
        Route::post('instructor/students/{id}/edit', [StudentController::class, 'update'])->name('updateStudentProfile');
        Route::delete('instructor/students/{id}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');

    });






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
    Route::get('instructor/notifications', [DashboardController::class, 'notifications'])->name('instructor.notify');
    Route::post('instructor/notification/destroy/{id}', [DashboardController::class, 'notifyDestroy'])->name('instructor.notify.destroy');

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

});


// SubscriptionPaymentController

Route::domain('{subdomain}.' . $domain)->group(function () {
    Route::get('instructor/subscription', [SubscriptionPaymentController::class, 'index'])->name('instructor.subscription');
    Route::get('instructor/subscription/create-payment/{id}', [SubscriptionPaymentController::class, 'createPayment'])->name('instructor.subscription.create.payment');
    Route::post('instructor/subscription/payment', [SubscriptionPaymentController::class, 'payment'])->name('instructor.subscription.payment');
    Route::get('instructor/subscription/cancel', [SubscriptionPaymentController::class, 'cancel'])->name('instructor.subscription.cancel');
    Route::get('instructor/subscription/status/{id}', [SubscriptionPaymentController::class, 'status'])->name('instructor.subscription.status');
});


// SubscriptionController

// Route::prefix('instructor/subscription')->controller(SubscriptionController::class)->group(function () {
Route::middleware(['auth', 'verified'])->prefix('instructor/subscription')->controller(SubscriptionController::class)->group(function () {
    // Route::get('/create/{id}', 'create')->name('instructor.subscription.create');
    Route::get('success', 'success')->name('instructor.subscription.success');
});
// });




// Route::match(['get', 'post'], '/logout', function () {
//     Auth::logout();
//     session()->regenerate(); // Regenerate the session ID
//     return redirect('/');
// })->name('logout');
