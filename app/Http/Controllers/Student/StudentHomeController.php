<?php

namespace App\Http\Controllers\Student;
use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\course_like;
use App\Models\Module;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\CourseLog;
use App\Models\BundleCourse;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use App\Models\CourseActivity;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\PDF;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\DB;

class StudentHomeController extends Controller
{
    // dashboard
    public function dashboard(){
        $enrolments = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(12);
        $cartCount = Cart::where('user_id', auth()->id())->count();
        $likeCourses = course_like::where('user_id', Auth::user()->id)->with('course')->get();
        $totalTimeSpend = CourseActivity::where('user_id', Auth::user()->id)->where('is_completed',1)->sum('duration');

        // dummy data start - need to remove later
        $totalTimeSpend = 6000;
         // dummy data end - need to remove later

        $totalHours = floor($totalTimeSpend / 3600);
        $totalMinutes = floor(($totalTimeSpend % 3600) / 60);
 

        $timeSpentData = CourseActivity::select(
            DB::raw('DATE_FORMAT(created_at, "%b") as month'),
            DB::raw('SUM(duration) as time_spent')
        )
        ->groupBy('month')
        ->orderBy('created_at', 'asc')
        ->get();

        // dummy data start - need to remove later 
        $timeSpentData = [];

        $timeSpentData[] = [
            "month" => "Jan",
            "time_spent" => "20"
        ];
        $timeSpentData[] = [
            "month" => "Feb",
            "time_spent" => "50"
        ];
        $timeSpentData[] = [
            "month" => "Mar",
            "time_spent" => "70"
        ]; 
        $timeSpentData[] = [
            "month" => "Apr",
            "time_spent" => "20"
        ];
        $timeSpentData[] = [
            "month" => "May",
            "time_spent" => "45"
        ];
        $timeSpentData[] = [
            "month" => "Jun",
            "time_spent" => "36"
        ];
        $timeSpentData[] = [
            "month" => "Jul",
            "time_spent" => "76"
        ];
        $timeSpentData[] = [
            "month" => "Aug",
            "time_spent" => "24"
        ];
        $timeSpentData[] = [
            "month" => "Sep",
            "time_spent" => "65"
        ];
        $timeSpentData[] = [
            "month" => "Oct",
            "time_spent" => "4"
        ]; 

         // dummy data end - need to remove later 


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
 
        // return $timeSpentData;

        return view('e-learning/course/students/dashboard', compact('enrolments','likeCourses','totalTimeSpend','totalHours','totalMinutes','timeSpentData','percentageChange','notStartedCount','inProgressCount','completedCount'));
    }

