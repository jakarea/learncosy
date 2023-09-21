<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // course edit
    public function index()
    {   
        return view('review/instructor/index'); 
    } 
}
