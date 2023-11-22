<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\BundleCourse;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
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
 
        $adminBundleSelected = Course::whereIn('id', $courseIds)
        ->with('reviews')
        ->get();

        session()->put('adminBundleSelected', $adminBundleSelected);
 
        if (!$adminBundleSelected->isEmpty()) {
            return view('bundle/admin/edit1',compact('courses','bundleCourse')); 
        } else {
            return redirect('admin/bundle/courses')->with('error','No Bundle Found!');
        }
        
     }

     public function update1($courseId)
     {

        $adminBundleSelected = session()->has('adminBundleSelected') ? session('adminBundleSelected') : [];
 
        $newBundleSelected = Course::where('id', $courseId)
            ->with('reviews')
            ->firstOrFail();
    
        $adminBundleSelected[] = $newBundleSelected;
    
        session()->put('adminBundleSelected', $adminBundleSelected);
 
        return response()->json(['message' => 'DONE']); 
     }

     public function edit2($bundleSlug)
     { 

      $bundleCourse = BundleCourse::where('slug', $bundleSlug)
        ->firstOrFail();

        if ($bundleCourse) {
            return view('bundle/admin/edit2',compact('bundleCourse')); 
        } else {
            return redirect('admin/bundle/courses')->with('error','No Bundle Found!');
        }

     }

     public function update2(Request $request, $courseId)
     {
 
        $this->validate($request, [
            'title' => 'required|string',
            'sub_title' => 'string', 
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [
            'thumbnail' => 'Max file size is 5 MB!'
        ]);

        $bundleCourse = BundleCourse::where('id', $courseId)->firstOrFail();
        $bundleCourse->title = $request->title;  
        $bundleCourse->slug = Str::slug($request->title);
        $bundleCourse->sub_title = $request->sub_title;  
        $bundleCourse->selected_course = $request->selected_course;  
        $bundleCourse->regular_price = $request->regular_price;  
        $bundleCourse->sales_price = $request->sales_price;  
        $bundleCourse->description = $request->description;   
        $bundleCourse->save(); 

        if ($request->hasFile('thumbnail')) { 
            if ($bundleCourse->thumbnail) {
               $oldFile = public_path($bundleCourse->thumbnail);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('thumbnail');
            $image = Image::make($file);
            $uniqueFileName = $bundleCourse->slug . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/bundle-courses/') . $uniqueFileName);
            $image_path = 'uploads/bundle-courses/' . $uniqueFileName;
           $bundleCourse->thumbnail = $image_path;
       }
       
        $bundleCourse->save(); 

        if ($bundleCourse->save()) {
            Session::forget('adminBundleSelected');
        }

        return redirect('admin/bundle/courses')->with('success', 'Bundle has been updated successfully!');
        
     }

     public function removeSelectNew($courseId){
 
        $courseIdToRemove = $courseId;
        $adminBundleSelected = session()->has('adminBundleSelected') ? session('adminBundleSelected') : [];
        $updatedBundleSelected = collect($adminBundleSelected)->filter(function ($item) use ($courseIdToRemove) {
            return $item->id != $courseIdToRemove;
        })->values()->all();
     
        session(['adminBundleSelected' => $updatedBundleSelected]);
 
        return response()->json(['message' => 'DONE']); 

     }

     public function removeSelect($course_id)
     {  
        $selectedBundle = BundleSelect::where('course_id',$course_id)->firstOrFail();
        $selectedBundle->delete();
        return response()->json(['message' => 'DONE']);
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
