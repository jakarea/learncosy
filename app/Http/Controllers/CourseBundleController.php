<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\BundleCourse;
use App\Models\BundleSelect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Auth;

class CourseBundleController extends Controller
{
     // course bundle list
     public function index()
     {
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $bundleCourses = BundleCourse::where('instructor_id', Auth::user()->id);

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

         return view('bundle/instructor/list',compact('bundleCourses'));
     }

     public function view($domain, $bundleSlug)
     {

        if (!$bundleSlug) {
            return redirect('instructor/bundle/courses')->with('warning','No Bundle Found!');
        }

        $updatingCourse = BundleCourse::where('slug', $bundleSlug)->first();
        $courseIds = explode(',', $updatingCourse->selected_course);
        $bundleSelected = Course::whereIn('id', $courseIds)->where('user_id', Auth::user()->id)->get();
        $selectedCourses = count($bundleSelected);

        return view('bundle/instructor/view',compact('updatingCourse','bundleSelected','selectedCourses'));
     }

     public function step1()
     {
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $courses = Course::where('user_id', Auth::user()->id);
        $bundleSelected = BundleSelect::where('instructor_id', Auth::user()->id)->get();

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

        return view('bundle/instructor/step-1',compact('courses','bundleSelected'));
     }

     public function selectBundle($domain, $course_id)
     {
        $userId = Auth::user()->id;
        $course = Course::where('id',$course_id)->firstOrFail();

        $bundleSelect = BundleSelect::firstOrNew([
            'instructor_id' => $userId,
            'course_id' => $course->id,
        ]);

        if ($bundleSelect->exists) {
            return redirect('instructor/bundle/courses/select')->with('warning','Course has already been included in the bundle.');
        }

        $bundleSelect->title = $course->title;
        $bundleSelect->slug = $course->slug;
        $bundleSelect->price = $course->price;
        $bundleSelect->offer_price = $course->offer_price;
        $bundleSelect->price = $course->price;
        $bundleSelect->short_description = $course->short_description;
        $bundleSelect->thumbnail = $course->thumbnail;
        $bundleSelect->save();

        return response()->json(['message' => 'DONE']);

     }

     public function step2()
     {
        $userId = Auth::user()->id;
        $bundleSelected = BundleSelect::where('instructor_id', Auth::user()->id)->with('reviews')->get();

        $selectedCourses = count($bundleSelected);

        if ( $selectedCourses < 1) {
            return redirect('instructor/bundle/courses/select')->with('warning','Please select a minimum of two courses to create a bundle');
        }

        return view('bundle/instructor/step-2',compact('bundleSelected','selectedCourses'));
     }

     public function createBundle(Request $request)
     {
       $userId = Auth::user()->id;
       $totalSelected = BundleSelect::where('instructor_id',$userId)->count();

       if ($totalSelected < 2) {
            return redirect('instructor/bundle/courses/select')->with('warning','Please select a minimum of two courses to create a bundle');
       }

        $request->validate([
            'title' => 'required',
            'selected_course' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000'
        ],
        [
            'thumbnail' => 'Max file size is 5 MB!'
        ]);

        $bundleCourse = new BundleCourse([
            'instructor_id' => $userId,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slug' => Str::slug($request->title),
            'selected_course' => $request->selected_course,
            'regular_price' => $request->regular_price,
            'sales_price' => $request->sales_price,
            'description' => $request->description
        ]);

        $insSlug = Str::slug(Auth::user()->name);

        if ($request->hasFile('thumbnail')) {
            if ($bundleCourse->thumbnail) {
               $oldFile = public_path($bundleCourse->thumbnail);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('thumbnail');
            $image = Image::make($file);
            $image->encode('jpg', 40);
            $uniqueFileName = $insSlug . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/bundle-courses/') . $uniqueFileName);
            $image_path = 'uploads/bundle-courses/' . $uniqueFileName;
           $bundleCourse->thumbnail = $image_path;
       }

        $bundleCourse->save();

        // delete selected course from select table, after bundle creation
        if ($bundleCourse->save()) {
            BundleSelect::where('instructor_id',$userId)->delete();
        }

        return redirect('instructor/bundle/courses')->with('success','Bundle Created Successfully');
     }

     public function edit1($subdomain, $bundleSlug)
     {

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

            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc');
        }

        $courses = $courses->paginate(12);

        $bundleCourse = BundleCourse::where('instructor_id', Auth::user()->id)
        ->where('slug', $bundleSlug)
        ->firstOrFail();

        $courseIds = explode(',', $bundleCourse->selected_course);

        $bundleSelected = Course::whereIn('id', $courseIds)
        ->where('user_id', Auth::user()->id)
        ->with('reviews')
        ->get();

        session()->put('bundleSelected', $bundleSelected);

        if (!$bundleSelected->isEmpty()) {
            return view('bundle/instructor/edit1',compact('courses','bundleCourse'));
        } else {
            return redirect('instructor/bundle/courses')->with('error','No Bundle Found!');
        }

     }

