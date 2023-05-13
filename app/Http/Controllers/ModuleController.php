<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // module list
    public function index()
    {  
        return view('module/admin/index'); 
    }

    // module create
    public function create(Request $request)
    {  
        return view('module/admin/create'); 
    }

    // module edit
    public function edit($slug)
    {  
        return view('module/admin/edit'); 
    } 
}
