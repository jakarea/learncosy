<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Notification;
use App\Models\Checkout;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class CourseCreateStepController extends Controller
{
    public function start(){

        return view('e-learning/course/instructor/create/step-0');
    }

    public function startSet(Request $request){

        $course = new Course();
        $course->user_id = Auth::user()->id;
        $course->save();

        if($request->input('module_name')){
            $module = new Module();
            $module->course_id = $course->id;
            $module->user_id = Auth::user()->id;
            $module->title = $request->input('module_name');
            $module->slug = Str::slug($request->input('module_name'));
            $module->save();
        }
        return redirect('instructor/courses/create/'.$course->id)->with('success', 'Course Creation Started Successfuly');
    }

    public function step1($id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-1',compact('course'));
    }

    public function step1c(Request $request, $id){

        if(!$id){
            return redirect('instructor/courses');
        }

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
        $description = $request->input('description');
        $curriculum = $request->input('curriculum');
        $language = $request->input('language');
        $platform = $request->input('platform');
 
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
            'description' => $description,
            'curriculum' => $curriculum,
            'language' => $language,
            'platform' => $platform,
            'auto_complete' => $auto_complete
        ]);

        $course->save();

        return redirect('instructor/courses/create/'.$id.'/objects')->with('success', 'Course Facts Info Saved successfully');
    }


    public function step3($id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $modules = Module::with('lessons')->where('course_id', $id)->get();
        return view('e-learning/course/instructor/create/step-6',compact('modules'));
    }

    public function step3c(Request $request, $id){

         if(!$id){
            return redirect('instructor/courses');
        }

        $request->validate([
            'lesson_name' => 'required',
            'lesson_type' => 'required'
        ]);

        $lesson = new Lesson();
        $lesson->course_id = $id;
        $lesson->user_id = Auth::user()->id;
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->input('lesson_name');
        $lesson->slug = Str::slug($request->input('lesson_name'));
        $lesson->type = $request->input('lesson_type');
        $lesson->save();

        return redirect()->back()->with('success', 'Lesson Created Successfully');
    }

    public function step3cd(Request $request, $id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $request->validate([
            'module_name' => 'required'
        ]);

        $module = new Module();
        $module->course_id = $id;
        $module->user_id = Auth::user()->id;
        $module->title = $request->input('module_name');
        $module->slug = Str::slug($request->input('module_name'));
        $module->save();

        return redirect()->back()->with('success', 'Module Created successfully');
    }

    public function step3cu(Request $request, $id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $request->validate([
            'module_name' => 'required'
        ]);

        $module_id = $request->input('module_id');

        $module = Module::where('id', $module_id)->firstOrFail();
        $module->course_id = $id;
        $module->user_id = Auth::user()->id;
        $module->title = $request->input('module_name');
        $module->slug = Str::slug($request->input('module_name'));
        $module->save();

        return redirect()->back()->with('success', 'Module Updated successfully');
    }

    public function step3d(Request $request, $id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $request->validate([
            'lesson_name' => 'required',
            'lesson_type' => 'required'
        ]);

        $lesson_id = $request->input('lesson_id');
        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();

        $lesson->course_id = $request->input('course_id');
        $lesson->user_id = Auth::user()->id;
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->input('lesson_name');
        $lesson->slug = Str::slug($request->input('lesson_name'));
        $lesson->type = $request->input('lesson_type');
        $lesson->save();

        return redirect()->back()->with('success', 'Lesson Updated successfully');
    }

    public function stepLessonText($course_id,$module_id,$lesson_id){

        if(!$lesson_id){
            return redirect('instructor/courses');
        }

        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-4-text',compact('lesson'));
    }

    public function stepLessonContent(Request $request, $lesson_id){

        if(!$lesson_id){
            return redirect('instructor/courses');
        }

        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();
        $lesson->text = $request->input('text');

        $request->validate([
            'lesson_file.*' => 'mimes:pdf,doc,docx|max:250240',
        ]);

        $uploadedFilenames = [];

        if ($request->hasFile('lesson_file')) {
            $uploadedFilenames = [];
        
            foreach ($request->file('lesson_file') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/lessons/files'), $filename);
                $uploadedFilenames[] = $filename;
            }
        
            $lesson->lesson_file = implode(",", $uploadedFilenames);
        }
        

        $lesson->save();

        return redirect('instructor/courses/create/'.$lesson->course_id.'/lesson/'.$lesson->module_id.'/institute/'.$lesson->id)->with('success', 'Lesson Content Added successfully');

    }

    public function stepLessonInstitue($id,$module_id,$lesson_id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();
        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-3',compact('course','lesson'));
    }

    public function stepLessonAudio($id,$module_id,$lesson_id){

        if(!$id || !$module_id || !$lesson_id){
            return redirect('instructor/courses');
        } 

        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-4',compact('lesson'));
    }

    public function stepLessonAudioSet(Request $request, $id, $module_id, $lesson_id){

        if (!$id) {
            return redirect('instructor/courses');
        }
        
        $request->validate([
            'description' => 'string',
            'audio' => 'mimes:mp3,wav|max:50000',
            'lesson_file.*' => 'mimes:pdf,doc,docx|max:50000',

        ]);
        
        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();
        $lesson->short_description = $request->input('description');
        
        // Handle audio file upload
        if ($request->hasFile('audio')) {
            // Check if a previous audio file exists and delete it
            if ($lesson->audio) {
                $previousAudioPath = public_path('uploads/audio') . '/' . $lesson->audio;
                if (file_exists($previousAudioPath)) {
                    unlink($previousAudioPath);
                }
            }
        
            $audio = $request->file('audio');
            $audioName = 'lesson-audio' . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path('uploads/audio/'), $audioName);
            $lesson->audio = $audioName;
        }
        
        $uploadedFilenames = [];
        
        if ($request->hasFile('lesson_file')) {
            foreach ($request->file('lesson_file') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads/lessons/', $filename);
                $uploadedFilenames[] = $filename;
            }
        
            $lesson->lesson_file = implode(",", $uploadedFilenames);
        }
        
        $lesson->save();
        

        return redirect('instructor/courses/create/'.$lesson->course_id.'/lesson/'.$lesson->module_id.'/institute/'.$lesson->id)->with('success', 'Lesson Content Added successfully');
        
    }

    public function stepLessonVideo($id,$module_id,$lesson_id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $lesson = Lesson::where('id', $lesson_id)->firstOrFail();
        $course = Course::where('id', $id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-5',compact('course','lesson'));
    }

    public function stepLessonVideoSet(Request $request, $id,$module_id,$lesson_id)
    {

        $request->validate([
            'video_link' => 'required|mimes:mp4,mov,ogg,qt|max:100000',
            'description' => 'string', 
            'lesson_file.*' => 'mimes:pdf,doc,docx|max:50000',
        ],
        [
            'video_link.required' => 'Video file is required!',
            'video_link' => 'Max file size is 1 GB!',
        ]);
        
        $lesson = Lesson::where('id', $lesson_id)->firstOrFail(); 

        $lesson->short_description = $request->input('description');

        $uploadedFilenames = [];
        
        if ($request->hasFile('lesson_file')) {
            foreach ($request->file('lesson_file') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('uploads/lessons/', $filename);
                $uploadedFilenames[] = $filename;
            }
        
            $lesson->lesson_file = implode(",", $uploadedFilenames);
        }

        $lesson->save();

        $file = $request->file('video_link');
        $videoName = $file->getClientOriginalName();

        [$vimeoData, $status, $accountName] = isVimeoConnected();

        if ($status === 'Connected') {
            $vimeo = new \Vimeo\Vimeo($vimeoData->client_id, $vimeoData->client_secret, $vimeoData->access_key);

            $uri = $vimeo->upload($file->getPathname(), [
                'name' => $lesson->title,
                'approach' => 'tus',
                'size' => $file->getSize(),
            ]);

            if ($uri) {
                $lesson = Lesson::find($lesson_id);
                $lesson->video_link = $uri;
                $lesson->duration = $request->duration;
                $lesson->short_description = $request->description;
                $lesson->save();
            }
            $course = Course::find($id);
            $price = $course->price ?? 0;
            return response()->json(['uri' => $uri, 'price' => $price]);

        } elseif ($status === 'Invalid Credentials') {
            return response()->json(['error' => 'Invalid Vimeo credentials. Please check your account settings.']);
        } else {
            return response()->json(['error' => 'Vimeo account is not connected.']);
        }
    }

    public function courseObjects($id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail(); 

        return view('e-learning/course/instructor/create/objects',compact('course'));
    }

    public function courseObjectsSet(Request $request, $id){


       $data = $request->json()->all(); 
 
       if ($data['dataIndex'] != null) {

        $dataIndex = $data['dataIndex'];
        $dataObjective = $data['objective'];

        $course = Course::findOrFail($id); 
            
        $existingObjectives = explode('[objective]', $course->objective); 
        $existingObjectives[$dataIndex] = $dataObjective;

        $updatedObjectiveString = implode('[objective]', $existingObjectives);
    
        $course->objective = $updatedObjectiveString;
        $course->save(); 

        return response()->json([
            'message' => 'UPDATED'
        ]);

       }else{ 

            $course = Course::findOrFail($id); 
            
            $existingObjectives = explode('[objective]', $course->objective); 
            $newObjectives = [$data['objective']];
    
            $allObjectives = array_merge($existingObjectives, $newObjectives); 
    
            $newObjectiveString = implode('[objective]', $allObjectives);
    
            $course->objective = $newObjectiveString;
            $course->save();

            return response()->json([
                'message' => 'ADDED'
            ]);
       } 
    }

    public function deleteObjective(Request $request, $id,$index)
    { 
        // return  $index;

        $course = Course::findOrFail($id);
        $existingObjectives = explode('[objective]', $course->objective);
 
        if (isset($existingObjectives[$index])) { 
            unset($existingObjectives[$index]);
             
            $existingObjectives = array_values($existingObjectives);
 
            $course->objective = implode('[objective]', $existingObjectives);
            $course->save();

            return response()->json([
                'message' => 'DONE',
                'remainingObjectives' => $existingObjectives
            ]);

        } else {
            return response()->json([
                'message' => 'Invalid index',
            ], 422);
        }

    }

    public function coursePrice($id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();
        return view('e-learning/course/instructor/create/step-7',compact('course'));
    }

    public function coursePriceSet(Request $request, $id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        $request->validate([
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric|lt:price',
        ]);

        $course->price = $request->input('price');
        $course->offer_price = $request->input('offer_price');
        $course->save();

        return redirect('instructor/courses/create/'.$course->id.'/design')->with('success', 'Course Price Set successfully');

    }

    public function courseDesign($id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-8',compact('course'));
    }

    public function courseDesignSet(Request $request,$id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        $request->validate([
            'thumbnail' => 'nullable|file|mimes:jpg,png,jpg|max:5121',
        ],
        [
            'thumbnail' => 'Max file size is 5 MB!'
        ]);

        $slugg = Str::slug(Auth::user()->name);

        if ($request->hasFile('thumbnail')) { 
            if ($course->thumbnail) {
               $oldFile = public_path($course->thumbnail);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('thumbnail');
            $image = Image::make($file);
            $image->encode('jpg', 40);
            $uniqueFileName = $slugg . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/courses/') . $uniqueFileName);
            $image_path = 'uploads/courses/' . $uniqueFileName;
           $course->thumbnail = $image_path;
       }

        $course->promo_video = $request->input('promo_video');
        $course->save();

        return redirect('instructor/courses/create/'.$course->id.'/certificate')->with('success', 'Course Thumbnail Set successfully');
    }


    public function courseCertificate($id){
        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-9',compact('course'));
    }

    public function courseCertificateSet(Request $request, $id){

        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        $request->validate([
            'sample_certificates' => 'nullable|file|mimes:jpg,png,pdf,svg|max:5121',
            'hascertificate' => 'required',
        ]);

        $image_path = 'uploads/courses/sample_certificates.jpg';

        if ($request->hasFile('sample_certificates')) {
            $file = $request->file('sample_certificates');
            $image = Image::make($file);
            $image->encode('jpg', 40); 
            $image_path = 'uploads/courses/sample_certificates_'.$course->slug . '.jpg';
            $image->save(public_path('uploads/courses/sample_certificates_') . $course->slug . '.jpg');
        }

        // Store other form data
        $course->hascertificate = $request->input('hascertificate');
        $course->sample_certificates = $image_path;
        $course->save();

        return redirect('instructor/courses/create/'.$course->id.'/visibility')->with('success', 'Course Sample Certificate Set successfully');
    }

    public function visibility($id){
        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-10',compact('course'));
    }

    public function visibilitySet(Request $request,$id){
       if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        $request->validate([
            'status' => 'required',
        ]);

        $course->status = $request->input('status');
        $course->allow_review = $request->input('allow_review') ?? 0;
        $course->save();

        if ($course->status == 'published') {

            $checkout = new Checkout;
            $checkouts = $checkout->getCheckoutByInstructorID();
            foreach($checkouts as $checkout){
                $notification = new Notification([
                    'instructor_id' => $checkout->instructor_id,
                    'course_id' => $checkout->course_id,
                    'user_id' => $checkout->user_id,
                    'message' => 'message',
                    'type' => 'New Course Created'
                ]);
                $notification->save();
            }
        }

        return redirect('instructor/courses/create/'.$course->id.'/share')->with('success', 'Course Status Set successfully');
    }

    public function courseShare($id){
        if(!$id){
            return redirect('instructor/courses');
        }

        $course = Course::where('id', $id)->firstOrFail();

        return view('e-learning/course/instructor/create/step-11',compact('course'));
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