     public function update1($subdomain,$courseId)
     {

        $bundleSelected = session()->has('bundleSelected') ? session('bundleSelected') : [];

        $newBundleSelected = Course::where('id', $courseId)
            ->where('user_id', Auth::user()->id)
            ->with('reviews')
            ->firstOrFail();

        $bundleSelected[] = $newBundleSelected;

        session()->put('bundleSelected', $bundleSelected);

        return response()->json(['message' => 'DONE']);
     }

     public function edit2($subdomain,$bundleSlug)
     {

       $bundleCourse = BundleCourse::where('instructor_id', Auth::user()->id)
        ->where('slug', $bundleSlug)
        ->firstOrFail();

        if ($bundleCourse) {
            return view('bundle/instructor/edit2',compact('bundleCourse'));
        } else {
            return redirect('instructor/bundle/courses')->with('error','No Bundle Found!');
        }

     }

     public function update2(Request $request,$subdomain, $courseSlug){

        // return $request->all();

        $userId = Auth::user()->id;

        $this->validate($request, [
            'title' => 'required|string',
            'sub_title' => 'string',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [
            'thumbnail' => 'Max file size is 5 MB!'
        ]);

        $bundleCourse = BundleCourse::where('slug', $courseSlug)->where('instructor_id',$userId)->firstOrFail();
        $bundleCourse->title = $request->title;
        $bundleCourse->slug = Str::slug($request->title);
        $bundleCourse->sub_title = $request->sub_title;
        $bundleCourse->selected_course = $request->selected_course;
        $bundleCourse->regular_price = $request->regular_price;
        $bundleCourse->sales_price = $request->sales_price;
        $bundleCourse->description = $request->description;
        $bundleCourse->instructor_id = $userId;
        $bundleCourse->save();

        $slugg = Str::slug(Auth::user()->name);

        if ($request->hasFile('thumbnail')) {
            if ($bundleCourse->thumbnail) {
               $oldFile = public_path($bundleCourse->thumbnail);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('thumbnail');
            $image = Image::make($file);
            $uniqueFileName = $slugg . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/bundle-courses/') . $uniqueFileName);
            $image_path = 'uploads/bundle-courses/' . $uniqueFileName;
           $bundleCourse->thumbnail = $image_path;
       }

        $bundleCourse->save();

        if ($bundleCourse->save()) {
            Session::forget('bundleSelected');
        }

        return redirect('instructor/bundle/courses')->with('success', 'Bundle has been updated successfully!');

     }

     public function removeSelectNew($courseId){

        $courseIdToRemove = $courseId;
        $bundleSelected = session()->has('bundleSelected') ? session('bundleSelected') : [];
        $updatedBundleSelected = collect($bundleSelected)->filter(function ($item) use ($courseIdToRemove) {
            return $item->id != $courseIdToRemove;
        })->values()->all();

        session(['bundleSelected' => $updatedBundleSelected]);

        return response()->json(['message' => 'DONE']);

     }

     public function removeSelect($domain, $course_id)
     {
        $selectedBundle = BundleSelect::where('course_id',$course_id)->firstOrFail();
        $selectedBundle->delete();
        return response()->json(['message' => 'DONE']);
     }

     public function delete($subdomain,$bundleId)
     {
         $bundleCourse = BundleCourse::where('id', $bundleId)->first();
        if ($bundleCourse) {
            $oldThumbnail = public_path($bundleCourse->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            }
            $bundleCourse->delete();
            return redirect('instructor/bundle/courses')->with('success', 'Bundle Course deleted successfully!');
        } else {
            return redirect('instructor/courses')->with('error', 'Bundle Course not found!');
        }
     }
}
