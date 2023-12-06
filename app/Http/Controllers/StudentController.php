<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use App\Models\BundleSelect;
use App\Models\CourseActivity;
use App\Models\Notification;
use App\Models\CourseLog;
use App\Models\BundleCourse;
use App\Models\Certificate;
use App\Models\CourseReview;
use App\Models\Cart;
use App\Models\course_like;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
    // list page
    public function index()
     {


        $course = Course::where('user_id', auth()->user()->id)->get();
        // return  $course;
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

        $serverName = $_SERVER['SERVER_NAME'];
        $subdomain = explode('.', $serverName);

        if (count($subdomain) > 1) {
            $subdomain = $subdomain[0];
        }

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [
            'avatar' => 'Max file size is 5 MB!',
            'phone' => 'Phone number is required'
        ]);

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
            'password' => Hash::make($request->password),
            'subdomain' => $subdomain
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
    public function show($domain, $id)
     {
        $checkout = Checkout::where('user_id', $id)->get();
        $course = Course::whereIn('id', $checkout->pluck('course_id'))->where('user_id', auth()->user()->id)->get();
        $student = User::where('id', $id)->first();

        // set unique id for user
        $uniqueId = Str::uuid()->toString();
        session(['unique_id' => $uniqueId]);

        $userSessionId = $value = Crypt::encrypt(session('unique_id').mt_rand());

        $instructorUser = User::where('id',Auth::user()->id)->first();
        $instructorUser->session_id = $value;
        $instructorUser->save();

        $userId = Crypt::encrypt($instructorUser->id);
        $stuId = Crypt::encrypt($id);

        return view('students/instructor/show',compact('checkout', 'student','course','userSessionId','userId','stuId'));
     }

    // show page
    public function edit($id)
     {
        $student = User::where('id', $id)->first();
        return view('students/instructor/edit',compact('student'));
     }

     public function update(Request $request,$id)
     {

         $userId = $id;

         $this->validate($request, [
             'name' => 'required|string',
             'phone' => 'required|string',
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
         ],
         [
             'avatar' => 'Max file size is 5 MB!',
             'phone' => 'Phone number is required'
         ]);


         $user = User::where('id', $userId)->first();
         $user->name = $request->name;

         if ($request->subdomain) {
            $user->subdomain =  Auth::user()->subdomain;
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


         if ($request->email) {
             $user->email =  $request->email;
         }else{
             $user->email = $user->email;
         }

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

     //  upload cover photo for all instructor
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

     public function destroy($id)
     {
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

        return redirect('instructor/students')->with('success', 'Student Successfully Deleted!');
    }
}
