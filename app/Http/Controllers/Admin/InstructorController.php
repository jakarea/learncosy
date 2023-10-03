<?php

namespace App\Http\Controllers\Admin;

use Auth; 
use DataTables;
use App\Models\User;
use App\Models\Course;
use App\Models\Experience;
use App\Models\Lesson;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class InstructorController extends Controller
{
     // list page 
     public function index()
     {    
        $user_role = "instructor"; 
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $users = User::where('user_role',$user_role)->orderBy('id', 'desc');
        if ($name) {
            $users->where('name', 'like', '%' . trim($name) . '%');
        }
        if ($status) {
            $users->where('status', '=', $status);
        }
        $users = $users->paginate(12);

        return view('instructor/admin/grid',compact('users')); 
     }

     // create page 
     public function create()
     {  
         return view('instructor/admin/create');
     }

     // store page 
    public function store(Request $request)
    {  
    //    return $request->all();

       $request->validate([
           'name' => 'required|string', 
           'phone' => 'string',
           'email' => 'required|email|unique:users,email', 
           'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
       ],
       [ 
           'avatar' => 'Max file size is 5 MB!'
       ]);

       // initial password for instructor if admin create profile
       $initialPass = 1234567890;

       // add instructor
       $instructor = new User([
           'name' => $request->name,
           'subdomain' => $request->subdomain,
           'user_role' => 'instructor',
           'email' => $request->email,
           'phone' => $request->phone,
           'short_bio' => $request->website,
           'company_name' => $request->company_name,
           'social_links' => is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links,
           'description' => $request->description,
           'recivingMessage' => $request->recivingMessage,
           'password' => Hash::make($initialPass),
       ]);  

       $insSlugs = Str::slug($request->name);

        if ($request->hasFile('avatar')) { 
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $insSlugs . '-' . uniqid() . '.png';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;
           $instructor->avatar = $image_path;
       }


       $instructor->save();
       return redirect('admin/instructor')->with('success', 'Instructor Added Successfully!');

    }

    // show page 
    public function show($id)
     {  
        $instructor = User::where('id', $id)->first();
        $experiences = Experience::where('user_id', Auth::user()->id)->orderBy('id','desc')->get();
        $subscription = Subscription::where('instructor_id', $id)->get();
    
        return view('instructor/admin/show',compact('instructor', 'subscription','experiences')); 
     }

      // show page 
    public function edit($id)
    {  
       $instructor = User::where('id', $id)->first();
       
       return view('instructor/admin/edit',compact('instructor'));
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
        }
        if ($request->user_role) {
           $user->user_role =  $user->user_role;
        }
        $user->short_bio = $request->website;
        $user->company_name = $request->company_name;
        $user->social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
        $user->subdomain = $request->subdomain;
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->recivingMessage = $request->recivingMessage;
        $user->email = $user->email; 
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        } 

        $insSlugg = Str::slug($request->name);

        if ($request->hasFile('avatar')) { 
            if ($user->avatar) {
               $oldFile = public_path($user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $insSlugg . '-' . uniqid() . '.png';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;
           $user->avatar = $image_path;
       }

        $user->save();
        return redirect('admin/instructor')->with('success', 'Instructor Profile has been Updated successfully!');
    }

    public function destroy($id){

        if (!$id) {
            return redirect('admin/instructor')->with('error', 'Failed to delete this Instructor!');
        }
         
        $instructor = User::where('id', $id)->first();
         //delete instructor avatar
         $instructorOldAvatar = public_path($instructor->avatar);
         if (file_exists($instructorOldAvatar)) {
             @unlink($instructorOldAvatar);
         }
         
         \App\Models\BundleCourse::where('user_id', $id)->delete();
         \App\Models\Checkout::where('instructor_id', $id)->delete();
         \App\Models\Course::where('user_id', $id)->delete();
         \App\Models\CourseActivity::where('user_id', $id)->delete();
         \App\Models\InstructorModuleSetting::where('instructor_id', $id)->delete();
         \App\Models\Message::where('sender_id', $id)->orWhere('receiver_id', $id)->delete();
         \App\Models\Module::where('user_id', $id)->delete();
         \App\Models\Lesson::where('user_id', $id)->delete();
         \App\Models\Subscription::where('instructor_id', $id)->delete();
         \App\Models\VimeoData::where('user_id', $id)->delete();

        $instructor->delete();

        return redirect('admin/instructor')->with('success', 'Instructor Successfully deleted!');
    }
}
