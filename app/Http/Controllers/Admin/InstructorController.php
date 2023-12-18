<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Models\User;
use App\Models\Course;
use App\Models\Experience;
use App\Models\Lesson;
use Illuminate\Support\Str;
use DB;  
use App\Models\Checkout;
use App\Models\ManagePage;
use App\Models\VimeoData;
use App\Models\Module;
use App\Models\InstructorModuleSetting;
use App\Models\BundleSelect;
use App\Models\CourseActivity;
use App\Models\Notification;
use App\Models\CourseLog;
use App\Models\BundleCourse;
use App\Models\Certificate;
use App\Models\CourseReview;
use App\Models\Cart;
use App\Models\course_like;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Crypt;

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
           'phone' => 'required|string',
           'email' => 'required|email|unique:users,email',
           'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
       ],
       [
           'avatar' => 'Max file size is 5 MB!',
           'phone' => 'Phone number is required.',
       ]);

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
           'password' => Hash::make($request->password),
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

        // set unique id for user
        $uniqueId = Str::uuid()->toString();
        session(['unique_id' => $uniqueId]);

        $userSessionId = $value = Crypt::encrypt(session('unique_id').mt_rand());

        $adminUser = User::where('id',Auth::user()->id)->first();
        $adminUser->session_id = $value;
        $adminUser->save();

        $userId = Crypt::encrypt($adminUser->id);
        $insId = Crypt::encrypt($id);

       return view('instructor/admin/show',compact('instructor', 'subscription','experiences','userSessionId','userId','insId'));
     }

      // show page
    public function edit($id)
    {
       $instructor = User::where('id', $id)->first();

       return view('instructor/admin/edit',compact('instructor'));
    }

    public function update(Request $request,$id)
    {
        // return $request->all();

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
        $user->status = $request->status;
         
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

    public function destroy($id){

        if (!$id) {
            return redirect('admin/instructor')->with('error', 'Failed to delete this Instructor!');
        }

        $instructorId = intval($id);

        /// bundle course delete
        $bundleCourses = BundleCourse::where(['instructor_id' => $instructorId])->get();
        if ($bundleCourses) {
            foreach ($bundleCourses as $bundleCourse) { 
                $bundleThumbnail = public_path($bundleCourse->thumbnail);
                if (file_exists($bundleThumbnail)) {
                    @unlink($bundleThumbnail);
                } 
                $bundleCourse->delete();
            }
        }

         // delete bundleselected for this user
         $bundleSelection = BundleSelect::where(['instructor_id' => $instructorId])->get();
         if ($bundleSelection) {
             foreach ($bundleSelection as $bundleSelected) { 
                 $bundleSelected->delete();
             }
         }

         // certificate delete
        $allCertificates = Certificate::where(['instructor_id' => $instructorId])->get();
        if ($allCertificates) {
            foreach ($allCertificates as $certificate) { 
                $certificateOldLogo = public_path($certificate->logo);
                if (file_exists($certificateOldLogo)) {
                    @unlink($certificateOldLogo);
                }
                $certificateOldSignature = public_path($certificate->signature);
                if (file_exists($certificateOldSignature)) {
                    @unlink($certificateOldSignature);
                }
                $certificate->delete();
            }           
        }

        // checkout controller update
        $totalCheckout = Checkout::where(['instructor_id' => $instructorId])->get();
        if ($totalCheckout) {
            foreach ($totalCheckout as $checkout) {
                $checkout->status = 'deleted';
                $checkout->save();
            }
        }

        // delete course for this instructor
        $courses = Course::where(['instructor_id' => $instructorId])->get();
        if ($courses) {
             foreach ($courses as $course) {
                //delete thumbnail
                $oldThumbnail = public_path($course->thumbnail);
                if (file_exists($oldThumbnail)) {
                    @unlink($oldThumbnail);
                } 
                //delete certficate
                $oldCertificate = public_path($course->sample_certificates);
                if (file_exists($oldCertificate)) {
                    @unlink($oldCertificate);
                }
                //delete modules
                $modules = Module::where('course_id', $course->id)->get();
                foreach ($modules as $module) {
                    //delete lessons
                    $lessons = Lesson::where('module_id', $module->id)->get();
                    foreach ($lessons as $lesson) {
                        //delete lesson thumbnail
                        $lessonOldThumbnail = public_path($lesson->thumbnail);
                        if (file_exists($lessonOldThumbnail)) {
                            @unlink($lessonOldThumbnail);
                        }
                        //delete lesson file
                        $lessonOldFile = public_path($lesson->lesson_file);
                        if (file_exists($lessonOldFile)) {
                            @unlink($lessonOldFile);
                        }
                        
                        $lesson->delete();
                    }
                    $module->delete();
                }
                $course->delete();
             }
        }

        // experience table delete
        $totalExperiences = Experience::where(['user_id' => $instructorId])->get();
        if ($totalExperiences) {
            foreach ($totalExperiences as $totalExperience) { 
                $totalExperience->delete();
            }
        }

        // module settings delete
        $insModule = InstructorModuleSetting::where(['instructor_id' => $instructorId])->first();
        if ($insModule) {
            $insModule->delete();
        }

        // manage pages settings delete
        $managePage = ManagePage::where(['instructor_id' => $instructorId])->first();
        if ($managePage) {
            $managePage->delete();
        }

        // delete notification for this course
        $course_notifications = Notification::where(['instructor_id' => $instructorId])->get();
        if ($course_notifications) {
            foreach ($course_notifications as $course_notification) { 
                $course_notification->delete();
            }
        }

         // subscription update
         $totalSubscriptions = Subscription::where(['instructor_id' => $instructorId])->get();
         if ($totalSubscriptions) {
             foreach ($totalSubscriptions as $totalSubscription) {
                 $totalSubscription->status = 'deleted';
                 $totalSubscription->save();
             }
         }

        //  vimeo data
        $vimeoData = VimeoData::where(['user_id' => $instructorId])->first();
        if ($vimeoData) {
            $vimeoData->delete();
        }
         //  delete instructor avatar 
        $instructor = User::where('id', $id)->first();
        $instructorOldAvatar = public_path($instructor->avatar);
        if (file_exists($instructorOldAvatar)) {
            @unlink($instructorOldAvatar);
        }

        $instructor->delete();

        return redirect('admin/instructor')->with('success', 'Instructor Successfully deleted!');
    }
}
