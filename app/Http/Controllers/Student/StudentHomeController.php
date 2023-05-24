<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;

class StudentHomeController extends Controller
{
    // all course list
    public function index(){
        $courses = Course::orderBy('id', 'desc')->get();
        return view('e-learning/course/students/home',compact('courses')); 
    }
}