<?php

namespace App\Http\Controllers\Student;
use Auth;
use File;
use ZipArchive;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Checkout;
use App\Models\CourseLog;
use Carbon\CarbonInterval;
use App\Models\Certificate;
use App\Models\course_like;
use App\Models\BundleCourse;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use App\Models\CourseActivity;
use RecursiveIteratorIterator;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class StudentHomeController extends Controller
{
    // dashboard
    public function dashboard(){

        $user = User::where('id', Auth::id())->first();
        $user->session_id = null;
        $user->save();

        if (isset($_COOKIE['userIdentifier'])) {
            $userIdentifier = $_COOKIE['userIdentifier'];
        } else {
            $userIdentifier = '';
        }


        Cart::where('user_identifier', $userIdentifier)
        ->update(['user_id' => Auth::id()]);

        $enrolments = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(12);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        $likeCourses = course_like::where('user_id', Auth::user()->id)->with('course')->get();
        $totalTimeSpend = CourseActivity::where('user_id', Auth::user()->id)->where('is_completed',1)->sum('duration');

        $totalHours = floor($totalTimeSpend / 3600);
        $totalMinutes = floor(($totalTimeSpend % 3600) / 60);

        $timeSpentData = CourseActivity::select(
            'user_id',
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('SUM(duration) as time_spent')
        )
        ->groupBy('user_id', 'month')
        ->orderBy('user_id', 'asc')
        ->orderBy('created_at', 'asc')
        ->get();

        $currentMonthData = CourseActivity::selectRaw('SUM(duration) as total_duration')
        ->whereMonth('created_at', now()->month)
        ->first();

        $previousMonthData = CourseActivity::selectRaw('SUM(duration) as total_duration')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->first();

        if ($currentMonthData && $previousMonthData) {
            $currentMonthDuration = $currentMonthData->total_duration;
            $previousMonthDuration = $previousMonthData->total_duration;

            if ($previousMonthDuration != 0) {
                $percentageChange = (($currentMonthDuration - $previousMonthDuration) / $previousMonthDuration) * 100;
            } else {
                $percentageChange = 0;
            }
        } else {
            $percentageChange = 0;
        }

        //  count course statics
        $notStartedCount = 0;
        $inProgressCount = 0;
        $completedCount = 0;

        if ($enrolments) {
            foreach ($enrolments as $enrolment) {
                if ($enrolment->course) {
                    $allCourses = StudentActitviesProgress(auth()->user()->id, $enrolment->course->id);

                    if ($allCourses == 0) {
                        $notStartedCount++;
                    } elseif ($allCourses > 0 && $allCourses < 99) {
                        $inProgressCount++;
                    } elseif ($allCourses == 100) {
                        $completedCount++;
                    }
                }
            }

        }

        // Avr hr
        // $sum_of_duration = CourseActivity::selectRaw('SUM(duration) as total_duration')
        //                                     ->where(['user_id' => auth()->user()->id, 'is_completed' => 1])
        //                                     ->get();


        $sum_of_duration = CourseActivity::where('user_id', Auth::user()->id)->where('is_completed',1)->avg('duration');

        $total_hr = 0;
        $total_min = 0;
        $total_hr = floor($sum_of_duration / 3600);
        $total_min = floor(($sum_of_duration % 3600) / 60);
        // Enrolled
         $total_enrolled = DB::table('checkouts')
                    ->where('user_id', auth()->user()->id)
                    ->selectRaw('COUNT(DISTINCT course_id) as enrolled')
                    ->first();
        $enrolled = $total_enrolled->enrolled;

        // certificate count

        $myCoursesList = Checkout::where('user_id', Auth()->id())->get();
        $certificateCourses = Course::whereIn('id',$myCoursesList->pluck('course_id'))->orderby('id', 'desc')->get();

        return view('e-learning/course/students/dashboard', compact('enrolments','total_hr','total_min','enrolled','likeCourses','totalTimeSpend','totalHours','totalMinutes','timeSpentData','percentageChange','notStartedCount','inProgressCount','completedCount','certificateCourses'));
    }

    // dashboard
    public function enrolled(){

        $queryParams = request()->except('page');
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $enrolments = Checkout::with('course.reviews')->where('checkouts.user_id', Auth::user()->id);
        $cartCount = Cart::where('user_id', auth()->id())->count();

        if (!empty($title)) {
            $enrolments->whereHas('course', function ($query) use ($title) {
                $query->where('title', 'LIKE', '%' . $title . '%');
            });
        }

        if ($status) {
            if ($status == 'oldest') {
                $enrolments->orderBy('id', 'asc');
            } elseif ($status == 'best_rated') {
                $enrolments->select('checkouts.*')
                    ->selectRaw('SUM(course_reviews.star) as total_star')
                    ->leftJoin('course_reviews', function ($join) {
                        $join->on('course_reviews.course_id', '=', DB::raw("FIND_IN_SET(course_reviews.course_id, checkouts.course_id)"));
                    })
                    ->groupBy('checkouts.id')
                    ->orderBy('total_star', 'desc');
            } elseif ($status == 'most_purchased') {

                $enrolments->select('checkouts.*')
                ->selectRaw('COUNT(checkouts.course_id) as course_count')
                ->groupBy('checkouts.course_id')
                ->orderBy('course_count', 'desc');

            } elseif ($status == 'newest') {
                $enrolments->orderBy('id', 'desc');
            }
        } else {
            $enrolments->orderBy('id', 'desc');
        }

        $enrolments = $enrolments->paginate(12)->appends($queryParams);

        return view('e-learning/course/students/enrolled',compact('enrolments','cartCount'));
    }

    // all course list
    public function index(){

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $courses = Course::orderBy('id','desc');
        if(!empty($title)){
            $titles = explode( ' ', $title);
            $courses->where('title','like','%'.trim($titles[0]).'%');
            if(isset($titles[1])){
                $courses->where('title','like','%'.trim($titles[1]).'%');
            }
        }
        $courses = $courses->paginate(12);

        return view('e-learning/course/students/home',compact('courses'));
    }

    // catalog course list
    public function catalog(Request $request){
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];
        $instructor = User::where('subdomain', $subdomain)->where('user_role','instructor')->first();

        if (!$instructor) {
            return redirect('students/dashboard')->with('error','No Instructor Found!');
        }

        $courses = Course::where('user_id', $instructor->id)->where('status','published')->with('user','reviews');

        $bundleCourse = BundleCourse::orderBy('id','desc')->get();
        $mainCategories = $courses->pluck('categories');

        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        if(!empty($title)){
            $titles = explode( ' ', $title);
            $courses->where('title','like','%'.trim($titles[0]).'%');
            $bundleCourse->where('title','like','%'.trim($titles[0]).'%');
            if(isset($titles[1])){
                $courses->where('title','like','%'.trim($titles[1]).'%');
                $bundleCourse->where('title','like','%'.trim($titles[1]).'%');
            }
        }

        if ($status == 'best_rated') {
            $courses = Course::leftJoin('course_reviews', 'courses.id', '=', 'course_reviews.course_id')
                ->select('courses.*', \DB::raw('COALESCE(AVG(course_reviews.star), 0) as avg_star'))
                ->groupBy('courses.id')
                ->where('courses.user_id', $instructor->id)
                ->where('status','published')
                ->orderBy('avg_star', 'desc');

        }

        if ($status == 'most_purchased') {
            $courses = Course::leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
                ->select('courses.*')
                ->groupBy('courses.id')
                ->where('courses.user_id', $instructor->id)
                ->where('courses.status','published')
                ->orderBy(\DB::raw('COUNT(checkouts.course_id)'), 'desc');

        }

        if ($status) {
            if ($status == 'oldest') {
                $courses->orderBy('id', 'asc');
            }

            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc');
        }

        if(!empty($cat)){
            $cats = explode( ' ', $cat);
            $courses->where('categories','like','%'.trim($cats[0]).'%');
            if(isset($cats[1])){
                $courses->where('cat','like','%'.trim($cats[1]).'%');
            }
        }
        $unique_array = [];
        foreach($mainCategories as $category){
            $cats = explode(",", $category);
            foreach($cats as $cat){
                $unique_array[] = strtolower($cat);
            }
        }
        $categories = array_unique($unique_array);
        $courses = $courses->paginate(12);

        $cartCourses = Cart::where('user_id', auth()->id())->get();

        return view('e-learning/course/students/catalog',compact('cartCourses','courses','categories', 'bundleCourse'));
    }

    // account Management
    public function accountManagement(){

        $userId = Auth()->user()->id;
        $user = User::find($userId);
        $checkout = Checkout::where('user_id', $userId)->with('course')->get();
        return view('settings/students/account-management',compact('user', 'checkout'));
    }

    // course show
    public function show($domain,$slug)
    {
        $course = Course::where('slug', $slug)->with('modules.lessons','user')->where('status','published')->first();
        if (!$course) {
            return redirect()->back()->with('error','No course found!');
        }

        $lesson_files = Lesson::where('course_id',$course->id)
        ->where('status','published')
        ->select('lesson_file as file')->get();
        $group_files = [];

        foreach($lesson_files as $lesson_file){
            if(!empty($lesson_file->file)){
                $file_name = $lesson_file->file;
                $file_arr = explode('.', $lesson_file->file);
                $extention = $file_arr[1];
                if (!in_array($extention, $group_files)) {
                    $group_files[] = $extention;
                }
            }
        }

        //end group file
        if ($course && $course->categories) {
            $categoryArray = explode(',', $course->categories);
            $relatedCourses = Course::where('instructor_id', $course->instructor_id)
            ->where('status','published')
            ->where('id', '!=', $course->id)
            ->where(function ($query) use ($categoryArray) {
                foreach ($categoryArray as $category) {
                    $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                }
            })
            ->take(3)
            ->get();
        }

        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();
        $course_like = course_like::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
        $liked = '';
        if ($course_like ) {
            $liked = 'active';
        }

        $totalModules = $course->modules->where('status', 'published')->count();

        // $totalLessons = $course->modules->sum(function ($module) {
        //     return $module->lessons->filter(function ($lesson) {
        //         return $lesson->status == 'published';
        //     })->count();
        // });

        $totalLessons = $course->modules->filter(function ($module) {
            return $module->status === 'published';
        })->map(function ($module) {
            return $module->lessons()->where('status', 'published')->count();
        })->sum();


        // last playing video
         $courseLog = CourseLog::where('course_id', $course->id)->where('user_id',auth()->user()->id)->first();
         $defaultVideoId = '899148078';
         $currentLesson = NULL;
        $playUrl = NULL;


         if ($courseLog) {
             $currentLesson = Lesson::find($courseLog->lesson_id);

            if ($currentLesson && $currentLesson->type == 'video') {
                 $playUrl = $currentLesson->video_link;
            }elseif($currentLesson && $currentLesson->type == 'audio'){
                $playUrl = $currentLesson->audio;
            }elseif($currentLesson && $currentLesson->type == 'text'){
                $playUrl = $currentLesson->text;
            }
         }


        if ($course) {
            return view('e-learning/course/students/show', compact('course','group_files','course_reviews','liked','course_like','totalLessons','totalModules','relatedCourses','defaultVideoId','currentLesson','playUrl','playUrl','playUrl'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }
    }

    public function fileDownload($domain,$course_id,$file_extension){

          $lesson_files = Lesson::where('course_id',$course_id)->select('lesson_file as file')->get();
            foreach($lesson_files as $lesson_file){
                if(!empty($lesson_file->file)){
                    $file_name = $lesson_file->file;
                    $file_arr = explode('.', $file_name);
                    $extension = $file_arr['1'];
                    if($file_extension == $extension){
                        $files[] = public_path($file_name);
                }
                }
            }
        $zip = new ZipArchive;
        $zipFileName = $file_extension.'_'.time().'.zip';
        $is_have_file = '';
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {

                if(file_exists($file)){
                    $zip->addFile($file, basename($file));
                }else{
                   $is_have_file = 'There are no files in your storage!!!!';
                   break;
                }
            }
            if(!empty($is_have_file)){
                return redirect('students/courses')->with('error', $is_have_file);
            }
            $zip->close();

            // Set appropriate headers for the download
            header('Content-Type: application/zip');
            header("Content-Disposition: attachment; filename=" . $zipFileName);
            header('Content-Length: ' . filesize($zipFileName));
            header("Pragma: no-cache");
            header("Expires: 0");
            readfile($zipFileName);

            // Delete the zip file after download
            unlink($zipFileName);
            exit;
        } else {
            // Handle the case when the zip file could not be created
            echo 'Failed to create the zip file.';
        }
    }

    public function cousreDownloadPDF($subdomain,$course_id){
        $lesson_files = Lesson::where('course_id',$course_id)->select('lesson_file as file')->get();
        foreach($lesson_files as $lesson_file){
            $file_name = $lesson_file->file;
            $file_arr = explode('.', $lesson_file->file);
            $extention = $file_arr[1];
            if($extention == 'pdf'){
                $pdfFiles[] = $file_name;
           }
        }

        $zipFileName = 'PDF_'.time().'.zip';
        $zip = new ZipArchive;

        if ($zip->open(public_path('uploads/lessons/files/'.$zipFileName), ZipArchive::CREATE) === TRUE) {
            foreach ($pdfFiles as $file) {
                if (file_exists(public_path('uploads/lessons/files/'.$file))) {
                    $zip->addFile(public_path('uploads/lessons/files/'.$file), basename($file));
                }
            }
            $zip->close();
            return response()->download(public_path('uploads/lessons/files/'.$zipFileName))->deleteFileAfterSend(true);
        } else {
            // handle error here
        }
    }

    public function certificateDownload($domain, $slug)
    {
            $course = Course::where('slug', $slug)
            ->with('certificate')
            ->first();

            if (!$course) {
                return redirect()->back()->with('error','There is no certificate found for this Course');
            }

            $courseDate = CourseActivity::where('user_id', Auth::user()->id)
            ->where('is_completed', 1)
            ->orderBy('updated_at', 'desc')
            ->first();

            if (!$courseDate) {
                return redirect()->back()->with('error','There is no certificate found for this Course');
            }

            $certStyle = Certificate::where('instructor_id',$course->user_id)->where('course_id',$course->id)->first();

            if (!$certStyle) {
                $certificate_path = 'certificates/download/certificate1';
            }

            if ($certStyle) {
                if ($certStyle->style == 3) {
                    $certificate_path = 'certificates/download/certificate1';

                }elseif ($certStyle->style == 2) {
                    $certificate_path = 'certificates/download/certificate2';

                }elseif ($certStyle->style == 1) {
                    $certificate_path = 'certificates/download/certificate3';
                }else{
                    $certificate_path = 'certificates/download/certificate1';
                }
            }

            $signature = $certStyle ? $certStyle->signature : '';
            $logo = $certStyle ? $certStyle->logo : '';

            $pdf = PDF::loadView($certificate_path, ['course' => $course, 'courseDate' => $courseDate->updated_at , 'signature' => $signature, 'logo' => $logo]);

            return $pdf->download($course->title.'-certificate.pdf');

    }

    public function certificateView($subdomain,$slug)
    {
            $course = Course::where('slug', $slug)
            ->with('certificate')
            ->first();

            if (!$course) {
                return redirect()->back()->with('error','There is no certificate found for this Course');
            }

            $courseDate = CourseActivity::where('user_id', Auth::user()->id)
            ->where('is_completed', 1)
            ->orderBy('updated_at', 'desc')
            ->first();

            if (!$courseDate) {
                return redirect()->back()->with('error','There is no certificate found for this Course');
            }

            $certStyle = Certificate::where('instructor_id',$course->user_id)->first();

            if (!$certStyle) {
                $certificate_show_path = 'certificates/show/certificate1';
            }

            if ($certStyle) {
                if ($certStyle->style == 3) {
                    $certificate_show_path = 'certificates/show/certificate1';

                }elseif ($certStyle->style == 2) {
                    $certificate_show_path = 'certificates/show/certificate2';

                }elseif ($certStyle->style == 1) {
                    $certificate_show_path = 'certificates/show/certificate3';
                }else{
                    $certificate_show_path = 'certificates/show/certificate1';
                }
            }

            $signature = '';

            if (!empty($certStyle->signature)) {
                $signature = $certStyle->signature;
            }else{
                $signature = 'latest/assets/images/certificate/one/signature.png';
            }
            return view($certificate_show_path, ['course' => $course, 'courseDate' => $courseDate->updated_at , 'signature' => $signature]);

    }

    // course overview
    public function overview($domain,$slug)
    {
        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
        $promo_video_link = '';
        if($course->promo_video != ''){
            $ytarray=explode("/", $course->promo_video);
            $ytendstring=end($ytarray);
            $ytendarray=explode("?v=", $ytendstring);
            $ytendstring=end($ytendarray);
            $ytendarray=explode("&", $ytendstring);
            $ytcode=$ytendarray[0];
            $promo_video_link = $ytcode;
        }

        $cartCourses = Cart::where('user_id', auth()->id())->get();

        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();
        $course_like = course_like::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();

        $courseEnrolledNumber = Checkout::where('course_id',$course->id)->count();

        $liked = '';
        if ($course_like ) {
            $liked = 'active';
        }

        $related_course = [];
        if ($course) {
            if($course->categories){
                $categoryArray = explode(',', $course->categories);

                $related_course = Course::where('instructor_id', $course->instructor_id)
                ->where('status','published')
                ->where('id', '!=', $course->id)
                ->where(function ($query) use ($categoryArray) {
                    foreach ($categoryArray as $category) {
                        $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                    }
                })
                ->take(4)
                ->get();
            }

            return view('e-learning/course/students/overview', compact('course','promo_video_link','course_reviews','related_course','cartCourses','liked','courseEnrolledNumber'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }
    }

      // my course details
    public function courseDetails($domain, $slug){

        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
        $courseEnrolledNumber = Checkout::where('course_id',$course->id)->count();

        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();
        $totalReviews = CourseReview::where('course_id', $course->id)->with('user')->count();
        $completes = CourseActivity::where(['course_id'=> $course->id,'user_id'=> Auth::user()->id, "is_completed" => 1])->pluck('lesson_id')->toArray();
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                $completed = in_array($lesson->id, $completes);
                $lesson->completed =  (int)$completed;
            }
        }



        if ($course) {
            return view('e-learning/course/students/myCourse',compact('course','totalReviews','courseEnrolledNumber','course_reviews'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }

    }

    public function storeCourseLog(Request $request){

        $courseId = (int)$request->input('courseId');
        $lessonId = (int)$request->input('lessonId');
        $moduleId = (int)$request->input('moduleId');
        $userId = auth()->user()->id;

        $existingCourse = Course::find($courseId);
        $courseLog = CourseLog::where('course_id', $courseId)->where('user_id',$userId)->first();
        $currentPlayingLesson = Lesson::find($lessonId);

        if(!$courseLog){
            $courseLogInfo = new CourseLog([
                'course_id' => $courseId,
                'instructor_id' => $existingCourse->user_id,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
            $courseLogInfo->save();
        }else{
            $courseLog->course_id = $courseId;
            $courseLog->instructor_id = $existingCourse->user_id;
            $courseLog->module_id = $moduleId;
            $courseLog->lesson_id = $lessonId;
            $courseLog->update();
        }

        return response()->json(['currentPlayingLesson' => $currentPlayingLesson]);

    }

    /**
     * Student activties lesson complete
     */
    public function storeActivities(Request $request)
    {

        // dd( $request->storeCourseLog);

        // // Update or insert to course activities
        $courseId = (int)$request->input('courseId');
        $lessonId = (int)$request->input('lessonId');
        $moduleId = (int)$request->input('moduleId');
        $duration = (int)$request->input('duration');

        $course = Course::find($courseId);

        $userId = Auth()->user()->id;

        $courseActivities = CourseActivity::updateOrCreate(
            ['lesson_id' => $lessonId, 'module_id' => $moduleId],
            [
                'course_id' => $courseId,
                'instructor_id' => $course->instructor_id,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
                'is_completed' => true,
                'duration' => $duration
            ]
        );

        return response()->json($courseActivities);
    }

    public function activitiesList()
    {
        $myCoursesList = Checkout::where('user_id', Auth()->id())->get();

        $courseActivities = Course::whereIn('id',$myCoursesList->pluck('course_id'))->orderby('id', 'desc')->paginate(12);
        return view('e-learning/course/students/activity', compact('courseActivities'));
    }

    public function review(Request $request, $domain, $slug){
        $userId = Auth()->user()->id;
        $lessons = Lesson::orderby('id', 'desc')->paginate(10);
        $modules = Module::orderby('id', 'desc')->paginate(10);
        $course = Course::where('slug', $slug)->with('user')->first();
        $course_reviews = CourseReview::where('course_id', $course->id)->where('user_id',$userId)->first();
        if($course_reviews){
            $course_reviews->comment = $request->comment;
            $course_reviews->star = $request->star;
            $course_reviews->save();
        }else{
            $review = new CourseReview([
                'user_id'   => $userId,
                'course_id' => $course->id,
                'instructor_id' => $course->instructor_id,
                'star'      => $request->star,
                'comment'   => $request->comment,
            ]);
            $review->save();

            // set notification for instructor
                $notify = new Notification([
                    'user_id'   => Auth::user()->id,
                    'instructor_id' => $course->instructor_id,
                    'course_id' => $course->id,
                    'type'      => 'instructor',
                    'message'   => "review",
                    'status'   => 'unseen',
                ]);
                $notify->save();
        }

        return redirect()->route('students.show.courses', ['slug' => $slug, 'subdomain' => config('app.subdomain') ] )->with('message', 'comment submitted successfully!');
    }

    public function certificate()
    {
        $myCoursesList = Checkout::where('user_id', Auth()->id())->get();
        $certificateCourses = Course::whereIn('id',$myCoursesList->pluck('course_id'))->orderby('id', 'desc')->paginate(12);
        return view('e-learning/course/students/certifiate',compact('certificateCourses'));
    }

    public function message()
    {
        return view('e-learning/course/students/message-2');
    }

    public function courseLike($subdomain,$course_id, $ins_id)
    {

        $course_liked = course_like::where('course_id', $course_id)->where('instructor_id', $ins_id)->first();

        if ($course_liked) {
             $course_liked->delete();
             $status = 'unliked';
        }else{
            $course_like = new course_like([
                'course_id' => $course_id,
                'instructor_id' => $ins_id,
                'user_id' => Auth::user()->id,
                'status' => 1,
            ]);
            $course_like->save();

            $status = 'liked';
        }

        return response()->json(['message' => $status]);
    }

    public function courseUnLike($subdomain,$course_id, $ins_id)
    {

        $course_liked = course_like::where('course_id', $course_id)->where('instructor_id', $ins_id)->first();

        if ($course_liked) {
             $course_liked->delete();
             $status = 'unliked';
        }

        return redirect()->back()->with('success', 'Course Unlike Successfully Done!');
    }

    public function backToPavilion($domain, $userId){
        $user = User::find($userId);

        $domain = env('APP_DOMAIN', 'learncosy.com');

        if( $user->user_role == 'instructor' ){
            Auth::logout();
            Auth::login($user);
            $defaultUrl = '//' . $user->subdomain . '.' . $domain . '/instructor/dashboard';
        }else if($user->user_role == 'admin'){
            Auth::logout();
            // Auth::login($user);
            $defaultUrl = '//' . $user->subdomain . '.' . $domain . '/admin/dashboard';
        }

        return redirect()->to($defaultUrl);
    }
}
