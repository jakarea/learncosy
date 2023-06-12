<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\BundleCourse;
use App\Models\User;
class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all user who are instructor use auth service provider
        $instructors = User::where('user_role', 'instructor')->get();
        return "Hello test"; 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function instructorHome($username)
    {

        // filter course 
        $title = isset($_GET['title']) ? $_GET['title'] : ''; 
        $categories = isset($_GET['categories']) ? $_GET['categories'] : ''; 
        $subscription_status = isset($_GET['subscription_status']) ? $_GET['subscription_status'] : ''; 
        $price = isset($_GET['price']) ? $_GET['price'] : ''; 

        $instructors = User::with(['courses.reviews'])->where('username', $username)->first();
        
        if(!empty($title)){
            $instructors = User::with(['courses' => function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%');
            }])->first();
        }
        if(!empty($categories)){ 
            $instructors = User::with(['courses' => function ($query) use ($categories) {
                $query->where('categories', 'like', '%' . $categories . '%');
            }])->first();
        }
        if(!empty($subscription_status)){ 
            $instructors = User::with(['courses' => function ($query) use ($subscription_status) {
                $query->where('subscription_status', 'like', '%' . $subscription_status . '%');
            }])->first();
        }
        if(!empty($price)){ 
            $instructors = User::with(['courses' => function ($query) use ($price) {
                $query->where('price', 'like', '%' . $price . '%');
            }])->first();
        } 
        // filter end

        // $instructors = User::with(['courses'])->where('username', $username)->first();
        
        $instructor_courses = collect($instructors->courses)->pluck('id')->toArray();
        $courses_review = CourseReview::with(['course','user'])->whereIn('course_id',$instructor_courses)->inRandomOrder()->take(5)->get();
        $students = User::where('user_role','student')->get();
        $bundle_courses = BundleCourse::where('user_id',$instructors->id)->get(); 

        foreach ($bundle_courses as $course) {
            $courses_id = explode(",", $course->selected_course);
            $course_info = Course::whereIn('id',$courses_id)->get();
            $course['courses'] =  $course_info;
        }

        // return $courses_review;

        return view('frontend.homepage', compact('instructors','courses_review','bundle_courses','students'));
    }

    public function homeInstructorCourseDetails($username,$slug){
        $instructor = User::with(['courses'])->where('username', $username)->first();
        $course = Course::with(['modules.lessons','user'])->where('user_id',$instructor->id)->where('slug',$slug)->first();
        $courses_review = CourseReview::with(['course','user'])->where('course_id',$course->id)->inRandomOrder()->take(5)->get();

        // return view('frontend.course', compact(['instructors', 'courses'));
        // return response()->json([
        //     'instructor'    => $instructor,
        //     'course'        => $course,
        //     'courses_review' => $courses_review,

        // ]);

        return view('frontend.course', compact('instructor', 'course','courses_review'));
    }

    public function create()
    {
        //
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $instructors = User::where('user_role', 'instructor')->where('id', $id)->first();
        $courses = Course::where('user_id', $id)->get();
        // return view('frontend.course', compact('instructors', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
