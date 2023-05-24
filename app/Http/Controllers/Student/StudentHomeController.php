<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Auth;
use App\Models\Module;

class StudentHomeController extends Controller
{
    // dashboard
    public function dashboard(){
        $courses = Course::orderBy('id', 'desc')->get();
        return view('e-learning/course/students/dashboard',compact('courses')); 
    }

    // all course list
    public function index(){
        $courses = Course::orderBy('id', 'desc')->get();
        return view('e-learning/course/students/home',compact('courses')); 
    }

    // catalog course list
    public function catalog(){
        $courses = Course::orderBy('id', 'desc')->get();
        return view('e-learning/course/students/catalog',compact('courses')); 
    }

    // account Management 
    public function accountManagement(){

        $userId = Auth()->user()->id;  
        $user = User::find($userId);
        return view('settings/students/account-management',compact('user')); 
    }
}