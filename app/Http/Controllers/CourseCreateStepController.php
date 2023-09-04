<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CourseCreateStepController extends Controller
{
    public function step1(){
        return view('e-learning/course/instructor/create/step-1');
    }

    public function step1c(Request $request){
        $request->validate([
            'title' => 'required',
        ]);

        $title = $request->input('title');
        $auto_complete = $request->input('auto_complete');
        $slug = $request->input('slug');
        $slug = $slug ? Str::slug($slug) : Str::slug($title);
        $originalSlug = $slug;
        $counter = 2;
        $short_description = $request->input('short_description');
        // Check for unique slug
        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $course = new Course([
            'user_id' => Auth::user()->id,
            'title' => $title,
            'slug' => $slug,
            'short_description' => $short_description,
            'auto_complete' => $auto_complete
            // Other course attributes
        ]);

        $course->save();
        $id = $course->id;
        session()->put('lastInsertedId', $id);
        return redirect('instructor/courses/create/step-2')->with('success', 'Course created successfully');
    }

    public function step2(){
        $lastInsertedId = session()->get('lastInsertedId');
        if(!$lastInsertedId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-2',['lastInsertedId' => $lastInsertedId]);
    }

    public function step2c(Request $request){
        $lastInsertedId = session()->get('lastInsertedId');
        $course = Course::where('id', $lastInsertedId)->firstOrFail();
        $request->validate([
            'thumbnail' => 'nullable|file|mimes:jpeg,png,pdf|max:5121', // Example mime types and maximum size
            'description' => 'required|string',
        ]);
    
        // Handle file upload
        // if ($request->hasFile('thumbnail')) {
        //     $file = $request->file('thumbnail');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads'), $filename);
        // }

        $image_path = 'public/assets/images/courses/thumbnail.png';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
    
            // Convert image to WebP using Intervention Image
            $image = Image::make($file);
            $image->encode('webp', 90); // Convert to WebP with 90% quality
            
            $image_path = 'public/assets/images/courses/'.$course->slug . '.webp';

            $image->save(public_path('assets/images/courses/') . $course->slug . '.webp');
        }

        // Store other form data
        $description = $request->input('description');
        $course->short_description = $description;
        $course->thumbnail = $image_path;
        $course->save();
        return redirect('instructor/courses/create/step-3')->with('success', 'Data has been saved successfully');
    }

    public function step3(){
        $lastInsertedId = session()->get('lastInsertedId');
        $lastInsertedId = session()->get('lastInsertedId');
        $lastModuledId = session()->get('lastModuledId');
        $lastLessonId = session()->get('lastLessonId');
        if(!$lastInsertedId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-6');
    }

    public function step3c(Request $request){
        $lastInsertedId = session()->get('lastInsertedId');
        $lastModuledId = session()->get('lastModuledId') ? session()->get('lastModuledId') : '';

        if(!$lastInsertedId){
            return redirect('instructor/courses');
        }

        $request->validate([
            'module_name' => 'required',
            // 'is_module' => 'required'
        ]);

        if($request->is_module){
            $module = new Module();
            $module->title = $request->input('module_name');
            $module->slug = Str::slug($request->input('module_name'));
            $module->course_id = $lastInsertedId;
            $module->user_id = Auth::user()->id;
            $module->save();

            session()->put('lastModuledId', $module->id);
        }

        if($lastModuledId && !$request->is_module){
            $lesson = new Lesson();
            $lesson->course_id = $lastInsertedId;
            $lesson->user_id = Auth::user()->id;
            $lesson->module_id = $lastModuledId;
            $lesson->title = $request->input('module_name');
            $lesson->slug = Str::slug($request->input('module_name'));
            $lesson->save();

            session()->put('lastLessonId', $lesson->id);
        }
        
        return redirect('instructor/courses/create/step-3');
    }

    public function step4(){
        $lastInsertedId = session()->get('lastInsertedId');
        $lastModuledId = session()->get('lastModuledId');
        $lastLessonId = session()->get('lastLessonId');

        if(!$lastInsertedId || !$lastModuledId || !$lastLessonId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-4');
    }

    public function step4c(Request $request){
        $lastInsertedId = session()->get('lastInsertedId');
        $lastModuledId = session()->get('lastModuledId');
        $lastLessonId = session()->get('lastLessonId');

        if(!$lastInsertedId || !$lastModuledId || !$lastLessonId){
            return redirect('instructor/courses');
        }

        $request->validate([
            'module_name' => 'required',
            // 'is_module' => 'required'
        ]);

        if($request->is_module){
            $module = new Module();
            $module->title = $request->input('module_name');
            $module->slug = Str::slug($request->input('module_name'));
            $module->course_id = $lastInsertedId;
            $module->user_id = Auth::user()->id;
            $module->save();
            session()->put('lastModuledId', $module->id);
        }

        if($lastModuledId && !$request->is_module){
            $lesson = new Lesson();
            $lesson->course_id = $lastInsertedId;
            $lesson->user_id = Auth::user()->id;
            $lesson->module_id = $lastModuledId;
            $lesson->title = $request->input('module_name');
            $lesson->slug = Str::slug($request->input('module_name'));
            $lesson->save();
        }
        
        return redirect('instructor/courses/create/step-3');
    }

}