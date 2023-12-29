<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Checkout;
use App\Models\CourseReview;
use App\Models\BundleSelect;
use App\Models\CourseActivity;
use App\Models\Notification;
use App\Models\Cart;
use App\Models\Certificate;
use App\Models\course_like;
use App\Models\CourseLog;
use App\Models\BundleCourse;
use App\Models\Module;
use Illuminate\Support\Str;
use App\Mail\CourseUpdated;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use File;
use ZipArchive;
use Auth;
use DB;

class CourseManagementController extends Controller
{
    // course list
    public function index(){

        $queryParams = request()->except('page');

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $courses = Course::with('user','reviews');

        if ($title) {
            $courses->where(function ($query) use ($title) {
                $categories = explode(',', trim($title));
                foreach ($categories as $category) {
                    $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                }
            });
        }

        if ($status) {
            if ($status == 'oldest') {
                $courses->orderBy('id', 'asc');
            }

            if ($status == 'best_rated') {
                $courses = Course::leftJoin('course_reviews', 'courses.id', '=', 'course_reviews.course_id')
                ->select('courses.*', \DB::raw('COALESCE(AVG(course_reviews.star), 0) as avg_star'))
                ->groupBy('courses.id')
                ->orderBy('avg_star', 'desc');
            }

            if ($status == 'most_purchased') {

               $courses = Course::select('courses.id', 'courses.price', 'courses.offer_price', 'courses.user_id', 'courses.title', 'courses.categories', 'courses.thumbnail', 'courses.slug', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'))
                ->with('user')
                ->with('reviews')
                ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
                ->groupBy('courses.id')
                ->orderByDesc('sale_count');
            }

            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc');
        }

        $courses = $courses->paginate(16)->appends($queryParams);

        return view('e-learning/course/admin/list',compact('courses'));
    }

    // course show
    public function show($slug)
    {

        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();

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

        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();

        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where('user_id', $course->user_id)
            ->inRandomOrder()
            ->limit(3)
        ->get();

        $totalModules = $course->modules->where('status', 'published')->count();

        $totalLessons = $course->modules->sum(function ($module) {
            return $module->lessons->filter(function ($lesson) {
                return $lesson->status == 'published';
            })->count();
        });

        // last playing video
        $courseLog = CourseLog::where('course_id', $course->id)->where('user_id',auth()->user()->id)->first();
        $currentLessonVideo = NULL;

        if ($courseLog) {
            $lesson = Lesson::find($courseLog->lesson_id);
            if ($lesson) {
               $currentLessonVideo = str_replace("/videos/", "", $lesson->video_link);
            }
        }

        if ($course) {
            return view('e-learning/course/admin/show', compact('course','course_reviews','relatedCourses','group_files','totalModules','totalLessons','currentLessonVideo'));
        } else {
            return redirect('admin/courses')->with('error', 'Course not found!');
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

            $categoryArray = explode(',', $course->categories);

            $related_course = Course::where('instructor_id', $course->instructor_id)
                ->where(function ($query) use ($categoryArray) {
                    foreach ($categoryArray as $category) {
                        $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                    }
                })
                ->take(4)
                ->get();

            $Urlsubdomain = $course->user->subdomain;



            return view('e-learning/course/admin/overview', compact('course','promo_video_link','course_reviews','related_course','courseEnrolledNumber','Urlsubdomain'));
        } else {
            return redirect('admin/dashboard')->with('error', 'Course not found!');
        }
    }

    public function storeCourseLog(Request $request){

        $courseId = (int)$request->input('courseId');
        $lessonId = (int)$request->input('lessonId');
        $moduleId = (int)$request->input('moduleId');
        $userId = auth()->user()->id;

        $existingCourse = Course::find($courseId);
        $courseLog = CourseLog::where('course_id', $courseId)->where('user_id',$userId)->first();

        if(!$courseLog){
            $courseLogInfo = new CourseLog([
                'course_id' => $courseId,
                'instructor_id' => $existingCourse->user_id,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
            $courseLogInfo->save();
            return response()->json([
                'message' => 'course log save successfully',
                'course_id' => $courseId,
                'instructor_id' => $existingCourse->user_id,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
        }else{
            $courseLog->course_id = $courseId;
            $courseLog->instructor_id = $existingCourse->user_id;
            $courseLog->module_id = $moduleId;
            $courseLog->lesson_id = $lessonId;
            $courseLog->user_id = $userId;

            $courseLog->update();
            return response()->json([
                'message' => 'course log updated',
                'course_id' => $courseId,
                'module_id' => $moduleId,
                'lesson_id' => $lessonId,
                'user_id'   => $userId,
            ]);
        }

    }

    public function destroy($id)
    {
         // update bundle course for this course
         $selectedCourseValue = intval($id);

        $bundleSelected = BundleCourse::where(function ($query) use ($selectedCourseValue) {
                $query->where('selected_course', 'LIKE', $selectedCourseValue . ',%')
                    ->orWhere('selected_course', 'LIKE', '%,' . $selectedCourseValue . ',%')
                    ->orWhere('selected_course', 'LIKE', '%,' . $selectedCourseValue);
        })->get();

        foreach ($bundleSelected as $record) {
            $updatedSelectedCourse = str_replace($selectedCourseValue . ',', '', $record->selected_course);
            $updatedSelectedCourse = str_replace(',' . $selectedCourseValue, '', $updatedSelectedCourse);
            $updatedSelectedCourse = str_replace($selectedCourseValue, '', $updatedSelectedCourse);
            $record->selected_course = $updatedSelectedCourse;
            $record->save();
        }

        // delete bundleselected for this course
        $bundleSelection = BundleSelect::where(['course_id'=> $selectedCourseValue])->first();
        if ($bundleSelection) {
            $bundleSelection->delete();
        }

        // update cart
        $cartSelects = Cart::where(['course_id'=> $selectedCourseValue])->first();
        if ($cartSelects) {
            foreach ($cartSelects as $cartSelect) {
                $cartSelect->delete();
            }
        }

        // certificate delete
        $certificate = Certificate::where(['course_id'=> $selectedCourseValue])->first();
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
        $totalCheckout = Checkout::where(['course_id'=> $selectedCourseValue])->get();
        if ($totalCheckout) {
            foreach ($totalCheckout as $checkout) {
                $checkout->status = 'deleted';
                $checkout->save();
            }
        }

        // course activities
        $totalActivity = CourseActivity::where(['course_id'=> $selectedCourseValue])->get();
        if ($totalActivity) {
            foreach ($totalActivity as $activity) {
                $activity->delete();
            }
        }

        // course likes
        $course_likes = course_like::where(['course_id'=> $selectedCourseValue])->get();
        if ($course_likes) {
            foreach ($course_likes as $course_liked) {
                $course_liked->delete();
            }
        }

        // course Log
        $course_logs = CourseLog::where(['course_id'=> $selectedCourseValue])->get();
        if ($course_logs) {
            foreach ($course_logs as $course_log) {
                $course_log->delete();
            }
        }

        // course review
        $course_reviews = CourseReview::where(['course_id'=> $selectedCourseValue])->get();
        if ($course_reviews) {
            foreach ($course_reviews as $course_review) {
                $course_review->delete();
            }
        }

        // course users
        $course_useres = DB::table('course_user')->where(['course_id'=> $selectedCourseValue])->get();
        if ($course_useres) {
            foreach ($course_useres as $course_usere) {
                DB::table('course_user')
                ->where('id', $course_usere->id)
                ->delete();
            }
        }


        // delete notification for this course
        $course_notifications = Notification::where(['course_id'=> $selectedCourseValue])->get();
        if ($course_notifications) {
            foreach ($course_notifications as $course_notification) {
                $course_notification->delete();
            }
        }

        // delete main course
        $course = Course::where(['id'=> $selectedCourseValue])->first();

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
            return redirect('admin/courses')->with('success', 'Course deleted Successfully!');
        } else {
            return redirect('admin/courses')->with('error', 'Course not found!');
        }

    }
}
