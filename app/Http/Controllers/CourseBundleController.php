<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\BundleCourse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class CourseBundleController extends Controller
{
     // course bundle list
     public function index()
     {  
        $userId = Auth::user()->id;
        $bundleCourses = BundleCourse::where('user_id', $userId)->paginate(12);
         return view('bundle/instructor/list',compact('bundleCourses')); 
     }
 
     // course bundle create
     public function create()
     {  
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get();
        return view('bundle/instructor/create',compact('courses')); 
     }

     public function step1()
     {
        $userId = Auth::user()->id;
        $bundleCourses = BundleCourse::where('user_id', $userId)->paginate(12);

        return view('bundle/instructor/step-1',compact('bundleCourses')); 
     }
     public function step2()
     {
        $userId = Auth::user()->id;
        $bundleCourses = BundleCourse::where('user_id', $userId)->paginate(12);

        return view('bundle/instructor/step-2',compact('bundleCourses')); 
     }

     // course bundle store
    public function store(Request $request)
    {  
        // return $request->all();
 
        $request->validate([
            'title' => 'required',
            'selected_course' => 'required',
            'price' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
        ]);

        $userId = Auth::user()->id;

        //save bundle course
        $bundleCourse = new BundleCourse([
            'user_id' => $userId, 
            'title' => $request->title, 
            'slug' => Str::slug($request->title),
            'selected_course' => is_array($request->selected_course) ? implode(",",$request->selected_course) : $request->selected_course,
            'price' => $request->price,
            'subscription_status' => $request->subscription_status,
            'short_description' => $request->short_description, 
            'status' => $request->status,
        ]);  
 
        
        $bundleCourse->slug = $bundleCourse->slug . '-';
         //if thumbnail is valid then save it
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $bundleCourse->thumbnail = $name;
        } 

        //if banner is valid then save it
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name2 = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name2);
            $bundleCourse->banner = $name2;
        }
         
        $bundleCourse->save();
        return redirect('instructor/bundle/courses')->with('success', 'Bundle Course saved!');
    }

    // course bundle show
    public function show($slug)
    {    
        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        $slectedCourses = explode(",",$bundleCourse->selected_course);
        $courses = Course::whereIn('id', $slectedCourses)->get();
        if ($bundleCourse) {
            return view('bundle/instructor/show', compact('bundleCourse', 'courses'));
        } else {
            return redirect('instructor/bundle/courses')->with('error', 'Course not found!');
        }
    }
    // course bundle edit
    public function edit($slug)
    {   
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get();
        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        if ($bundleCourse) {
            return view('bundle/instructor/edit', compact('bundleCourse','courses'));
        } else {
            return redirect('instructor/bundle/courses')->with('error', 'Course not found!');
        } 
    }

    // course update
    public function update(Request $request, $slug)
    {   
        //   return $request->all();

          $request->validate([
            'title' => 'required',
            'selected_course' => 'required',
            'price' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
        ]);

        $userId = Auth::user()->id;

        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        $bundleCourse->user_id = $userId; 
        $bundleCourse->title = $request->title; 
        $bundleCourse->slug = Str::slug($request->title);
        $bundleCourse->selected_course = is_array($request->selected_course) ? implode(",",$request->selected_course) : $request->selected_course;
        $bundleCourse->price = $request->price;
        $bundleCourse->subscription_status = $request->subscription_status;
        $bundleCourse->short_description = $request->short_description;  
        $bundleCourse->status = $request->status;
        $bundleCourse->save();

        if ($request->hasFile('thumbnail')) { 
             // Delete old file
             if ($bundleCourse->thumbnail) {
                $oldFile = public_path('/assets/images/courses/'.$bundleCourse->thumbnail);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('thumbnail');
            $name = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $bundleCourse->thumbnail = $name; 
        }

        if ($request->hasFile('banner')) { 
             // Delete old file
             if ($bundleCourse->banner) {
                $oldFile = public_path('/assets/images/courses/'.$bundleCourse->banner);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('banner');
            $name = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $bundleCourse->banner = $name; 
        } 

        $bundleCourse->save();

        return redirect('instructor/bundle/courses')->with('success', 'Bundle Course Updated!');
    }

    public function destroy($slug)
    {
        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        if ($bundleCourse) {
            //delete thumbnail
            $oldThumbnail = public_path('/assets/images/courses/'.$bundleCourse->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            }
            //delete banner
            $oldBanner = public_path('/assets/images/courses/'.$bundleCourse->banner);
            if (file_exists($oldBanner)) {
                @unlink($oldBanner);
            }
            $bundleCourse->delete();
            return redirect('instructor/bundle/courses')->with('success', 'Bundle Course deleted!');
        } else {
            return redirect('instructor/courses')->with('error', 'Bundle Course not found!');
        }
    }
}