    // dashboard
    public function enrolled(){

        $enrolments = Checkout::with('course.reviews')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(12);
        $cartCount = Cart::where('user_id', auth()->id())->count();
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

        $instructor = User::where('subdomain', $subdomain)->first();

        if ( $instructor) {
            $courses = Course::where('user_id', $instructor->id)->where('status','published')->with('user','reviews')->orderBy('id','desc');
        }else{
            $courses = Course::with('user','reviews')->where('status','published')->orderBy('id','desc');
        }

        $bundleCourse = BundleCourse::orderBy('id','desc')->get();
        $mainCategories = $courses->pluck('categories');

        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        if(!empty($title)){
            $titles = explode( ' ', $title);
            $courses->where('title','like','%'.trim($titles[0]).'%');
            $bundleCourse->where('title','like','%'.trim($titles[0]).'%');
            if(isset($titles[1])){
                $courses->where('title','like','%'.trim($titles[1]).'%');
                $bundleCourse->where('title','like','%'.trim($titles[1]).'%');
            }
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
    public function show($slug)
    { 

        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
        $relatedCourses = Course::where('id', '!=', $course->id)
        ->where('user_id', $course->user_id)
        ->inRandomOrder()
        ->limit(3)
        ->get();
        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();
        $course_like = course_like::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
        $liked = '';
        if ($course_like ) {
            $liked = 'active';
        }

        $totalModules = count($course->modules);
        $totalLessons = $course->modules->sum(function ($module) {
            return count($module->lessons);
        });
 

        if ($course) {
            return view('e-learning/course/students/show', compact('course','course_reviews','liked','course_like','totalLessons','totalModules','relatedCourses'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }
    }

    public function certificateDownload($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $user = auth()->user();
        $studentName = $user->name;
        $courseName = $course->title;

        $certificateTemplate = Image::make(public_path($course->sample_certificates));

        $templateWidth = $certificateTemplate->width();
        $templateHeight = $certificateTemplate->height();

        $x = $templateWidth / 2;
        $y = $templateHeight / 2;

        $courseX = $x;
        $courseY = $y + 250;

        $certificateTemplate->text($studentName, $x, $y, function ($font) {
            $font->file(public_path('assets/fonts/Gilroy-Black.ttf'));
            $font->size(100);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $certificateTemplate->text($courseName, $courseX, $courseY, function ($font) {
            $font->file(public_path('assets/fonts/Gilroy-Black.ttf'));
            $font->size(150); // Adjust the font size as needed
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $certificatePath = storage_path('app/public/certificates/' . $user->id . '_certificate.png');
        $certificateTemplate->save($certificatePath);

        // $pdf = PDF::loadView('certificate', compact('certificatePath'));

        // return $pdf->download('certificate')->deleteFileAfterSend(true);

        return response()->download($certificatePath)->deleteFileAfterSend(true);
    }


    // course overview
    public function overview($slug)
    {
        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
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
                $query = Course::query(); // Replace YourModel with your actual model class

                foreach ($categoryArray as $category) {
                    $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                }
                $related_course = $query->take(4)->get();
            }

            return view('e-learning/course/students/overview', compact('course','course_reviews','related_course','cartCourses','liked','courseEnrolledNumber'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }
    }

      // my course details
        public function courseDetails($slug){
        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
        $courseEnrolledNumber = Checkout::where('course_id',$course->id)->count();

        $totalReviews = CourseReview::where('course_id', $course->id)->with('user')->count();
        $completes = CourseActivity::where(['course_id'=> $course->id,'user_id'=> Auth::user()->id, "is_completed" => 1])->pluck('lesson_id')->toArray();
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                $completed = in_array($lesson->id, $completes);
                $lesson->completed =  (int)$completed;
            }
        }

        if ($course) {
            return view('e-learning/course/students/myCourse',compact('course','totalReviews','courseEnrolledNumber'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }

    }

    public function storeCourseLog(Request $request){
        $courseId = (int)$request->input('courseId');
        $lessonId = (int)$request->input('lessonId');
        $moduleId = (int)$request->input('moduleId');
        $userId = Auth()->user()->id;

        $courseLog = CourseLog::where('course_id', $courseId)->where('user_id',$userId)->first();
        if(!$courseLog){
            $courseLogInfo = new CourseLog([
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
            $courseLogInfo->save();
            return response()->json([
                'message' => 'course log save successfully',
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
        }else{
            $courseLog->course_id = $courseId;
            $courseLog->module_id = $moduleId;
            $courseLog->lesson_id = $lessonId;
            $courseLog->update();
            return response()->json([
                'message' => 'course log updated',
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
        }

    }

    /**
     * Student activties lesson complete
     */
    public function storeActivities( Request $request )
    {
        // Update or insert to course activities
        $courseId = (int)$request->input('courseId');
        $lessonId = (int)$request->input('lessonId');
        $moduleId = (int)$request->input('moduleId');
        $userId = Auth()->user()->id;

        $courseActivities = CourseActivity::updateOrCreate(
            ['lesson_id' => $lessonId, 'module_id' => $moduleId],
            [
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
                'is_completed' => true
            ]
        );

        // return true;

        return view('e-learning/course/students/activity', compact('courseActivities'));
    }

    public function review(Request $request,$slug){
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
                'star'      => $request->star,
                'comment'   => $request->comment,
            ]);
            $review->save();
        }

        return redirect()->route('students.show.courses',$slug)->with('message', 'comment submitted successfully!');

    }

    public function certificate()
    {
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('e-learning/course/students/certifiate', compact('cartCount'));
    }

    public function message()
    {
        $cartCount = Cart::where('user_id', auth()->id())->count();
        return view('e-learning/course/students/message-2', compact('cartCount'));
    }

    public function courseLike($course_id, $ins_id)
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

    public function courseUnLike($course_id, $ins_id)
    {

        $course_liked = course_like::where('course_id', $course_id)->where('instructor_id', $ins_id)->first();

        if ($course_liked) {
             $course_liked->delete();
             $status = 'unliked';
        }

        return redirect()->back()->with('success', 'Course Unlike Successfully Done!');
    }
}
