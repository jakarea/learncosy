<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileManagementController extends Controller
{
    // profile list
    public function index()
    {  
        return view('profile/admin/index'); 
    }

    // profile create
    public function create()
    {  
        return view('profile/admin/create'); 
    }

    // profile show
    public function show()
    {  
        return view('profile/instructor/profile'); 
    }

    // profile edit
    public function edit()
    {  
        return view('profile/instructor/edit'); 
    }
}
