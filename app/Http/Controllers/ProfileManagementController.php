<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
    public function edit()
    {    
        $userId = Auth()->user()->id;  
        $user = User::find($userId);
        return view('profile/instructor/edit',compact('user'));  
    }

    public function update(Request $request)
    {
        // return $request->all();

        $userId = Auth()->user()->id;  

        $this->validate($request, [
            'name' => 'required|string',
            'short_bio' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$userId, 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

       
        $user = User::where('id', $userId)->first();
        $user->name = $request->name;
        $user->user_name =  Str::slug($request->name);
        $user->short_bio = $request->short_bio;
        $user->social_links = implode(",",$request->social_links);
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->recivingMessage = $request->recivingMessage;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        } 

        if ($request->avatar) {
            $userSlug = Str::slug($user->name); 
            $imageName = $userSlug.'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('assets/images/user'), $imageName); 
            $user->avatar = $imageName;
        }

        $user->save();
        return redirect()->route('myProfile')->with('success', 'Your Profile has been Updated successfully!');
    }

    // password update
    public function passwordUpdate()
    {    
        $userId = Auth()->user()->id;  
        $user = User::find($userId);
        return view('profile/instructor/password-change',compact('user'));  
    }

    public function postChangePassword(Request $request)
    {
        //  return $request->all();

        //validate password and confirm password
        $this->validate($request, [
            'password' => 'required|confirmed|min:6|string',
        ]);

        $userId = Auth()->user()->id; 
        $user = User::where('id', $userId)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('myProfile')->with('success', 'Your password has been changed successfully!');
    }
}
