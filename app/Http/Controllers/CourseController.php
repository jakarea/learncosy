<?php

namespace App\Http\Controllers;

use Auth;
use File;
use DataTables;
use DB;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Checkout;
use App\Models\CourseReview;
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
                $courses = Course::leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
                ->select('courses.*')
                ->groupBy('courses.id')
                ->where('courses.user_id', Auth::user()->id)
                ->orderBy(\DB::raw('COUNT(checkouts.course_id)'), 'desc');

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

    public function destroy($id)
    {
        $course = Course::where(['id'=> $id,'user_id' => Auth::user()->id])->first();
        if ($course) {
            //delete thumbnail
            $oldThumbnail = public_path($course->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            }
            //delete banner
            $oldBanner = public_path($course->banner);
            if (file_exists($oldBanner)) {
                @unlink($oldBanner);
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
            return redirect('instructor/courses')->with('success', 'Course deleted!');
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }

}
