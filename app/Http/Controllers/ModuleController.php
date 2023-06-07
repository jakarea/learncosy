<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;
use App\Models\Module; 
use Illuminate\Http\Request;
use DataTables;
use Auth;

class ModuleController extends Controller
{
    // module list
    public function index()
    {    
        return view('e-learning/module/instructor/index'); 
    }

     // data table getData
     public function modulesDataTable()
     { 
             $module = Module::select('id','title','slug','number_of_lesson','duration','number_of_attachment','status')->get();
           
             return Datatables::of($module)
                 ->addColumn('action', function($module){ 
                      
                     $actions = '<div class="action-dropdown">
                         <div class="dropdown">
                             <a class="btn btn-drp" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fa-solid fa-ellipsis"></i>
                             </a>
                             <div class="dropdown-menu">
                                 <div class="bttns-wrap"> 
                                     <a class="dropdown-item" href="/instructor/modules/'.$module->slug.'/edit"> <i class="fas fa-pen"></i></a>  
                                     <form method="post" class="d-inline btn btn-danger" action="/instructor/modules/'.$module->slug.'/destroy">  
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
             ->editColumn('status', function ($module) {
                 if($module->status == 'published'){
                     return '<label class="badge bg-success">'.__('Published').'</label>';
                 }
                 if($module->status == 'draft'){
                     return '<label class="badge bg-info">'.__('Draft').'</label>';
                 }
                 if($module->status == 'pending'){
                     return '<label class="badge bg-danger">'.__('Pending').'</label>';
                 } 
              })
             ->addIndexColumn()
             ->rawColumns(['action','status'])
             ->make(true);
     }

    // module create
    public function create()
    {  
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get();
        return view('e-learning/module/instructor/create',compact('courses')); 
    }

    public function store(Request $request)
    {  
        // return $request->all();

        $request->validate([
            'course_id' => 'required',
            'title' => 'required', 
            'number_of_lesson' => 'required', 
            'duration' => 'required', 
        ]);

        $userId = Auth::user()->id;

        //save module
        $module = new Module([
            'user_id' => $userId, 
            'course_id' => $request->course_id, 
            'title' => $request->title, 
            'slug' => Str::slug($request->title), 
            'number_of_lesson' => $request->number_of_lesson, 
            'number_of_attachment' => $request->number_of_attachment, 
            'number_of_video' => $request->number_of_video, 
            'duration' => $request->duration, 
            'status' => $request->status,
        ]);  

        $module->save();
        return redirect('instructor/courses')->with('success', 'Module saved!');

    }

    // module edit
    public function edit($slug)
    {  
        $courses = Course::orderBy('id', 'desc')->get();
        $module = Module::where('slug', $slug)->first();
        if ($module) {
            return view('e-learning/module/instructor/edit', compact('module','courses'));
        } else {
            return redirect('instructor/modules')->with('error', 'Module not found!');
        } 

    } 

    // module update
    public function update(Request $request, $slug)
    {   
          // return $request->all();

          $request->validate([
            'course_id' => 'required',
            'title' => 'required',
            'number_of_lesson' => 'required', 
            'duration' => 'required', 
        ]);

        $module = Module::where('slug', $slug)->first();
        $module->course_id = $request->course_id; 
        $module->title = $request->title; 
        $module->slug = Str::slug($request->title); 
        $module->number_of_lesson = $request->number_of_lesson;
        $module->number_of_attachment = $request->number_of_attachment;
        $module->number_of_video = $request->number_of_video;
        $module->duration = $request->duration;
        $module->status = $request->status;
        $module->save();

        return redirect('instructor/modules')->with('success', 'Module Updated!');
    }

    public function destroy($slug)
    { 
        // delete module 
        $module = Module::where('slug', $slug)->first(); 

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

        return redirect('instructor/modules')->with('success', 'Module deleted!');
    }
}
