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
    public function step1($id = null){
        $course = '';
        if($id){
            $course = Course::findOrFail($id);
        }
        return view('e-learning/course/instructor/create/step-1',compact('course'));
    }

    public function step1c(Request $request, $id=null){
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

        $course = Course::findOrNew($id);
        $course->fill([
            'user_id' => Auth::user()->id,
            'title' => $title,
            'slug' => $slug,
            'short_description' => $short_description,
            'auto_complete' => $auto_complete
            // Other course attributes
        ]);

        $course->save();
        $id = $course->id;
        session()->put('lastCourseId', $id);
        return redirect('instructor/courses/create/'.$id.'/content')->with('success', 'Course created successfully');
    }

    public function step2($id){ 
        $course = Course::where('id', $id)->firstOrFail();
        return view('e-learning/course/instructor/create/step-2',compact('course'));
    }

    public function step2c(Request $request, $id){
        $course = Course::where('id', $id)->firstOrFail();
        $request->validate([
            'thumbnail' => 'nullable|file|mimes:jpeg,png,pdf|max:5121', // Example mime types and maximum size
            'description' => 'required|string',
        ]);

        $image_path = 'assets/images/courses/thumbnail.png';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            // Convert image to WebP using Intervention Image
            $image = Image::make($file);
            $image->encode('webp', 90); // Convert to WebP with 90% quality
            $image_path = 'assets/images/courses/'.$course->slug . '.webp';
            $image->save(public_path('assets/images/courses/') . $course->slug . '.webp');
        }

        // Store other form data
        $description = $request->input('description');
        $course->description = $description;
        $course->thumbnail = $image_path;
        $course->save();
        
        return redirect('instructor/courses/create/'.$id.'/facts')->with('success', 'Course created successfully');
    }

    public function step3($id){

        $modules = Module::with('lessons')->where('course_id', $id)->get();
        return view('e-learning/course/instructor/create/step-6',compact('modules'));
    }

    public function step3c(Request $request, $id){
        
        $request->validate([
            'module_name' => 'required',
            // 'is_module' => 'required'
        ]);

        if($request->is_module){
            $module = new Module();
            $module->title = $request->input('module_name');
            $module->slug = Str::slug($request->input('module_name'));
            $module->course_id = $id;
            $module->user_id = Auth::user()->id;
            $module->save();
        }

        if(!$request->is_module){
            $lesson = new Lesson();
            $lesson->course_id = $id;
            $lesson->user_id = Auth::user()->id;
            $lesson->module_id = $request->module_id;
            $lesson->title = $request->input('module_name');
            $lesson->slug = Str::slug($request->input('module_name'));
            $lesson->save();
        }
        
        return redirect('instructor/courses/create/'.$id.'/facts');
    }

    public function step4(){
        return view('e-learning/course/instructor/create/step-4');
    }

    public function step4c(Request $request){
        $lastCourseId = session()->get('lastCourseId');
        $lastModuledId = session()->get('lastModuledId');
        $lastLessonId = session()->get('lastLessonId');

        if(!$lastCourseId || !$lastModuledId || !$lastLessonId){
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
            $module->course_id = $lastCourseId;
            $module->user_id = Auth::user()->id;
            $module->save();
            session()->put('lastModuledId', $module->id);
        }

        if($lastModuledId && !$request->is_module){
            $lesson = new Lesson();
            $lesson->course_id = $lastCourseId;
            $lesson->user_id = Auth::user()->id;
            $lesson->module_id = $lastModuledId;
            $lesson->title = $request->input('module_name');
            $lesson->slug = Str::slug($request->input('module_name'));
            $lesson->save();
        }
        
        return redirect('instructor/courses/create/step-3');
    }

    public function step5(){
        return view('e-learning/course/instructor/create/step-5');
    }

    public function step5c(Request $request)
    {
        $lastCourseId = session()->get('lastCourseId');
        $lastModuledId = session()->get('lastModuledId');
        $lastLessonId = session()->get('lastLessonId');

        $request->validate([
            'video_link' => 'required|mimes:mp4,mov,ogg,qt|max:100000',
        ],
        [ 
            'video_link.required' => 'Video file is required!',
            'video_link' => 'Max file size is 1 GB!',
        ]);
    
        $file = $request->file('video_link');
        $videoName = $file->getClientOriginalName();
        
        [$vimeoData, $status, $accountName] = isVimeoConnected();
            
        if ($status === 'Connected') {
            $vimeo = new \Vimeo\Vimeo($vimeoData->client_id, $vimeoData->client_secret, $vimeoData->access_key);
    
            $uri = $vimeo->upload($file->getPathname(), [
                'name' => $videoName,
                'approach' => 'tus',
                'size' => $file->getSize(),
            ]);
            
            if ($uri) {
                $lesson = Lesson::find($lastLessonId);
                $lesson->video_link = $uri;
                $lesson->short_description = $request->description;
                $lesson->save();
            }
            $course = Course::find($lastCourseId);
            $price = $course->price ?? 0;
            return response()->json(['uri' => $uri, 'price' => $price]);

        } elseif ($status === 'Invalid Credentials') {
            return response()->json(['error' => 'Invalid Vimeo credentials. Please check your account settings.']);
        } else {
            return response()->json(['error' => 'Vimeo account is not connected.']);
        }
    }
    
    public function step7(){
        $lastCourseId = session()->get('lastCourseId');
        if(!$lastCourseId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-7');
    }

    public function step7c(Request $request){
        $lastCourseId = session()->get('lastCourseId');
        $course = Course::where('id', $lastCourseId)->firstOrFail();

        $request->validate([
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric|lt:price',
        ]);
    
        $course->price = $request->input('price');
        $course->offer_price = $request->input('offer_price');
        $course->save();
        return redirect('instructor/courses/create/step-8')->with('success', 'Data has been saved successfully');
    }


    public function step8(){
        $lastCourseId = session()->get('lastCourseId');
        if(!$lastCourseId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-8',['lastCourseId' => $lastCourseId]);
    }

    public function step8c(Request $request){
        $lastCourseId = session()->get('lastCourseId');
        $course = Course::where('id', $lastCourseId)->firstOrFail();
        $request->validate([
            'banner' => 'nullable|file|mimes:jpeg,png,jpg|max:5121', // Example mime types and maximum size
        ]);
    
        // Handle file upload
        // if ($request->hasFile('thumbnail')) {
        //     $file = $request->file('thumbnail');
            // $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads'), $filename);
        // }

        $image_path = 'assets/images/courses/banner.png';
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
    
            // Convert image to WebP using Intervention Image
            $image = Image::make($file);
            $image->encode('webp', 90); // Convert to WebP with 90% quality
            
            $image_path = 'assets/images/courses/banner_'.$course->slug . '.webp';

            $image->save(public_path('assets/images/courses/banner_') . $course->slug . '.webp');
        }

        // Store other form data
        $course->banner = $image_path;
        $course->save();
        return redirect('instructor/courses/create/step-9')->with('success', 'Data has been saved successfully');
    }


    public function step9(){
        $lastCourseId = session()->get('lastCourseId');
        if(!$lastCourseId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-9',['lastCourseId' => $lastCourseId]);
    }

    public function step9c(Request $request){
        $lastCourseId = session()->get('lastCourseId');
        $course = Course::where('id', $lastCourseId)->firstOrFail();
        $request->validate([
            'certificate' => 'nullable|file|mimes:jpeg,png,pdf,svg|max:5121', // Example mime types and maximum size
            'has_certificate' => 'required',
        ]);

        $image_path = 'assets/images/courses/certificate.png';
        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            // Convert image to WebP using Intervention Image
            $image = Image::make($file);
            $image->encode('webp', 90); // Convert to WebP with 90% quality
            $image_path = 'assets/images/courses/certificate_'.$course->slug . '.webp';
            $image->save(public_path('assets/images/courses/certificate_') . $course->slug . '.webp');
        }

        // Store other form data
        $description = $request->input('description');
        $course->hascertificate = $request->input('has_certificate');
        $course->certificate = $image_path;
        $course->save();
        return redirect('instructor/courses/create/step-10')->with('success', 'Data has been saved successfully');
    }

    public function step10(){
        $lastCourseId = session()->get('lastCourseId');
        if(!$lastCourseId){
            return redirect('instructor/courses');
        }
        return view('e-learning/course/instructor/create/step-10',['lastCourseId' => $lastCourseId]);
    }

    public function step10c(Request $request){
        $lastCourseId = session()->get('lastCourseId');
        $course = Course::where('id', $lastCourseId)->firstOrFail();
        $request->validate([
            'status' => 'required',
        ]);

        $course->status = $request->input('status');
        $course->allow_review = $request->input('allow_review') ?? 0;
        $course->save();
        return redirect('instructor/courses/create/step-11')->with('success', 'Data has been saved successfully');
    }

    public function step11(){
        $lastCourseId = session()->get('lastCourseId');
        if(!$lastCourseId){
            return redirect('instructor/courses');
        }
        $course = Course::where('id', $lastCourseId)->firstOrFail();
        return view('e-learning/course/instructor/create/step-11',['course' => $course]);
    }


    public function getProgress(Request $request)
    {
        $uri = $request->input('uri');

        // $vimeo = new VimeoSDK(config('vimeo.access_token'));

        $vimeo = Vimeo::connection();

        $video = $vimeo->request($uri);


        if (isset($response['body']['upload']['upload_status']) && $response['body']['upload']['upload_status'] === 'in_progress') {
            $progress = $response['body']['upload']['upload_progress'] * 100;
        } else {
            $progress = 100;
        }
    

        return response()->json(['progress' => $progress]);

    }
}