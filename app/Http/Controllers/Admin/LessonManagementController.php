<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\Module; 
use DataTables; 

class LessonManagementController extends Controller
{
     // lesson list
     public function index()
     {  
         $lessons = Lesson::orderby('id', 'desc')->paginate(1);
         return view('e-learning/lesson/admin/index',compact('lessons')); 
     }

     // data table getData
    public function lessonsDataTable()
    { 
            $lesson = Lesson::select('id','title','slug','thumbnail','meta_keyword','video_link','status')->get();
          
            return Datatables::of($lesson)
                ->addColumn('action', function($lesson){ 
                     
                    $actions = '<div class="action-dropdown">
                        <div class="dropdown">
                            <a class="btn btn-drp" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="bttns-wrap"> 
                                    <a class="dropdown-item" href="/admin/lessons/'.$lesson->slug.'/edit"> <i class="fas fa-pen"></i></a>  
                                    <form method="post" class="d-inline btn btn-danger" action="/admin/lessons/'.$lesson->slug.'/destroy">  
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                        <button type="submit" class="btn p-0"><i class="fas fa-trash text-white"></i></button>
                                    </form>    
                                </div>
                            </div> 
                        </div>
                    </div>';

                    return $actions;

                })
                ->editColumn('image', function ($lesson) {
                return '<img src="/assets/images/lessons/'.$lesson->thumbnail.'" width="50" />';
            })
            ->editColumn('status', function ($lesson) {
                if($lesson->status == 'published'){
                    return '<label class="badge bg-success">'.__('Published').'</label>';
                }
                if($lesson->status == 'draft'){
                    return '<label class="badge bg-info">'.__('Draft').'</label>';
                }
                if($lesson->status == 'pending'){
                    return '<label class="badge bg-danger">'.__('Pending').'</label>';
                } 
             })
            ->addIndexColumn()
            ->rawColumns(['action', 'image','status','keyword'])
            ->make(true);
    }

    // lesson create
    public function create(Request $request)
    {  
        $courses = Course::orderBy('id', 'desc')->get();
        $modules = Module::orderBy('id', 'desc')->get();
        return view('e-learning/lesson/admin/create',compact('courses','modules')); 
    }

    // lesson store
    public function store(Request $request)
    {  
        // return $request->all(); 

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
        return redirect('admin/lessons')->with('success', 'Lesson saved!');

    }

     // lesson edit
     public function edit($slug)
     {   
        $courses = Course::orderBy('id', 'desc')->get();
        $modules = Module::orderBy('id', 'desc')->get();
         $lesson = Lesson::where('slug', $slug)->first();
         if ($lesson) {
             return view('e-learning/lesson/admin/edit', compact('lesson','courses','modules'));
         } else {
             return redirect('admin/lessons')->with('error', 'Lesson not found!');
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

        return redirect('admin/lessons')->with('success', 'Lesson Updated!');
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

        return redirect('admin/lessons')->with('success', 'Lesson deleted!');
    }
}
