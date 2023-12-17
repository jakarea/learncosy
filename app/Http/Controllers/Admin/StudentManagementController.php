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
use Illuminate\Support\Facades\Crypt;

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
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
            'instructor' => 'required'
        ],
        [
            'avatar' => 'Max file size is 5 MB!',
            'phone' => 'Phone number is required'
        ]);
 
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
            'password' => Hash::make($request->password),
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

        // set unique id for user
        $uniqueId = Str::uuid()->toString();
        session(['unique_id' => $uniqueId]);

        $userSessionId = $value = Crypt::encrypt(session('unique_id').mt_rand());

        $adminUser = User::where('id',Auth::user()->id)->first();
        $adminUser->session_id = $value;
        $adminUser->save();

       $userId = Crypt::encrypt($adminUser->id);
       $stuId = Crypt::encrypt($id);

       return view('students/admin/show',compact('student', 'checkout','userSessionId','userId','stuId'));
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
             'phone' => 'required|string',
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
             'subdomain' => $request->instructor
         ],
         [
             'avatar' => 'Max file size is 5 MB!',
             'phone' => 'Phone number is required'
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

        // return $user;

         $user->save();
         return redirect()->route('admin.allStudents')->with('success', 'Students Profile has been Updated successfully!');
     }

     //  upload cover photo for all students
    public function coverUpload(Request $request)
    { 
        
        if ($request->hasFile('cover_photo')) {
            $coverPhoto = $request->file('cover_photo');

            $userId = $request->userId;
            $user = User::where('id', $userId)->first();
            $adSlugg = Str::slug($user->name);

            if ($user->cover_photo) {
                $oldFile = public_path($user->cover_photo);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
            $file = $request->file('cover_photo');
            $image = Image::make($file);
            $uniqueFileName = $adSlugg . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;

            $user->cover_photo = $image_path; 
            $user->save();
    
            return response()->json(['message' => "UPLOADED"]);
        }
    
        return response()->json(['error' => 'No image uploaded'], 400);
    }

     public function destroy($id){

        $userId = intval($id);

        // delete cart 
        $cartSelects = Cart::where(['user_id' => $userId])->get();
        if ($cartSelects) {
            foreach ($cartSelects as $cartSelect) { 
                $cartSelect->delete();
            }
        }

        // checkout table
        $totalCheckout = Checkout::where(['user_id' => $userId])->get();
        if ($totalCheckout) {
            foreach ($totalCheckout as $checkout) {
                $checkout->status = 'deleted';
                $checkout->save();
            }
        }

        // course activities
        $totalActivity = CourseActivity::where(['user_id' => $userId])->get();
        if ($totalActivity) {
            foreach ($totalActivity as $activity) { 
                $activity->delete();
            }
        }

         // course likes
         $course_likes = course_like::where(['user_id' => $userId])->get();
         if ($course_likes) {
             foreach ($course_likes as $course_liked) { 
                 $course_liked->delete();
             }
         }

         // course Log
        $course_logs = CourseLog::where(['user_id' => $userId])->get();
        if ($course_logs) {
            foreach ($course_logs as $course_log) { 
                $course_log->delete();
            }
        }

        // course review
        $course_reviews = CourseReview::where(['user_id' => $userId])->get();
        if ($course_reviews) {
            foreach ($course_reviews as $course_review) { 
                $course_review->delete();
            }
        }

         // course users
        $course_useres = DB::table('course_user')->where(['user_id' => $userId])->get();
        if ($course_useres) {
            foreach ($course_useres as $course_usere) { 
                DB::table('course_user')
                ->where('user_id', $userId)
                ->delete();
            }
        }

        // delete notification for this user
        $user_notifications = Notification::where(['user_id' => $userId])->get();
        if ($user_notifications) {
            foreach ($user_notifications as $user_notification) { 
                $user_notification->delete();
            }
        } 

        $student = User::find($userId); 
        
         $studentOldThumbnail = public_path($student->avatar);
         if (file_exists($studentOldThumbnail)) {
             @unlink($studentOldThumbnail);
         }
        $student->delete();

        return redirect('admin/students')->with('success', 'Student Successfully Deleted!');
    }

}
