<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    // lesson list
    public function index()
    {  
        return view('lesson/instructor/index'); 
    }

    // lesson create
    public function create(Request $request)
    {  
        return view('lesson/instructor/create'); 
    }
}
