<?php
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\InstructorModuleSetting;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseBundleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ModuleSettingController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\CourseCreateStepController;
use App\Http\Controllers\Student\CheckoutController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\ProfileManagementController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Student\StudentHomeController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\Instructor\DashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\AdminCourseStepController;
use App\Http\Controllers\Admin\CourseManagementController;
use App\Http\Controllers\Admin\LessonManagementController;
use App\Http\Controllers\Admin\ModuleManagementController;
use App\Http\Controllers\Student\CheckoutBundleController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Admin\StudentManagementController;
use App\Http\Controllers\Admin\BundleCourseManagementController;
use App\Http\Controllers\Admin\AdminSubscriptionPackageController;


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

Route::post('/students/stripe-process-payment', [PaymentController::class, 'processPayment'])->name('process-payment');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    return view('auth.verified');
});

//Start Notification
Route::get('students/notification-details', [NotificationController::class, 'notificationDetails'])->name('notification.details');
Route::post('students/notification-details/destroy/{id}', [NotificationController::class, 'destroy'])->name('notification.destroy');
//End Notification

// custom auth screen route
Route::get('login-as-instructor/{userSessionId}/{userId}/{insId}', [HomepageController::class, 'loginAsinstructor']);
Route::get('login-as-student/{userSessionId}/{userId}/{stuId}', [HomepageController::class, 'loginAsStudent']);
Route::get('ins-login-as-student/{userSessionId}/{userId}/{stuId}', [DashboardController::class, 'loginAsStudent']);

// custom login for student and instructor
Route::get('/auth-login', function () {

    // match user sessionId
    if(isset(request()->singnature)){
        $user = User::where('session_id', request()->singnature)->first();
        if($user){
            Auth::login($user);
            $user->session_id = null;
            $user->save();
            return redirect()->intended($user->user_role.'/dashboard');
        }
    }

    $subdomain = explode('.', request()->getHost())[0];
    $instrcutor = User::where('subdomain', $subdomain)->where('user_role','instructor')->firstOrFail();

    // module settings
    $instrcutorModuleSettings = InstructorModuleSetting::where('instructor_id', $instrcutor->id)->first();

    if ($instrcutorModuleSettings) {
        $loginPageStyle = json_decode($instrcutorModuleSettings->value);
    } else {
        $loginPageStyle = json_decode("{'primary_color':','secondary_color':','lp_layout':','meta_title':','meta_desc':'}");
    }

    if (isset($loginPageStyle) && property_exists($loginPageStyle, 'lp_layout')) {
        if ($loginPageStyle->lp_layout == 'fullwidth') {
            return view('custom-auth/login/login2');
        } elseif ($loginPageStyle->lp_layout == 'default') {
            return view('custom-auth/login/login');
        } elseif ($loginPageStyle->lp_layout == 'leftsidebar') {
            return view('custom-auth/login/login5');
        } elseif ($loginPageStyle->lp_layout == 'rightsidebar') {
            return view('custom-auth/login/login4');
        } else {
            return view('custom-auth/login/login');
        }
    } else {
        return view('auth/login');
    }

})->name('tlogin')->middleware('guest');

// theme settings register page
Route::get('/auth-register', function () {

    $subdomain = explode('.', request()->getHost())[0];
    $instrcutor = User::where('subdomain', $subdomain)->firstOrFail();
    $instrcutorModuleSettings = InstructorModuleSetting::where('instructor_id', $instrcutor->id)->firstOrFail();
    $value = '{"primary_color":"","secondary_color":"","lp_layout":"","meta_title":"","meta_desc":""}';
    $registerPageStyle = json_decode($instrcutorModuleSettings->value ?$instrcutorModuleSettings->value :$value);

    if ($registerPageStyle) {
        if ($registerPageStyle->lp_layout == 'fullwidth') {
            return view('custom-auth/register/register2');
        } elseif ($registerPageStyle->lp_layout == 'default') {
            return view('custom-auth/register/register');
        } elseif ($registerPageStyle->lp_layout == 'leftsidebar') {
            return view('custom-auth/register/register3');
        } elseif ($registerPageStyle->lp_layout == 'rightsidebar') {
            return view('custom-auth/register/register4');
        } else {
            return view('custom-auth/register/register');
        }
    } else {
        return view('custom-auth/register/register');
    }

})->name('tregister')->middleware('guest');

// password reset
Route::get('/auth/password/reset', function () {
    return view('custom-auth/passwords/email');
})->name('auth.password.request')->middleware('guest');

