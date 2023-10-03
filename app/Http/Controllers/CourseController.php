<?php

namespace App\Http\Controllers;

use Auth;
use File;
use DataTables;
use DB;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Support\Str;
use App\Models\CourseReview;
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
            
            if ($status == 'newest') {
                $courses->orderBy('id', 'desc');
            }
        }else{
            $courses->orderBy('id', 'desc'); 
        }

        $courses = $courses->paginate(12);

        return view('e-learning/course/instructor/list',compact('courses'));
    }

    // course create
    public function create()
    {   
        $unique_array = [];
        $courses = Course::all();
        $mainCategories = $courses->pluck('categories'); 

        foreach($mainCategories as $category){ 
            $cats = explode(",", $category);
            foreach($cats as $cat){
               $unique_array[] = strtolower($cat);
            }
        }

        $categories = array_unique($unique_array);

        // if user has useraname then redirect to course create page
        $subdomain = Auth::user()->subdomain;
        if ($subdomain) {
            return view('e-learning/course/instructor/create',compact('categories'));
        }else{
            return redirect('instructor/profile/edit')->with('error', 'You have to set the Subdomain First!');
        }

    }

    // course store
    public function store(Request $request)
    {  
        // return $request->all();

        $vimeoFData = DB::table('vimeo_data')->where('user_id', Auth::user()->id)->first();

        // if vimeo data is not set then redirect to vimeo setting page
        if (!$vimeoFData) {
            return redirect('instructor/settings/vimeo')->with('error', 'You have to set the Vimeo Setting First!');
        }
 
        $request->validate([
            'title' => 'required',
            'features' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'sample_certificates' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
        ],
        [
            'thumbnail.required' => 'You have to choose the file!',
            'thumbnail' => 'Max file size is 5 MB!',
            'banner' => 'Max file size is 5 MB!',
            'sample_certificates' => 'Max file size is 5 MB!'
        ]);

        $user_id = Auth::user()->id;

        //save course
        $course = new Course([
            'title' => $request->title,
            'user_id' => $user_id,
            'sub_title' => $request->sub_title,
            'slug' => Str::slug($request->title),
            'features' => is_array($request->features) ? implode(",",$request->features) : $request->features,
            'prerequisites' => $request->prerequisites,
            'outcome' => $request->outcome,
            'promo_video' => $request->promo_video,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'categories' => is_array($request->categories) ? implode(",",$request->categories) : $request->categories,
            'short_description' => $request->short_description, 
            'description' => $request->description, 
            'meta_keyword' => is_array($request->meta_keyword) ? implode(",",$request->meta_keyword) : $request->meta_keyword,
            'meta_description' => $request->meta_description, 
            'number_of_module' => $request->number_of_module, 
            'number_of_lesson' => $request->number_of_lesson,  
            'number_of_attachment' => $request->number_of_attachment, 
            'number_of_video' => $request->number_of_video, 
            'duration' => $request->duration,
            'hascertificate' => $request->hascertificate,
            'subscription_status' => $request->subscription_status, 
            'status' => $request->status,
        ]);  
        
        
        $course->slug = $course->slug . '-';
         //if thumbnail is valid then save it
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = $course->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $course->thumbnail = $name;
        } 

        //if banner is valid then save it
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name2 = $course->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name2);
            $course->banner = $name2;
        }

        //if sample_certificates is valid then save it
        if ($request->hasFile('sample_certificates')) {
            $image = $request->file('sample_certificates');
            $name3 = $course->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name3);
            $course->sample_certificates = $name3;
        }
        
        $course->save();
        return redirect('instructor/courses')->with('success', 'Course saved!');
    }

    // course show
    public function show($id)
    {   
        $course = Course::where('id', $id)->with('modules.lessons','user')->first();
        $relatedCourses = Course::where('id', '!=', $id)
            ->where('user_id', Auth::user()->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();

        if ($course) {
            return view('e-learning/course/instructor/show', compact('course','course_reviews','relatedCourses'));
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }

    // course edit
    public function edit($slug)
    {   
        $course = Course::where('slug', $slug)->first();
        
        $unique_array = [];
        $courses = Course::all();
        $mainCategories = $courses->pluck('categories'); 

        foreach($mainCategories as $category){ 
            $cats = explode(",", $category);
            foreach($cats as $cat){
               $unique_array[] = strtolower($cat);
            }
        }

        $categories = array_unique($unique_array);
       
        if ($course) {
            return view('e-learning/course/instructor/edit', compact('course','categories'));
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        } 
    }

    // course update
    public function update(Request $request, $slug)
    {   
          // return $request->all();

          $request->validate([
            'title' => 'required',
            'features' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'sample_certificates' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
        ],
        [ 
            'thumbnail' => 'Max file size is 5 MB!',
            'banner' => 'Max file size is 5 MB!',
            'sample_certificates' => 'Max file size is 5 MB!'
        ]);

        $course = Course::where('slug', $slug)->first();
        $course->title = $request->title;
        $course->sub_title = $request->sub_title;
        $course->features = is_array($request->features) ? implode(",",$request->features) : $request->features;
        $course->slug = Str::slug($request->title);
        $course->prerequisites = $request->prerequisites;
        $course->outcome = $request->outcome;
        $course->promo_video = $request->promo_video;
        $course->offer_price = $request->offer_price;
        $course->categories = is_array($request->categories) ? implode(",",$request->categories) : $request->categories; 
        $course->short_description = $request->short_description;
        $course->description = $request->description;
        $course->meta_keyword = is_array($request->meta_keyword) ? implode(",",$request->meta_keyword) : $request->meta_keyword;
        $course->meta_description = $request->meta_description;
        $course->number_of_module = $request->number_of_module;
        $course->number_of_lesson = $request->number_of_lesson; 
        $course->number_of_attachment = $request->number_of_attachment;
        $course->number_of_video = $request->number_of_video;
        $course->duration = $request->duration;
        $course->hascertificate = $request->hascertificate; 
        $course->subscription_status = $request->subscription_status;
        $course->status = $request->status;
        $course->save();


        if ($request->hasFile('thumbnail')) { 
             // Delete old file
             if ($course->thumbnail) {
                $oldFile = public_path('/assets/images/courses/'.$course->thumbnail);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('thumbnail');
            $name = $course->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $course->thumbnail = $name; 
        } 

        if ($request->hasFile('sample_certificates')) { 
             // Delete old file
             if ($course->sample_certificates) {
                $oldFile = public_path('/assets/images/courses/'.$course->sample_certificates);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('sample_certificates');
            $name = $course->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $course->sample_certificates = $name; 
        }

        $course->save();

        // Send email
        // Mail::to('email-here')->send(new CourseUpdated($course));
        // students email who are enrolled with this course

        return redirect('instructor/courses')->with('success', 'Course Updated!');
    }

    public function destroy($id)
    {
        $course = Course::where(['id'=> $id,'user_id' => Auth::user()->id])->first();
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
            return redirect('instructor/courses')->with('success', 'Course deleted!');
        } else {
            return redirect('instructor/courses')->with('error', 'Course not found!');
        }
    }

}
