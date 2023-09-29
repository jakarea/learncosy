<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\PasswordChanged;
use App\Models\Checkout;
use App\Mail\ProfileUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    // profile show
    public function show()
    {  
        $id = Auth::user()->id;
        $user = User::find($id); 
        $checkout = Checkout::where('user_id', $id)->with('course')->get(); 

        return view('profile/students/profile',compact('user','checkout')); 
    }

    // profile edit
    public function edit()
    {    
        $userId = Auth()->user()->id;  
        $user = User::find($userId);
        return view('profile/students/edit',compact('user'));  
    }

    public function update(Request $request)
    {
        // return $request->all();

        $userId = Auth()->user()->id;  

        $this->validate($request, [
            'name' => 'required|string',
            'short_bio' => 'required|string',
            'phone' => 'required|string', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ]);

       
        $user = User::where('id', $userId)->first();
        $user->name = $request->name;
        $user->subdomain =  Str::slug($request->subdomain);
        $user->short_bio = $request->short_bio;
        $user->social_links = implode(",",$request->social_links);
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->recivingMessage = $request->recivingMessage;
        $user->email = $user->email; 
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        }  

        if ($request->hasFile('avatar')) { 
            // Delete old file
            if ($user->avatar) {
               $oldFile = public_path($user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           } 
           $slugg = Str::slug($request->name);
           $image = $request->file('avatar');
           $name = $slugg.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/assets/images/users');
           $image->move($destinationPath, $name);
           $user->avatar = $name; 
       }

        $user->save();

        // Send email
        Mail::to($user->email)->send(new ProfileUpdated($user));

        return redirect()->route('students.profile')->with('success', 'Your Profile has been Updated successfully!');
    }

    // password update
    public function passwordUpdate()
    {    
        $userId = Auth()->user()->id;  
        $user = User::find($userId); 
        return view('profile/students/password-change',compact('user'));  
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

         // Send email
         Mail::to($user->email)->send(new PasswordChanged($user));

        return redirect()->route('students.profile')->with('success', 'Your password has been changed successfully!');
    }
}