<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // course list
    public function index()
    {  
        return view('course/instructor/index'); 
    }

    // course create
    public function create()
    {  
        return view('course/instructor/create'); 
    }

    // course store
    public function store(Request $request)
    {  
        // return $request->all();
 
        $request->validate([
            'title' => 'required',
            'features' => 'required',
            'price' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', 
        ]);

        //save course
        $course = new Course([
            'title' => $request->title,
            'sub_title' => $request->title,
            'slug' => Str::slug($request->title),
            'features' => implode(",",$request->features),
            'prerequisites' => $request->prerequisites,
            'outcome' => $request->outcome,
            'promo_video' => $request->promo_video,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'categories' => implode(",",$request->categories),
            'short_description' => $request->short_description, 
            'description' => $request->description, 
            'meta_keyword' => implode(",",$request->meta_keyword),
            'meta_description' => $request->meta_description, 
            'number_of_module' => $request->number_of_module, 
            'number_of_lesson' => $request->number_of_lesson, 
            'number_of_quiz' => $request->number_of_quiz, 
            'number_of_attachment' => $request->number_of_attachment, 
            'number_of_video' => $request->number_of_video, 
            'duration' => $request->duration,
            'hascertificate' => $request->hascertificate,
            'subscription_status' => $request->subscription_status, 
            'status' => $request->status,
        ]); 
        $course->save();

        $course->slug = $course->slug . '-' . $course->id;
         //if thumbnail is valid then save it
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = $course->slug.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
        }
        $course->thumbnail = $name;

        //if banner is valid then save it
        if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = $course->slug.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
        }
        $course->banner = $name;

        //if sample_certificates is valid then save it
        if ($request->hasFile('sample_certificates')) {
            $image = $request->file('sample_certificates');
            $name = $course->slug.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
        }
        $course->sample_certificates = $name;

        $course->save();
        return redirect('instructor.courses')->with('success', 'Course saved!');
    }

    // course create
    public function show()
    {   
        return view('course/instructor/show'); 
    }

}
