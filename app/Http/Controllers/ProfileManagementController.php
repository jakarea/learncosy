<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
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
        $id = Auth::user()->id;
        $user = User::find($id); 
        return view('profile/instructor/profile',compact('user')); 
    }

    // profile edit
    public function edit($slug)
    {    
        $user = User::where('user_name', $slug)->first();
        return view('profile/instructor/edit',compact('user'));  
    }
}
