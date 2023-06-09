<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Message;
use App\Models\Checkout;
use App\Models\CourseLog;
use App\Models\BundleCourse;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use App\Models\CourseActivity;
use App\Http\Controllers\Controller;

class StudentHomeController extends Controller
{
    // dashboard
    public function dashboard(){ 
        $enrolments = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $userId = Auth::user()->id;
        $highLightMessages = Message::where('receiver_id',$userId)->orWhere('user_id',$userId)->get()->groupBy(function($data) use ($userId){
            if( $data->receiver_id == $userId){
                return $data->user_id;
            }
            if( $data->user_id == $userId){
                return $data->receiver_id;
            }
        });
        foreach ($highLightMessages as $messages) {
            foreach( $messages as $message){
                if($message->receiver_id == $userId ){
                    $message['user'] = User::find($message->user_id );
                }else{
                    $message['user'] = User::find($message->receiver_id );
                }
            }
        }
        $messages = $highLightMessages->first() ? $highLightMessages->first() : [];

        return view('e-learning/course/students/dashboard', compact('enrolments','highLightMessages')); 
    }

    // dashboard
    public function enrolled(){
        
        $enrolments = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('e-learning/course/students/enrolled',compact('enrolments')); 
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
    public function catalog(){
        $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $courses = Course::orderBy('id','desc');
        $bundleCourse = BundleCourse::orderBy('id','desc')->get();
        $mainCategories = $courses->pluck('categories'); 
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

        return view('e-learning/course/students/catalog',compact('courses','categories', 'bundleCourse')); 
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
        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();

        if ($course) {
            return view('e-learning/course/students/show', compact('course','course_reviews'));
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

        return true;
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
            if ($request->comment) {
                $review = new CourseReview([
                    'user_id'   => $userId,  
                    'course_id' => $course->id,
                    'star'      => $request->star,
                    'comment'   => $request->comment,  
                ]);  
                $review->save();
            }
            
        }
        
        return redirect()->route('students.show.courses',$slug)->with('message', 'comment submitted successfully!');

    }

    public function message()
    {    
        return view('e-learning/course/students/message'); 
    }

    public function message2()
    {    
        return view('e-learning/course/students/message-2'); 
    }
}