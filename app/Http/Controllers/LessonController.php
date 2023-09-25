<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\Module; 
use DataTables;
use Illuminate\Http\Request;
use Auth;
use Vimeo\Laravel\Facades\Vimeo;
use Vimeo\Vimeo as VimeoSDK;

use Illuminate\Http\UploadedFile;

ini_set('upload_max_filesize', '1G');
ini_set('post_max_size', '1G');
class LessonController extends Controller
{
    // lesson list
    public function index()
    {   

        $title = isset($_GET['title']) ? $_GET['title'] : '';
         $status = isset($_GET['status']) ? $_GET['status'] : '';
           $lessons = Lesson::where('user_id',Auth::user()->id)->orderby('id', 'desc');
         if (!empty($title)) {
             $lessons->where('title', 'like', '%' . trim($title) . '%');
         }
         if (!empty($status)) {
             $lessons->where('status', 'like', '%' . trim($status) . '%');
         }
         $lessons = $lessons->paginate(12);

        return view('e-learning/lesson/instructor/grid',compact('lessons')); 
    }

    // lesson create
    public function create(Request $request)
    {  
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get(); 
        $modules = Module::where('user_id', $userId)->get();
        return view('e-learning/lesson/instructor/create',compact('courses','modules')); 
    }

    // lesson create
    public function videoUpload(Request $request)
    {  
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get(); 
        $modules = Module::where('user_id', $userId)->get();
        return view('e-learning/lesson/instructor/video-upload',compact('courses','modules')); 
    }

    // lesson store
    public function store(Request $request)
    {  
        // return $request->all(); 
        // return "Working";
        $request->validate([
            'course_id' => 'required',
            'module_id' => 'required',
            'title' => 'required',  
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'lesson_file' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
        ],
        [ 
            'thumbnail.required' => 'Thumbnail is required!',
            'thumbnail' => 'Max file size is 5 MB!',
            'lesson_file' => 'Max file size is 5 MB!'
        ]);

        //save lesson
        $lesson = new Lesson([
            'course_id' => $request->course_id,
            'user_id' => Auth::user()->id,
            'module_id' => $request->module_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'video_link' => $request->video_link,  
            'meta_keyword' => is_array($request->meta_keyword) ? implode(",",$request->meta_keyword) : $request->meta_keyword,
            'short_description' => $request->short_description, 
            'meta_description' => $request->meta_description,  
            'status' => $request->status,
        ]);  
 
        
        $lesson->slug = $lesson->slug . '-';
         //if thumbnail is valid then save it
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $name = $lesson->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/lessons');
            $image->move($destinationPath, $name);
            $lesson->thumbnail = $name;
        } 

        //if lesson_file is valid then save it
        if ($request->hasFile('lesson_file')) {
            $image = $request->file('lesson_file');
            $name2 = $lesson->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/lessons');
            $image->move($destinationPath, $name2);
            $lesson->lesson_file = $name2;
        }
           
        $lesson->save();

        // return redirect()->route('lesson.upload.video')->with('success', 'Lesson saved!');
        // pass lesson data
        return redirect()->route('lesson.upload.video', ['lesson_id' => $lesson->id, 'lesson_slug' => $lesson->slug])->with('success', 'Lesson saved!');


    }

    // Vimeo Upload Page
    public function uploadVimeoPage()
    {   
      
       return view('e-learning/lesson/instructor/upload_vimeo');
       
    }

    public function uploadViewToVimeo(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
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
                $lesson = Lesson::find($request->lesson_id);
                $lesson->video_link = $uri;
                $lesson->save();
            }
    
            return response()->json(['uri' => $uri]);
        } elseif ($status === 'Invalid Credentials') {
            return response()->json(['error' => 'Invalid Vimeo credentials. Please check your account settings.']);
        } else {
            return response()->json(['error' => 'Vimeo account is not connected.']);
        }
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

     // lesson edit
     public function edit($slug)
     {   
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get(); 
        $modules = Module::where('user_id', $userId)->get();

         $lesson = Lesson::where('slug', $slug)->first();
         if ($lesson) {
             return view('e-learning/lesson/instructor/edit', compact('lesson','courses','modules'));
         } else {
             return redirect('instructor/lessons')->with('error', 'Lesson not found!');
         } 
     }

     // lesson update
    public function update(Request $request, $slug)
    {   
        //   return $request->all();

          $request->validate([
            'course_id' => 'required',
            'module_id' => 'required',
            'title' => 'required',  
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'lesson_file' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
        ],
        [  
            'thumbnail' => 'Max file size is 5 MB!',
            'lesson_file' => 'Max file size is 5 MB!'
        ]);

        $lesson = Lesson::where('slug', $slug)->first();
        $lesson->course_id = $request->course_id; 
        $lesson->user_id = Auth::user()->id;
        $lesson->module_id = $request->module_id; 
        $lesson->title = $request->title; 
        $lesson->slug = Str::slug($request->title);
        $lesson->meta_keyword = is_array($request->meta_keyword) ? implode(",",$request->meta_keyword) : $request->meta_keyword;
        $lesson->video_link = $request->video_link; 
        $lesson->lesson_file = $request->lesson_file; 
        $lesson->short_description = $request->short_description;
        $lesson->meta_description = $request->meta_description;
        $lesson->status = $request->status;
        $lesson->save();

        if ($request->hasFile('thumbnail')) { 
             // Delete old file
             if ($lesson->thumbnail) {
                $oldFile = public_path('/assets/images/lessons/'.$lesson->thumbnail);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('thumbnail');
            $name = $lesson->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/lessons');
            $image->move($destinationPath, $name);
            $lesson->thumbnail = $name; 
        }

        if ($request->hasFile('lesson_file')) { 
             // Delete old file
             if ($lesson->lesson_file) {
                $oldFile = public_path('/assets/images/lessons/'.$lesson->lesson_file);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('lesson_file');
            $name = $lesson->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/lessons');
            $image->move($destinationPath, $name);
            $lesson->lesson_file = $name; 
        } 

        $lesson->save();

        return redirect('instructor/lessons')->with('success', 'Lesson Updated!');
    }

    public function destroy($slug){
         
        $lesson = Lesson::where('slug', $slug)->first();
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

        return redirect()->back()->with('success', 'Lesson deleted!');


        // return redirect('instructor/lessons')->with('success', 'Lesson deleted!');
    }
}
