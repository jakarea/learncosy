<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\BundleCourse;
use Illuminate\Support\Str; 
use DataTables;
use Auth;

class BundleCourseManagementController extends Controller
{
    // course bundle list
    public function index()
     {   
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $bundleCourses = BundleCourse::query();

        if ($title) {
            $bundleCourses->where('title', 'like', '%' . trim($title) . '%');
        }

        if ($status) {
            if ($status == 'oldest') {
                $bundleCourses->orderBy('id', 'asc');
            }
            
            if ($status == 'newest') {
                $bundleCourses->orderBy('id', 'desc');
            }
        }else{
            $bundleCourses->orderBy('id', 'desc'); 
        }

        $bundleCourses = $bundleCourses->paginate(12);
 
         return view('bundle/admin/list',compact('bundleCourses')); 
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
