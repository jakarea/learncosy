<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Str;
use App\Models\Module; 
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // module list
    public function index()
    {   
        $modules = Module::orderby('id', 'desc')->paginate(12);
        return view('module/instructor/index',compact('modules')); 
    }

    // module create
    public function create()
    {  
        $courses = Course::orderBy('id', 'desc')->get();
        return view('module/instructor/create',compact('courses')); 
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

        //save module
        $module = new Module([
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
        return redirect('instructor/modules')->with('success', 'Module saved!');

    }

    // module edit
    public function edit($slug)
    {  
        $courses = Course::orderBy('id', 'desc')->get();
        $module = Module::where('slug', $slug)->first();
        if ($module) {
            return view('module/instructor/edit', compact('module','courses'));
        } else {
            return redirect('instructor/modules')->with('error', 'Module not found!');
        } 

    } 

    // module update
    public function update(Request $request, $slug)
    {   
          // return $request->all();

          $request->validate([
            'title' => 'required'
        ]);

        $module = Module::where('slug', $slug)->first();
        $module->title = $request->title; 
        $module->slug = Str::slug($request->title); 
        $module->status = $request->status;
        $module->save();

        return redirect('instructor/modules')->with('success', 'Module Updated!');
    }

    public function destroy($slug)
    { 
        $module = Module::where('slug', $slug)->delete(); 
        return redirect('instructor/modules')->with('success', 'Module deleted!');
    }
}
