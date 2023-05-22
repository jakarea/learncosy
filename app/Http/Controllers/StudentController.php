<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // list page 
    public function index()
     {  
        $user_role = "students";
        $students = User::orderby('id', 'desc')->where('user_role', $user_role)->paginate(12);
         return view('students/instructor/index',compact('students')); 
     }

    // create page 
    public function create()
     {  
         return view('students/instructor/create'); 
     }

    // store page 
    public function store(Request $request)
     {  
        // return $request->all();

        $request->validate([
            'name' => 'required|string',
            'user_role' => 'required|string',
            'short_bio' => 'string',
            'phone' => 'string',
            'email' => 'required|email|unique:users,email', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);


        // add student
        $student = new User([
            'name' => $request->name,
            'user_role' => $request->user_role,
            'email' => $request->email,
            'phone' => $request->phone,
            'short_bio' => $request->short_bio,
            'social_links' => is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links,
            'description' => $request->description,
            'recivingMessage' => $request->recivingMessage,
            'password' => 12345678,
        ]);  
 


        $studentslug = Str::slug($request->name);
         //if avatar is valid then save it
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = $studentslug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/user');
            $image->move($destinationPath, $name);
            $student->avatar = $name;
        } 

        $student->save();
        return redirect('instructor/students')->with('success', 'Student Added Successfully!');

     }

    // show page 
    public function show($id)
     {  
        $student = User::where('id', $id)->first();
    
        return view('students/instructor/show',compact('student')); 
     }

    // show page 
    public function edit($id)
     {  
        $student = User::where('id', $id)->first();
        
        return view('students/instructor/edit',compact('student'));
     }

     public function update(Request $request,$id)
     {
        //  return $request->all();
 
         $userId = $id;  
 
         $this->validate($request, [
             'name' => 'required|string',
             'user_role' => 'required|string',
             'short_bio' => 'required|string',
             'phone' => 'required|string',
             'email' => 'required|email|unique:users,email,'.$userId, 
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
         ]);
 
        
         $user = User::where('id', $userId)->first();
         $user->name = $request->name;
         if ($request->user_name) {
            $user->user_name =  Str::slug($request->user_name);
         }
         $user->short_bio = $request->short_bio;
         $user->social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
         $user->user_role = $request->user_role;
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
         return redirect()->route('allStudents')->with('success', 'Students Profile has been Updated successfully!');
     }

     public function destroy($id){
         
        $student = User::where('id', $id)->first();
         //delete student avatar
         $studentOldThumbnail = public_path('/assets/images/user/'.$student->avatar);
         if (file_exists($studentOldThumbnail)) {
             @unlink($studentOldThumbnail);
         } 
        $student->delete();

        return redirect('instructor/students')->with('success', 'Student Successfully deleted!');
    }
}
