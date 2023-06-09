<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    // dashboard
    public function dashboard(){
        $courses = 0;
        $students = 0;
        $instructors = 0; 

        $courses = Course::count();
        $userCounts = User::select('user_role', \DB::raw('count(*) as total'))
            ->groupBy('user_role')
            ->pluck('total', 'user_role');

            foreach ($userCounts as $role => $count) {
                if($role == 'student')
                    $students = $count;

                if($role == 'instructor')
                    $instructors = $count;
            } 
        return view('e-learning/course/admin/dashboard',compact('courses','students','instructors')); 
    }
}