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
        
        return view('frontend.homepage', compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function instructorDetails($id)
    {
        $instructors = User::with(['courses'])->where('id', $id)->first();
        $instructor_courses = collect($instructors->courses)->pluck('id')->toArray();
        $courses_review = CourseReview::with(['course'])->whereIn('course_id',$instructor_courses)->inRandomOrder()->take(5)->get();
        $bundle_courses = BundleCourse::where('user_id',$id)->get();
        foreach ($bundle_courses as $course) {
            $courses_id = explode(",", $course->selected_course);
            $course_info = Course::whereIn('id',$courses_id)->get();
            $course['courses'] =  $course_info;
        }
        // return view('frontend.course', compact(['instructors', 'courses'));
        return response()->json([
            'instructors'    => $instructors,
            'courses_review' => $courses_review,
            'bundle_courses'  => $bundle_courses

        ]);
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
        return view('frontend.course', compact('instructors', 'courses'));
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
