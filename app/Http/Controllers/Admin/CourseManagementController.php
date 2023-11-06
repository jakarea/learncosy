<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Checkout;
use App\Models\CourseReview;
use App\Models\Module;
use Illuminate\Support\Str;  
use App\Mail\CourseUpdated;
use Illuminate\Support\Facades\Mail;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF; 
use File;
use ZipArchive;
use Auth; 

class CourseManagementController extends Controller
{
    // course list
    public function index(){  

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : ''; 

        $courses = Course::with('user','reviews')->where('status','published');

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
                ->orderBy('avg_star', 'desc');
            }

            if ($status == 'most_purchased') {
                $courses = Course::leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
                ->select('courses.*')
                ->groupBy('courses.id')
                ->orderBy(\DB::raw('COUNT(checkouts.course_id)'), 'desc');

            }
            
            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc'); 
        }

        $courses = $courses->paginate(16);
 
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

        $totalModules = count($course->modules);
        $totalLessons = $course->modules->sum(function ($module) {
            return count($module->lessons);
        });

        if ($course) {
            return view('e-learning/course/admin/show', compact('course','course_reviews','relatedCourses','group_files','totalModules','totalLessons'));
        } else {
            return redirect('admin/courses')->with('error', 'Course not found!');
        }
    }


    public function fileDownload($course_id,$file_extension){
        $lesson_files = Lesson::where('course_id',$course_id)->select('lesson_file as file')->get();
        foreach($lesson_files as $lesson_file){
            if(!empty($lesson_file->file)){
                $file_name = $lesson_file->file;
                $file_arr = explode('.', $file_name); 
                $extension = $file_arr['1'];
                if($file_extension == $extension){
                    $files[] = public_path('uploads/lessons/'.$file_name);
               }
            }
        }

        $zip = new ZipArchive;
        $zipFileName = $file_extension.'_'.time().'.zip';
        $is_have_file = '';
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                if(file_exists($file)){
                    $zip->addFile($file, basename($file));
                }else{
                   $is_have_file = 'There are no files in your storage!!!!';
                   break;
                }
            }
            if(!empty($is_have_file)){ 
              return redirect('admin/courses')->with('error', $is_have_file);
            }
            $zip->close();

            // Set appropriate headers for the download
            header('Content-Type: application/zip');
            header("Content-Disposition: attachment; filename=" . $zipFileName);
            header('Content-Length: ' . filesize($zipFileName));
            header("Pragma: no-cache");
            header("Expires: 0");
            readfile($zipFileName);

            // Delete the zip file after download
            unlink($zipFileName);
            exit;
        } else {
            // Handle the case when the zip file could not be created
            echo 'Failed to create the zip file.';
        }
    } 

    public function cousreDownloadPDF($course_id){
        $lesson_files = Lesson::where('course_id',$course_id)->select('lesson_file as file')->get();
        foreach($lesson_files as $lesson_file){
            $file_name = $lesson_file->file;
            $file_arr = explode('.', $lesson_file->file);  
            $extention = $file_arr[1];
            if($extention == 'pdf'){
                $pdfFiles[] = $file_name;
           }
        }

        $zipFileName = 'PDF_'.time().'.zip';
        $zip = new ZipArchive;

        if ($zip->open(public_path('uploads/lessons/'.$zipFileName), ZipArchive::CREATE) === TRUE) {
            foreach ($pdfFiles as $file) {
                if (file_exists(public_path('uploads/lessons/'.$file))) {
                    $zip->addFile(public_path('uploads/lessons/'.$file), basename($file));
                }
            }
            $zip->close();
            return response()->download(public_path('uploads/lessons/'.$zipFileName))->deleteFileAfterSend(true);
        } else {
            // handle error here
        }
    }

    
 

    public function destroy($slug)
    {

        $course = Course::where('slug', $slug)->first();
        if ($course) {
            //delete thumbnail
            $oldThumbnail = public_path('/assets/images/courses/'.$course->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            }
            //delete banner
            $oldBanner = public_path('/assets/images/courses/'.$course->banner);
            if (file_exists($oldBanner)) {
                @unlink($oldBanner);
            }
            //delete certficate
            $oldCertificate = public_path('/assets/images/courses/'.$course->sample_certificates);
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
                    $lessonOldThumbnail = public_path('/assets/images/lessons/'.$lesson->thumbnail);
                    if (file_exists($lessonOldThumbnail)) {
                        @unlink($lessonOldThumbnail);
                    }
                    //delete lesson file
                    $lessonOldFile = public_path('/assets/images/lessons/'.$lesson->lesson_file);
                    if (file_exists($lessonOldFile)) {
                        @unlink($lessonOldFile);
                    }
                    
                    $lesson->delete();
                }
                $module->delete();
            }
            $course->delete();
            return redirect('admin/courses')->with('success', 'Course deleted!');
        } else {
            return redirect('admin/courses')->with('error', 'Course not found!');
        }
        
    }
}
