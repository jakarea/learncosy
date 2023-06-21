<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\BundleCourse;
use Illuminate\Support\Str; 
use DataTables;
use Auth;

class BundleCourseManagementController extends Controller
{
    // course bundle list
    public function index()
    {  
        $userId = Auth::user()->id;
        $bundleCourses = BundleCourse::where('user_id', $userId)->paginate(6); 
        return view('bundle/admin/list',compact('bundleCourses')); 
    }

    // data table getData
    public function bundleDataTable()
    { 
            $course = BundleCourse::select('id','title','slug','thumbnail','price','status')->get();
          
            return Datatables::of($course)
                ->addColumn('action', function($course){ 
                     
                    $actions = '<div class="action-dropdown">
                        <div class="dropdown">
                            <a class="btn btn-drp" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="bttns-wrap">
                                    <a class="dropdown-item" href="/admin/bundle/courses/'.$course->slug.'"><i class="fas fa-eye"></i></a>
                                    <a class="dropdown-item" href="/admin/bundle/courses/'.$course->slug.'/edit"> <i class="fas fa-pen"></i></a>  
                                    <form method="post" class="d-inline btn btn-danger" action="/admin/bundle/courses/'.$course->slug.'/destroy"> 
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
                ->editColumn('image', function ($course) {
                return '<img src="/assets/images/bundle-courses/'.$course->thumbnail.'" width="50" />';
            })
            ->editColumn('status', function ($course) {
                if($course->status == 'published'){
                    return '<label class="badge bg-success">'.__('Published').'</label>';
                }
                if($course->status == 'draft'){
                    return '<label class="badge bg-info">'.__('Draft').'</label>';
                }
                if($course->status == 'pending'){
                    return '<label class="badge bg-danger">'.__('Pending').'</label>';
                } 
             })
            ->addIndexColumn()
            ->rawColumns(['action', 'image','status'])
            ->make(true);
    }

    // course bundle create
    public function create()
    {   
       $courses = Course::all();
       return view('bundle/admin/create',compact('courses')); 
    }

     // course bundle store
     public function store(Request $request)
     {  
         // return $request->all();
  
         $request->validate([
             'title' => 'required',
             'selected_course' => 'required',
             'price' => 'required',
             'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
             'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
         ]);

         $userId = Auth::user()->id;
 
         //save bundle course
         $bundleCourse = new BundleCourse([
            'user_id' => $userId, 
             'title' => $request->title, 
             'slug' => Str::slug($request->title),
             'selected_course' => is_array($request->selected_course) ? implode(",",$request->selected_course) : $request->selected_course,
             'price' => $request->price,
             'subscription_status' => $request->subscription_status,
             'short_description' => $request->short_description, 
             'status' => $request->status,
         ]);  
  
         
         $bundleCourse->slug = $bundleCourse->slug . '-';
          //if thumbnail is valid then save it
         if ($request->hasFile('thumbnail')) {
             $image = $request->file('thumbnail');
             $name = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/assets/images/bundle-courses');
             $image->move($destinationPath, $name);
             $bundleCourse->thumbnail = $name;
         } 
 
         //if banner is valid then save it
         if ($request->hasFile('banner')) {
             $image = $request->file('banner');
             $name2 = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/assets/images/bundle-courses');
             $image->move($destinationPath, $name2);
             $bundleCourse->banner = $name2;
         }
          
         $bundleCourse->save();
         return redirect('admin/bundle/courses')->with('success', 'Bundle Course saved!');
     }

     // course bundle show
    public function show($slug)
    {    
        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        if ($bundleCourse) {
            return view('bundle/admin/show', compact('bundleCourse'));
        } else {
            return redirect('admin/bundle/courses')->with('error', 'Course not found!');
        }
    }

      // course bundle edit
    public function edit($slug)
    {   
        $courses = Course::orderBy('id', 'desc')->get();
        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        if ($bundleCourse) {
            return view('bundle/admin/edit', compact('bundleCourse','courses'));
        } else {
            return redirect('admin/bundle/courses')->with('error', 'Course not found!');
        } 
    }

    // course update
    public function update(Request $request, $slug)
    {   
        //   return $request->all();

          $request->validate([
            'title' => 'required',
            'selected_course' => 'required',
            'price' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000', 
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',  
        ]);

        $userId = Auth::user()->id;

        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        $bundleCourse->user_id = $userId;
        $bundleCourse->title = $request->title; 
        $bundleCourse->slug = Str::slug($request->title);
        $bundleCourse->selected_course = is_array($request->selected_course) ? implode(",",$request->selected_course) : $request->selected_course;
        $bundleCourse->price = $request->price;
        $bundleCourse->subscription_status = $request->subscription_status;
        $bundleCourse->short_description = $request->short_description;  
        $bundleCourse->status = $request->status;
        $bundleCourse->save();

        if ($request->hasFile('thumbnail')) { 
             // Delete old file
             if ($bundleCourse->thumbnail) {
                $oldFile = public_path('/assets/images/bundle-courses/'.$bundleCourse->thumbnail);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('thumbnail');
            $name = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/bundle-courses');
            $image->move($destinationPath, $name);
            $bundleCourse->thumbnail = $name; 
        }

        if ($request->hasFile('banner')) { 
             // Delete old file
             if ($bundleCourse->banner) {
                $oldFile = public_path('/assets/images/bundle-courses/'.$bundleCourse->banner);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            $image = $request->file('banner');
            $name = $bundleCourse->slug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/bundle-courses');
            $image->move($destinationPath, $name);
            $bundleCourse->banner = $name; 
        } 

        $bundleCourse->save();

        return redirect('admin/bundle/courses')->with('success', 'Bundle Course Updated!');
    }

    public function destroy($slug)
    {
        $bundleCourse = BundleCourse::where('slug', $slug)->first();
        if ($bundleCourse) {
            //delete thumbnail
            $oldThumbnail = public_path('/assets/images/bundle-courses/'.$bundleCourse->thumbnail);
            if (file_exists($oldThumbnail)) {
                @unlink($oldThumbnail);
            }
            //delete banner
            $oldBanner = public_path('/assets/images/bundle-courses/'.$bundleCourse->banner);
            if (file_exists($oldBanner)) {
                @unlink($oldBanner);
            }
            $bundleCourse->delete();
            return redirect('admin/bundle/courses')->with('success', 'Bundle Course deleted!');
        } else {
            return redirect('admin/courses')->with('error', 'Bundle Course not found!');
        }
    }
}
