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

        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $courses = Course::orderBy('id','desc');
        if(!empty($name)){
            $names = explode( ' ', $name);
            $courses->where('title','like','%'.trim($names[0]).'%');
            if(isset($names[1])){
                $courses->where('title','like','%'.trim($names[1]).'%'); 
            }
        }
        $courses = $courses->paginate(12);

        return view('e-learning/course/students/home',compact('courses')); 
    }

    // catalog course list
    public function catalog(){

        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $courses = Course::orderBy('id','desc');
        if(!empty($name)){
            $names = explode( ' ', $name);
            $courses->where('title','like','%'.trim($names[0]).'%');
            if(isset($names[1])){
                $courses->where('title','like','%'.trim($names[1]).'%'); 
            }
        }
        $courses = $courses->paginate(12);

        return view('e-learning/course/students/catalog',compact('courses')); 
    }

    // account Management 
    public function accountManagement(){

        $userId = Auth()->user()->id;  
        $user = User::find($userId);
        return view('settings/students/account-management',compact('user')); 
    }

    // course show
    public function show($slug)
    {   
        $lessons = Lesson::orderby('id', 'desc')->paginate(10);
        $modules = Module::orderby('id', 'desc')->paginate(10);
        $course = Course::where('slug', $slug)->first();
        if ($course) {
            return view('e-learning/course/students/show', compact('course','modules','lessons'));
        } else {
            return redirect('students/dashboard')->with('error', 'Course not found!');
        }
    }

    public function message()
    {    
        return view('e-learning/course/students/message'); 
    }
}