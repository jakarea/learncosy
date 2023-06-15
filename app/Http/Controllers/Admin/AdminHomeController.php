<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Checkout;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    // dashboard
    public function dashboard(){
        $courses = 0;
        $users = 0;
        $enrolmentStudents = 0; 

        $courses = Course::count();
        $users = User::where('user_role', 'students')->orWhere('user_role', 'instructor')->count();
        $enrolmentStudents = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->count();

        // $userCounts = User::select('user_role', \DB::raw('count(*) as total'))
        //     ->groupBy('user_role')
        //     ->pluck('total', 'user_role');

        //     foreach ($userCounts as $role => $count) {
        //         if($role == 'student')
        //             $students = $count;

        //         if($role == 'instructor')
        //             $instructors = $count;
        //     } 

        return view('e-learning/course/admin/dashboard',compact('courses','users','enrolmentStudents')); 
    }
}