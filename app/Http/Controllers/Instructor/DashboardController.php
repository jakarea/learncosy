<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Checkout;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        $categories = [];
        $courses = 0;
        $students = [];
        $users = User::where('user_role', 'students')->orWhere('user_role', 'instructor')->count();
        $enrolments = Checkout::with('course','user')->where('instructor_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        
        foreach($enrolments as $enrolment){ 
            $students[$enrolment->user_id] = $enrolment->user;
        }

        $courses = Course::where('user_id', Auth::user()->id)->get();
        $allCategories = $courses->pluck('categories'); 
        foreach($allCategories as $category){ 
            $cats = explode(",", $category);
            foreach($cats as $cat){
                $unique_array[] = strtolower($cat);
            }
        }

        $categories = array_unique($unique_array);

        return [$categories, $courses, $students, $enrolments];

        return view('e-learning/course/admin/dashboard',compact('courses','users','enrolmentStudents')); 
    }
}
