<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    // course list
    public function index()
    {  
        return view('course/admin/index'); 
    }

    // course create
    public function create()
    {  
        return view('course/admin/create'); 
    }

    // course store
    public function store(Request $request)
    {  
        return $request->all();
        return view('course/admin/create'); 
    }

    // course create
    public function show()
    {   
        return view('course/admin/show'); 
    }

    // course edit
    public function edit($slug)
    {  
        return view('course/admin/edit'); 
    } 
}