// after registration redirect user
Route::get('/home', function (Request $request) {
    // user role
    $role = Auth::user()->user_role;

    // instructor rediretion
    if ($role == 'instructor' && isset(Auth::user()->email_verified_at)) {
        return redirect('instructor/dashboard');

    }elseif($role == 'instructor' && !isset(Auth::user()->email_verified_at)){
         return redirect('instructor/profile/step-1/complete');
    }

    // admin rediretion
    if ($role == 'admin') {
        return redirect('/admin/dashboard');
    }

    // students rediretion
    if ($role == 'student') {
        return redirect('/students/dashboard');
    }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');

})->name('home')->middleware('auth');

// auth route
Auth::routes(['verify' => true]);
Route::get('students/lessons/{id}', function ($id) {

    $lesson = App\Models\Lesson::findorfail($id);
    return response()->json($lesson);
});

// One to one chat system
Route::middleware('auth')->prefix('messages')->controller(MessageController::class)->group(function () {
    Route::get('/', 'index')->name('message');
    Route::get('/chat', 'getChatMessage')->name('messages.chat');
    Route::post('/chat', 'sendChatMessage')->name('messages.chat');
    Route::get('/group/chat', 'getGroupChatMessage')->name('messages.group.chat');
    Route::post('/group/chat', 'sendGroupMessage')->name('messages.group.chat');
    Route::get('/search-user', 'searchChatUser')->name('messages.search');
    Route::get('/chat/download/{filename}', 'downloadChatFile')->name('messages.file.download');
    Route::get('/delete/single-chat-history', 'deleteSingleChatHistory')->name('messages.delete.singlechat');
    // // Route::get('/', 'index')->name('message');
    // Route::get('/students', 'index2')->name('message.students')->middleware('page.access');
    // Route::post('/', 'sendMessage')->name('message-send');
    // Route::get('/send/{id}', 'send')->name('get.message');
    // Route::get('/chat_room/{id}', 'getChatRoomMessages')->name('get.chat_room.message');
    // Route::post('/chat_room/{chat_room}', 'postChatRoomMessages')->name('post.chat_room.message');
    // Route::post('/send/{course_id}', 'submitMessage')->name('post.message');
});

// Group message
Route::middleware('auth')->prefix('messages')->controller(GroupController::class)->group(function () {
    Route::post('/create-group', 'createGroup')->name('messages.group');
    Route::get('/load/suggested/people', 'loadSuggestedPeople')->name('messages.suggested.people');
});
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
        $package = App\Models\SubscriptionPackage::findorfail($id);
        return view('latest-auth.payment',compact('package'));
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

            Route::get('{id}', 'step3');
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

/* ========================================================== */
/* ===================== Student Routes ===================== */
/* ========================================================== */

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


/* ======================================================== */
/* ===================== Admin Routes ===================== */
/* ======================================================== */
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
        Route::prefix('students')->controller(StudentManagementController::class)->group(function () {
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
            Route::post('{lesson_id}/step-lesson-content', 'stepLessonContent')->name('admin.course.lesson.text.update');

            Route::get('{id}/audio/{module_id}/content/{lesson_id}', 'stepLessonAudio');
            Route::post('{id}/audio/{module_id}/content/{lesson_id}', 'stepLessonAudioSet')->name('admin.course.lesson.audio.create');

            Route::get('{id}/video/{module_id}/content/{lesson_id}', 'stepLessonVideo');
            Route::post('{id}/video/{module_id}/content/{lesson_id}', 'stepLessonVideoSet');

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
            Route::get('/platform-fee', 'adminPayment');
            Route::get('/platform-fee/{stripe_plan}', 'details')->name('admin.payment.details');
            Route::get('/export/{id}', 'export')->name('export');
            Route::get('/view/{id}', 'view')->name('view');
            Route::get('/pdf-generate/{id}', 'generatePdf')->name('pdf-generate');
            Route::get('/mail-invoice/{id}', 'mailInvoice')->name('mail-invoice');
        });
    });
});
 
// Route::get('/generate-pdf/{id}',[GeneratepdfController::class, 'generatePdf'])->name('generate-pdf');

Route::get('/logout', function () {
    Auth::logout();
    session()->flush();
    return redirect('/');
});

/**
 * if page not found then redirect to 404 page
 */
Route::fallback(function () {
    return redirect()->route('tlogin');
});



