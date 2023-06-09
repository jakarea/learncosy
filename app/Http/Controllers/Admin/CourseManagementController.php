<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Support\Str; 
use App\Models\CourseReview;
use DataTables;
use Auth;
use File;

class CourseManagementController extends Controller
{
    // course list
    public function index(){
        // return view('e-learning/course/admin/index');  

        $courses = Course::orderBy('id', 'desc')->paginate(6);

        return view('e-learning/course/admin/list',compact('courses'));  
    }

     // data table getData
     public function courseDataTable()
     {  
         $course = Course::all();
 
         // return $course;
           
             return Datatables::of($course)
                 ->addColumn('action', function($row){ 
                      
                     $actions = '<div class="action-dropdown">
                         <div class="dropdown">
                             <a class="btn btn-drp" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fa-solid fa-ellipsis"></i>
                             </a>
                             <div class="dropdown-menu">
                                 <div class="bttns-wrap">
                                     <a class="dropdown-item" href="/admin/courses/'.$row->slug.'"><i class="fas fa-eye"></i></a>
                                     <a class="dropdown-item" href="/admin/courses/'.$row->slug.'/edit"> <i class="fas fa-pen"></i></a>  
                                     <form method="post" class="d-inline btn btn-danger" action="/admin/courses/'.$row->slug.'/destroy">  
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
                 ->editColumn('image', function ($row) {
                 return '<img src="/assets/images/courses/'.$row->thumbnail.'" width="50" />';
             })
             ->editColumn('status', function ($row) {
                 if($row->status == 'published'){
                     return '<label class="badge bg-success">'.__('Published').'</label>';
                 }
                 if($row->status == 'draft'){
                     return '<label class="badge bg-info">'.__('Draft').'</label>';
                 }
                 if($row->status == 'pending'){
                     return '<label class="badge bg-danger">'.__('Pending').'</label>';
                 } 
              })->editColumn('categorie', function ($row) {
                 if($row->categories){
                     $cateogires = explode(",",$row->categories); 
                     foreach ($cateogires as $key => $category) {
                         return '<span class="badge text-bg-primary">'.$category.'</span>'; 
                     } 
                 }
             })
             ->addIndexColumn()
             ->rawColumns(['action', 'image','status','categorie'])
             ->make(true);
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

        return view('e-learning/course/admin/create',compact('categories')); 
    }

    // course store
    public function store(Request $request)
    {  
        // return $request->all();
 
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
        // return $course;
        $course->save();
        return redirect('admin/courses')->with('success', 'Course saved Successfully!');
    }

    // course show
    public function show($slug)
    {   
        // $lessons = Lesson::orderby('id', 'desc')->paginate(10);
        // $modules = Module::orderby('id', 'desc')->paginate(10);
        // $course = Course::where('slug', $slug)->first(); 
 

        // if ($course) {
        //     return view('e-learning/course/admin/show', compact('course','modules','lessons'));
        // } else {
        //     return redirect('admin/courses')->with('error', 'Course not found!');
        // }

        $course = Course::where('slug', $slug)->with('modules.lessons','user')->first();
        $course_reviews = CourseReview::where('course_id', $course->id)->with('user')->get();

        if ($course) {
            return view('e-learning/course/admin/show', compact('course','course_reviews'));
        } else {
            return redirect('admin/courses')->with('error', 'Course not found!');
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
             return view('e-learning/course/admin/edit', compact('course','categories'));
         } else {
             return redirect('admin/courses')->with('error', 'Course not found!');
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

        if ($request->hasFile('banner')) { 
             // Delete old file
             if ($course->banner) {
                $oldFile = public_path('/assets/images/courses/'.$course->banner);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('banner');
            $name = $course->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/courses');
            $image->move($destinationPath, $name);
            $course->banner = $name; 
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

        return redirect('admin/courses')->with('success', 'Course Updated!');
    }

    public function destroy($slug)
    {
        $course = Course::where('slug', $slug)->first();
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
            return redirect('admin/courses')->with('success', 'Course deleted!');
        } else {
            return redirect('admin/courses')->with('error', 'Course not found!');
        }
    }
}
