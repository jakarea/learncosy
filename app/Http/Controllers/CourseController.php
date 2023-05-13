<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // course list
    public function index()
    {  
        return view('course/instructor/index'); 
    }

    // course create
    public function create()
    {  
        return view('course/instructor/create'); 
    }

    // course store
    public function store(Request $request)
    {  
        return $request->all(); 
    }

    // course create
    public function show()
    {   
        return view('course/instructor/show'); 
    }

}
