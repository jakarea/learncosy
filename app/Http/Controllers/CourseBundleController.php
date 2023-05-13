<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseBundleController extends Controller
{
     // course bundle list
     public function index()
     {  
         return view('bundle/instructor/index'); 
     }
 
     // course bundle create
     public function create()
     {  
         return view('bundle/instructor/create'); 
     }
}
