<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class StudentManagementController extends Controller
{
    // list page
    public function index()
    {
        $user_role = "student";
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

        return view('students/admin/grid',compact('users'));
    }

     // create page
    public function create()
    {
        $data['instructors'] = User::select(['subdomain','name'])->where('user_role', 'instructor')->get();
        return view('students/admin/create', $data);
    }

    // store page
    public function store(Request $request)
     {
        // return $request->all();

        $request->validate([
            'name' => 'required|string',
            'short_bio' => 'string',
            'phone' => 'string',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
            'instructor' => 'required'
        ],
        [
            'avatar' => 'Max file size is 5 MB!'
        ]);

        // initial password for student if instructor create profile
        $initialPass = 1234567890;

        $social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
        // add student
        $student = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'short_bio' => $request->website,
            'company_name' => $request->company_name,
            'social_links' => trim($social_links,','),
            'description' => $request->description,
            'recivingMessage' => $request->recivingMessage,
            'password' => Hash::make($initialPass),
            'subdomain' => $request->instructor
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
        return redirect('admin/students')->with('success', 'Student Added Successfully!');

     }

     // show page
    public function show($id)
    {
       $student = User::where('id', $id)->first();
       $checkout = Checkout::where('user_id', $id)->with('course')->get();
       return view('students/admin/show',compact('student', 'checkout'));
    }

    // edit page
    public function edit($id)
     {

        $student = User::where('id', $id)->first();
        $instructors = User::select(['subdomain','name'])->where('user_role', 'instructor')->get();

        return view('students/admin/edit',compact('student','instructors'));
     }

     public function update(Request $request,$id)
     {
        //  return $request->all();

         $userId = $id;

         $this->validate($request, [
             'name' => 'required|string',
             'short_bio' => 'string',
             'phone' => 'required|string',
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
             'subdomain' => $request->instructor
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
        $user->subdomain = $request->instructor;

         $user->save();
         return redirect()->route('admin.allStudents')->with('success', 'Students Profile has been Updated successfully!');
     }

     public function destroy($id){

        $student = User::where('id', $id)->first();
         //delete student avatar
         $studentOldThumbnail = public_path($student->avatar);
         if (file_exists($studentOldThumbnail)) {
             @unlink($studentOldThumbnail);
         }
        $student->delete();

        return redirect('admin/students')->with('success', 'Student Successfully deleted!');
    }

}
