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
        $courses = Course::orderBy('id', 'desc')->get();
        return view('e-learning/course/admin/dashboard',compact('courses')); 
    }
}