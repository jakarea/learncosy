<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Notification;
use App\Models\Certificate;
use App\Models\Checkout;
use App\Models\Module;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminCourseStepController extends Controller
{

    // done
    public function step1($id){

        if(!$id){
            return redirect('admin/courses');
        }
        $course = Course::find($id);
        return view('e-learning/course/admin/create/step-1',compact('course'));
    }

    // done
    public function step1c(Request $request, $id)
    {

        if(!$id){
            return redirect('admin/courses');
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
        $categories = $request->input('categories');

        while (Course::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $course = Course::findOrNew($id);
        $course->fill([
            'title' => $title,
            'slug' => $slug,
            'short_description' => $short_description,
            'description' => $description,
            'curriculum' => $curriculum,
            'language' => $language,
            'categories' => $categories,
            'auto_complete' => $auto_complete
        ]);

        $course->save();

        return redirect('admin/courses/create/'.$id.'/objects')->with('success', 'Course Facts Info Saved successfully');
    }

    // done
    public function step3($id){

        if(!$id){
            return redirect('admin/courses');
        }

        $modules = Module::with('lessons')->where('course_id', $id)->orderBy('reorder','ASC')->get();
        return view('e-learning/course/admin/create/step-6',compact('modules'));
    }


    // Module Resorting
    public function moduleResorting( Request $request ){

        $moduleOrder = $request->input('moduleOrder');

        foreach ($moduleOrder as $index => $moduleId) {
            $module = Module::find($moduleId);

            if ($module) {
                $module->reorder = $index + 1;
                $module->save();
            }
        }

        return response()->json(['success' => true]);

    }

    // Lesson Resorting
    public function moduleLessonResorting( Request $request ){

        $lessonsOrder = $request->input('lessonOrder');

        foreach ($lessonsOrder as $index => $lessionId) {
            $lesson = Lesson::find($lessionId);

            if ($lesson) {
                $lesson->reorder = $index + 1;
                $lesson->save();
            }
        }

        return response()->json(['success' => true]);
    }


    // done
    public function step3c(Request $request, $id){

         if(!$id){
            return redirect('admin/courses');
        }

        $request->validate([
            'lesson_name' => 'required',
            'lesson_type' => 'required'
        ],
        [
            'lesson_name' => 'Lesson Name is Required',
        ]);

        $lesson = new Lesson();
        $lesson->course_id = $id;
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->input('lesson_name');
        $lesson->slug = Str::slug($request->input('lesson_name'));
        $lesson->type = $request->input('lesson_type');
        $lesson->save();

        return redirect()->back()->with('success', 'Lesson Created Successfully');
    }

    // done
    public function step3cd(Request $request, $id){

        if(!$id){
            return redirect('admin/courses');
        }

        $request->validate([
            'module_name' => 'required'
        ],
        [
            'module_name' => 'Module Name is Required',
        ]);

        $module = new Module();
        $module->course_id = $id;
        $module->title = $request->input('module_name');
        $module->slug = Str::slug($request->input('module_name'));
        $module->save();

        return redirect()->back()->with('success', 'Module Created successfully');
    }
    // done
    public function step3cu(Request $request, $id){

        if(!$id){
            return redirect('admin/courses');
        }

        $request->validate([
            'module_name' => 'required'
        ],
        [
            'module_name' => 'Module Name is Required',
        ]);

        $module_id = $request->input('module_id');

        $module = Module::find($module_id);
        $module->course_id = $id;
        $module->title = $request->input('module_name');
        $module->slug = Str::slug($request->input('module_name'));
        $module->save();

        return redirect()->back()->with('success', 'Module Updated successfully');
    }

    // done
    public function step3d(Request $request, $id){

        if(!$id){
            return redirect('admin/courses');
        }

        $request->validate([
            'lesson_name' => 'required',
            'lesson_type' => 'required'
        ],
        [
            'lesson_name' => 'Lesson Name is Required',
        ]);

        $lesson_id = $request->input('lesson_id');
        $lesson = Lesson::find($lesson_id);

        $lesson->course_id = $request->input('course_id');
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->input('lesson_name');
        $lesson->slug = Str::slug($request->input('lesson_name'));
        $lesson->type = $request->input('lesson_type');
        $lesson->save();

        return redirect()->back()->with('success', 'Lesson Updated successfully');
    }
    // done
    public function stepLessonText($course_id,$module_id,$lesson_id){

        if(!$lesson_id){
            return redirect('admin/courses');
        }

        $lesson = Lesson::find($lesson_id);
        return view('e-learning/course/admin/create/step-4-text',compact('lesson'));
    }

    // done
    public function stepLessonContent(Request $request, $lesson_id){

        // return $lesson_id;

        if(!$lesson_id){
            return redirect('admin/courses');
        }

        $lesson = Lesson::find($lesson_id);
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

        return redirect('admin/courses/create/'.$lesson->course_id.'/lesson/'.$lesson->module_id.'/institute/'.$lesson->id)->with('success', 'Lesson Content Added successfully');

    }

    // done
    public function stepLessonInstitue($id,$module_id,$lesson_id){

        if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);
        $lesson = Lesson::find($lesson_id);

        return view('e-learning/course/admin/create/step-3',compact('course','lesson'));
    }

    // done
    public function stepLessonAudio($id,$module_id,$lesson_id){

        if(!$id || !$module_id || !$lesson_id){
            return redirect('admin/courses');
        }

        $lesson = Lesson::find($lesson_id);

        return view('e-learning/course/admin/create/step-4',compact('lesson'));
    }

    // done
    public function stepLessonAudioSet(Request $request, $id, $module_id, $lesson_id){

        if (!$id) {
            return redirect('admin/courses');
        }

        $request->validate([
            'description' => 'string',
            'audio' => 'mimes:mp3,wav|max:50000',
            'lesson_file.*' => 'mimes:pdf,doc,docx|max:50000',

        ]);

        $lesson = Lesson::find($lesson_id);
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
            $lesson->audio = 'uploads/audio/'.$audioName;
        }

        $uploadedFilenames = [];

        if ($request->hasFile('lesson_file')) {
            foreach ($request->file('lesson_file') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/lessons/files'), $filename);
                $uploadedFilenames[] = $filename;
            }

            $lesson->lesson_file = implode(",", $uploadedFilenames);
        }

        $lesson->save();

        return redirect('admin/courses/create/'.$lesson->course_id.'/lesson/'.$lesson->module_id.'/institute/'.$lesson->id)->with('success', 'Lesson Content Added successfully');

    }

    // done
    public function stepLessonVideo($id,$module_id,$lesson_id)
    {
        if(!$id){
            return redirect('admin/courses');
        }

        $lesson = Lesson::find($lesson_id);
        $course = Course::find($id);

        return view('e-learning/course/admin/create/step-5',compact('course','lesson'));
    }

    // done
    public function stepLessonVideoSet(Request $request, $id,$module_id,$lesson_id)
    {

        $request->validate([
            'video_link' => 'required|mimes:mp4,mov,ogg,qt|max:1000000',
            // 'lesson_file' => 'mimes:pdf,doc,docx|max:50000',
        ],
        [
            'video_link.required' => 'Video file is required!',
            'video_link.max' => 'Max file size is 1 GB!',
        ]);

        $lesson = Lesson::find($lesson_id);
        $lesson->short_description = $request->input('description');
        $uploadedFilenames = [];

        if ($request->hasFile('lesson_file')) {
            foreach ($request->file('lesson_file') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/lessons/files'), $filename);
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
                flash()->addSuccess('Video upload success!');
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

    // done
    public function courseObjects($id){

        if(!$id){
            return redirect('admin/courses');
        }
        $course = Course::find($id);
        return view('e-learning/course/admin/create/objects',compact('course'));
    }

    // done
    public function courseObjectsSet(Request $request, $id)
    {

       $data = $request->json()->all();

       if ($data['dataIndex'] != null) {

        $dataIndex = $data['dataIndex'];
        $dataObjective = $data['objective'];

        $course = Course::findOrFail($id);

        $existingObjectives = explode('[objective]', $course->objective);
        $existingObjectives[$dataIndex] = $dataObjective;

        $updatedObjectiveString = implode('[objective]', $existingObjectives);

        $trimmedStringUp = preg_replace('/^\[objective\]+|\[objective\]+$/', '', $updatedObjectiveString);

        $course->objective = $trimmedStringUp;
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

            $trimmedString = preg_replace('/^\[objective\]+|\[objective\]+$/', '', $newObjectiveString);

            $course->objective = $trimmedString;
            $course->save();

            return response()->json([
                'message' => 'ADDED'
            ]);
       }
    }

    public function deleteObjective(Request $request, $id,$index)
    {

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
            return redirect('admin/courses');
        }

        $course = Course::find($id);
        return view('e-learning/course/admin/create/step-7',compact('course'));
    }

    public function coursePriceSet(Request $request, $id){

        if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);

        $request->validate([
            'price' => 'required|numeric',
            'offer_price' => 'nullable|numeric|lt:price',
        ]);

        $course->price = $request->input('price');
        $course->offer_price = $request->input('offer_price');
        $course->save();

        return redirect('admin/courses/create/'.$id.'/design')->with('success', 'Course Price Set successfully');

    }

    public function courseDesign($id){

        if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);
        return view('e-learning/course/admin/create/step-8',compact('course'));
    }

    public function courseDesignSet(Request $request,$id){

        if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);

        $request->validate([
            'thumbnail' => 'nullable|file|mimes:jpg,png,jpeg,webp,svg,gif|max:5121',
        ],
        [
            'thumbnail' => 'Max file size is 5 MB!'
        ]);

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
            $uniqueFileName = $course->slugg . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/courses/') . $uniqueFileName);
            $image_path = 'uploads/courses/' . $uniqueFileName;
           $course->thumbnail = $image_path;
       }

        $course->promo_video = $request->input('promo_video');
        $course->save();

        return redirect('admin/courses/create/'.$course->id.'/certificate')->with('success', 'Course Thumbnail Set successfully');
    }


    public function courseCertificate($id)
    {
        if(!$id){
            return redirect('admin/courses');
        }

       $certificates = Certificate::with('course')->get();

        $course = Course::find($id);
        return view('e-learning/course/admin/create/step-9',compact('course','certificates'));
    }

    public function courseCertificateSet(Request $request, $id){

        if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);

        $request->validate([
            'sample_certificates' => 'nullable|file|mimes:jpg,png,pdf,svg|max:5121',
        ]);

        $certificateStyle = Certificate::find($request->certificateStyle);

        if ($certificateStyle) {
            $newCertificateStyle = $certificateStyle->replicate();
            $newCertificateStyle->course_id = $id;
            $newCertificateStyle->save();
        }

        $image_path = 'uploads/courses/sample_certificates.jpg';

        if ($request->hasFile('sample_certificates')) {
            $file = $request->file('sample_certificates');
            $image = Image::make($file);
            $image->encode('jpg', 40);
            $image_path = 'uploads/courses/sample_certificates_'.$course->slug . '.jpg';
            $image->save(public_path('uploads/courses/sample_certificates_') . $course->slug . '.jpg');
        }

        // Store other form data
        $course->sample_certificates = $image_path;
        $course->save();

        return redirect('admin/courses/create/'.$course->id.'/visibility')->with('success', 'Course Certificate Set successfully');
    }

    public function visibility($id){
        if(!$id){
            return redirect('admin/courses');
        }
        $course = Course::find($id);
        return view('e-learning/course/admin/create/step-10',compact('course'));
    }

    public function visibilitySet(Request $request,$id){
       if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);

        $request->validate([
            'status' => 'required',
        ]);

        $hasLessonsWithContent = 1;

        if ($request->input('status') == 'published') {
            $hasLessonsWithContent = collect($course['modules'])
            ->flatMap(function ($module) {
                return $module['lessons'];
            })
            ->where(function ($lesson) {
                return $lesson['video_link'] !== null || $lesson['audio'] !== null || $lesson['text'] !== null;
            })
            ->count() > 0;
        }

        if ($request->input('status') == 'published' && $course->title == 'Untitled Course') {
            $hasLessonsWithContent = 0;
        }

        if ($hasLessonsWithContent <= 0) {
            return redirect()->back()->with('error','This course does not have lesson to Publish!');
        }

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
                    'type' => 'Course Updated'
                ]);
                $notification->save();
            }
        }

        return redirect('admin/courses/create/'.$course->id.'/share')->with('success', 'Course Status Updated successfully');
    }

    public function courseShare($id){
        if(!$id){
            return redirect('admin/courses');
        }

        $course = Course::find($id);
        $Urlsubdomain = $course->user->subdomain;

        return view('e-learning/course/admin/create/step-11',compact('course','Urlsubdomain'));
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
