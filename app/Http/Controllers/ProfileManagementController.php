<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use App\Models\Course;
use App\Models\Experience;
use Illuminate\Support\Str;
use App\Mail\ProfileUpdated;
use App\Mail\PasswordChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileManagementController extends Controller
{

    // profile show
    public function show()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $courses = Course::where('user_id', $id)->get();
        $experiences = Experience::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        return view('profile/instructor/profile',compact('user','courses','experiences'));
    }

    // profile edit
    public function edit(Request $request)
    {
        $experience_id = $request->query('id');
        $userId = Auth()->user()->id;
        $user = User::find($userId);
        $editExp = '';
        if($experience_id){
            $editExp = Experience::where('id', $experience_id)->first();
        } 
        $experiences = Experience::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        return view('profile/instructor/edit',compact('user','experiences','editExp'));
    }

    public function update(Request $request)
    {
        // return $request->all();

        $userId = Auth()->user()->id;

        $this->validate($request, [
            'name' => 'required|string',
            'short_bio' => 'string',
            'phone' => 'required|string',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [
            'avatar' => 'Max file size is 5 MB!'
        ]);

        $user = User::where('id', $userId)->first();
        $user->name = $request->name;

        if ($user->subdomain) {
            $user->subdomain = $user->subdomain;
        }else{
            $user->subdomain =  Str::slug($request->subdomain);
        }
        $user->short_bio = $request->website;
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

        $slugg = Str::slug($request->name);

        if ($request->hasFile('avatar')) { 
            if ($user->avatar) {
               $oldFile = public_path($user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $slugg . '-' . uniqid() . '.webp';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;
           $user->avatar = $image_path;
       }
       
        $user->save();

        // Send email
        Mail::to($user->email)->send(new ProfileUpdated($user));

        return redirect()->route('instructor.profile')->with('success', 'Your Profile has been Updated successfully!');
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

        return redirect()->route('instructor.profile')->with('success', 'Your password has been changed successfully!');
    }
}
