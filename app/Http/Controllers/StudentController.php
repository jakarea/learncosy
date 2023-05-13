<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    // list page 
    public function index()
     {  
         return view('students/instructor/index'); 
     }

    // create page 
    public function create()
     {  
         return view('students/instructor/create'); 
     }
}
