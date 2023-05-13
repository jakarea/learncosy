<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // module list
    public function index()
    {  
        return view('module/instructor/index'); 
    }

    // module create
    public function create()
    {  
        return view('module/instructor/create'); 
    }

    // module edit
    public function edit($slug)
    {  
        return view('module/instructor/edit'); 
    } 
}
