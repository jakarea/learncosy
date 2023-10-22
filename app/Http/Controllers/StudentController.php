<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    // list page 
    public function index()
     { 
        $course = Course::where('user_id', auth()->user()->id)->get();
       $checkout = Checkout::whereIn('course_id', $course->pluck('id'))->get();

        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $users = User::whereIn('id', $checkout->pluck('user_id')); 
        
        if ($name) {
            $users->where('name', 'like', '%' . trim($name) . '%');
        }
        if ($status) {
            $users->where('status', '=', $status);
        }

        $users = $users->paginate(12);
 
         return view('students/instructor/grid',compact('users')); 
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
            'phone' => 'string',
            'email' => 'required|email|unique:users,email', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [ 
            'avatar' => 'Max file size is 5 MB!'
        ]);

        // initial password for student if instructor create profile
        $initialPass = 1234567890;

        // add student
        $student = new User([
            'name' => $request->name,
            'user_role' => 'student',
            'email' => $request->email,
            'phone' => $request->phone,
            'short_bio' => $request->website,
            'company_name' => $request->company_name,
            'social_links' => is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links,
            'description' => $request->description,
            'recivingMessage' => $request->recivingMessage,
            'password' => Hash::make($initialPass),
        ]);  

        $stuSlug = Str::slug($request->name);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $stuSlug . '-' . uniqid() . '.png';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;
            $student->avatar = $image_path;
        } 

        $student->save();
        return redirect('instructor/students')->with('success', 'Student Added Successfully!');

     }

    // show page 
    public function show($id)
     {  
        $checkout = Checkout::where('user_id', $id)->get();

        $course = Course::whereIn('id', $checkout->pluck('course_id'))->where('user_id', auth()->user()->id)->get();

        $student = User::where('id', $id)->first();

        return view('students/instructor/show',compact('checkout', 'student','course'));
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
             'phone' => 'required|string',  
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
         ],
         [ 
             'avatar' => 'Max file size is 5 MB!'
         ]);
 
        
         $user = User::where('id', $userId)->first();
         $user->name = $request->name;
         if ($request->subdomain) {
            $user->subdomain =  Str::slug($request->subdomain);
         }else{
            $user->subdomain = $user->subdomain;
        } 
         if ($request->user_role) {
            $user->user_role = $user->user_role;
         }

         $user->short_bio = $request->website;
         $user->company_name = $request->company_name;
         $user->social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
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
             $uniqueFileName = $slugg . '-' . uniqid() . '.png';
             $image->save(public_path('uploads/users/') . $uniqueFileName);
             $image_path = 'uploads/users/' . $uniqueFileName;
            $user->avatar = $image_path;
        }
 
         $user->save();
         return redirect()->route('allStudents')->with('success', 'Students Profile has been Updated successfully!');
     }

     public function destroy($id){
         
        $student = User::where('id', $id)->first();
         //delete student avatar 
         $studentOldThumbnail = public_path('uploads/users/'.$student->avatar);
         if (file_exists($studentOldThumbnail)) {
             @unlink($studentOldThumbnail);
         } 
        $student->delete();

        return redirect('instructor/students')->with('success', 'Student Successfully deleted!');
    }
}
