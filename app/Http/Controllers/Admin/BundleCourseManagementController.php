<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\BundleCourse;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;

class BundleCourseManagementController extends Controller
{
    // course bundle list
    public function index()
     {   

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $bundleCourses = BundleCourse::with('courses.checkouts');

        if ($title) {
            $bundleCourses->where('title', 'like', '%' . trim($title) . '%');
        }

        if ($status) {
            if ($status == 'oldest') {
                $bundleCourses->orderBy('id', 'asc');
            } elseif ($status == 'best_rated') {
                $bundleCourses->select('bundle_courses.*')
                    ->selectRaw('SUM(course_reviews.star) as total_star')
                    ->leftJoin('course_reviews', function ($join) {
                        $join->on('course_reviews.course_id', '=', DB::raw("FIND_IN_SET(course_reviews.course_id, bundle_courses.selected_course)"));
                    })
                    ->groupBy('bundle_courses.id')
                    ->orderBy('total_star', 'desc');
            } elseif ($status == 'most_purchased') {

                $bundleCourses->select('bundle_courses.*')
                ->selectRaw('COUNT(checkouts.course_id) as course_count')
                ->leftJoin('checkouts', function ($join) {
                    $join->on('checkouts.course_id', '=', DB::raw("FIND_IN_SET(checkouts.course_id, bundle_courses.selected_course)"));
                })
                ->groupBy('bundle_courses.id')
                ->orderBy('course_count', 'desc');


            } elseif ($status == 'newest') {
                $bundleCourses->orderBy('id', 'desc');
            }
        } else {
            $bundleCourses->orderBy('id', 'desc');
        }

        $bundleCourses = $bundleCourses->paginate(12);

        return view('bundle/admin/list', compact('bundleCourses')); 
     }

     public function view($bundleSlug)
     {
        if (!$bundleSlug) {
            return redirect('admin/bundle/courses')->with('warning','No Bundle Found!'); 
        }  

        $updatingCourse = BundleCourse::where('slug', $bundleSlug)->first();
        $courseIds = explode(',', $updatingCourse->selected_course);
        $bundleSelected = Course::whereIn('id', $courseIds)->get();
        $selectedCourses = count($bundleSelected);

        return view('bundle/admin/view',compact('updatingCourse','bundleSelected','selectedCourses')); 
     }

    //  bundle edit
     public function edit1($bundleSlug)
     {
        // return $bundleSlug;

        $bundleCourse = BundleCourse::where('slug',$bundleSlug)->first();

        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $courses = Course::where('user_id',$bundleCourse->instructor_id);

        if ($title) {
            $courses->where('title', 'like', '%' . trim($title) . '%');
        }

        if ($status) {
            if ($status == 'oldest') {
                $courses->orderBy('id', 'asc');
            }
            
            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc'); 
        }

       $courses = $courses->paginate(12); 
 
        $courseIds = explode(',', $bundleCourse->selected_course);
 
        $bundleSelected = Course::whereIn('id', $courseIds)
        ->with('reviews')
        ->get();

        session()->put('bundleSelected', $bundleSelected);
 
        if (!$bundleSelected->isEmpty()) {
            return view('bundle/instructor/edit1',compact('courses','bundleCourse')); 
        } else {
            return redirect('admin/bundle/courses')->with('error','No Bundle Found!');
        }
        
     }

    public function delete($bundleId)
     {   
         $bundleCourse = BundleCourse::where('id', $bundleId)->first();
         
        if ($bundleCourse) { 
            $oldThumbnail = public_path($bundleCourse->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            } 
            $bundleCourse->delete();
            return redirect('admin/bundle/courses')->with('success', 'Bundle Course deleted successfully!');
        } else {
            return redirect('admin/courses')->with('error', 'Bundle Course not found!');
        }
     }
}
