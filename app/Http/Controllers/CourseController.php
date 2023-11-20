<?php

namespace App\Http\Controllers;

use Auth;
use File;
use DataTables;
use DB;
use App\Models\Course;
use App\Models\Lesson;
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
use App\Models\Module;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // course list
    public function index(){

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $courses = Course::where('user_id', Auth::user()->id);

        if ($title) {
            $courses->where('title', 'like', '%' . trim($title) . '%');
        }

        if ($status) {
            if ($status == 'oldest') {
                $courses->orderBy('id', 'asc');
            }

            if ($status == 'best_rated') { 
                $courses = Course::leftJoin('course_reviews', 'courses.id', '=', 'course_reviews.course_id')
                ->select('courses.*', \DB::raw('COALESCE(AVG(course_reviews.star), 0) as avg_star'))
                ->groupBy('courses.id')
                ->where('courses.user_id', Auth::user()->id)
                ->orderBy('avg_star', 'desc');
            }

            if ($status == 'most_purchased') {
                // $courses = Course::leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
                // ->select('courses.*')
                // ->groupBy('courses.id')
                // ->where('courses.user_id', Auth::user()->id)
                // ->orderBy(\DB::raw('COUNT(checkouts.course_id)'), 'desc');

                $courses = Course::select('courses.id', 'courses.price', 'courses.offer_price', 'courses.user_id', 'courses.title', 'courses.categories', 'courses.thumbnail', 'courses.slug', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'))
                ->with('user')
                ->with('reviews')
                ->where('courses.user_id', Auth::user()->id)
                ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
                ->groupBy('courses.id');


            }
            
            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc'); 
        }

        $courses = $courses->paginate(12);

        return view('e-learning/course/instructor/list',compact('courses'));
    } 

    // course show
    public function show($id)
    {   
        $course = Course::where('id', $id)->with('modules.lessons','user')->first();

        //start group file
        $lesson_files = Lesson::where('course_id',$course->id)->select('lesson_file as file')->get();
        $group_files = [];
       
        foreach($lesson_files as $lesson_file){
            if(!empty($lesson_file->file)){
                $file_name = $lesson_file->file;
                $file_arr = explode('.', $lesson_file->file);  
                $extention = $file_arr[1];
                if (!in_array($extention, $group_files)) {
                    $group_files[] = $extention;
                }
            }
        }
        
        //end group file


        $relatedCourses = Course::where('id', '!=', $id)
            ->where('user_id', Auth::user()->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();

        $totalModules = count($course->modules);
        $totalLessons = $course->modules->sum(function ($module) {
            return count($module->lessons);
        });


        if ($course) {
            return view('e-learning/course/instructor/show', compact('course','course_reviews','relatedCourses','totalModules','totalLessons'));
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }

    
    // course overview
    public function overview($slug)
    {
        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
        $promo_video_link = '';
        if($course->promo_video != ''){
            $ytarray=explode("/", $course->promo_video);
            $ytendstring=end($ytarray);
            $ytendarray=explode("?v=", $ytendstring);
            $ytendstring=end($ytendarray);
            $ytendarray=explode("&", $ytendstring);
            $ytcode=$ytendarray[0];
            $promo_video_link = $ytcode;
        }
 
        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get(); 
        $courseEnrolledNumber = Checkout::where('course_id',$course->id)->count();

        $related_course = [];
        if ($course) {
            if($course->categories){
                $categoryArray = explode(',', $course->categories);
                $query = Course::query();  

                foreach ($categoryArray as $category) {
                    $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                }
                $related_course = $query->take(4)->get();
            }


            return view('e-learning/course/instructor/overview', compact('course','promo_video_link','course_reviews','related_course','courseEnrolledNumber'));
        } else {
            return redirect('instructor/dashboard')->with('error', 'Course not found!');
        }
    }

    public function destroy($id)
    {
        // update bundle course for this course
        $selectedCourseValue = intval($id);
        $instructorId = Auth::user()->id; 
        $bundleSelected = BundleCourse::where('instructor_id', $instructorId)
            ->where(function ($query) use ($selectedCourseValue) {
                $query->where('selected_course', 'LIKE', $selectedCourseValue . ',%')
                    ->orWhere('selected_course', 'LIKE', '%,' . $selectedCourseValue . ',%')
                    ->orWhere('selected_course', 'LIKE', '%,' . $selectedCourseValue);
            })
            ->get(); 
        foreach ($bundleSelected as $record) {
            $updatedSelectedCourse = str_replace($selectedCourseValue . ',', '', $record->selected_course);
            $updatedSelectedCourse = str_replace(',' . $selectedCourseValue, '', $updatedSelectedCourse);
            $updatedSelectedCourse = str_replace($selectedCourseValue, '', $updatedSelectedCourse);
            $record->selected_course = $updatedSelectedCourse;
            $record->save();
        } 

        // delete bundleselected for this course
        $bundleSelection = BundleSelect::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($bundleSelection) {
            foreach ($bundleSelection as $bundleSelected) { 
                $bundleSelected->delete();
            }
        }

        // update cart 
        $cartSelects = Cart::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($cartSelects) {
            foreach ($cartSelects as $cartSelect) { 
                $cartSelect->delete();
            }
        }

        // certificate delete
        $certificate = Certificate::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->first();
        if ($certificate) {
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
        
        // checkout controller update
        $totalCheckout = Checkout::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($totalCheckout) {
            foreach ($totalCheckout as $checkout) {
                $checkout->status = 'deleted';
                $checkout->save();
            }
        }

        // course activities
        $totalActivity = CourseActivity::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($totalActivity) {
            foreach ($totalActivity as $activity) { 
                $activity->delete();
            }
        }

        // course likes
        $course_likes = course_like::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($course_likes) {
            foreach ($course_likes as $course_liked) { 
                $course_liked->delete();
            }
        }

        // course Log
        $course_logs = CourseLog::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($course_logs) {
            foreach ($course_logs as $course_log) { 
                $course_log->delete();
            }
        }

        // course review
        $course_reviews = CourseReview::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($course_reviews) {
            foreach ($course_reviews as $course_review) { 
                $course_review->delete();
            }
        }

        // course users
        $course_useres = DB::table('course_user')->where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($course_useres) {
            foreach ($course_useres as $course_usere) { 
                DB::table('course_user')
                ->where('id', $course_usere->id)
                ->delete();
            }
        }

        // delete notification for this course
        $course_notifications = Notification::where(['course_id'=> $selectedCourseValue,'instructor_id' => $instructorId])->get();
        if ($course_notifications) {
            foreach ($course_notifications as $course_notification) { 
                $course_notification->delete();
            }
        }

        // delete main course 
        $course = Course::where(['id'=> $selectedCourseValue,'user_id' => $instructorId])->first();

        if ($course) {
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
            return redirect('instructor/courses')->with('success', 'Course deleted Successfully!');
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }

}
