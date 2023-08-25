<?php

namespace App\Http\Controllers\Admin;

use Auth; 
use DataTables;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
     // list page 
     public function index()
     {    
        $user_role = "instructor"; 

        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $users = User::where('user_role',$user_role)->orderBy('id', 'desc');
        if (!empty($name)) {
            $users->where('name', 'like', '%' . trim($name) . '%');
        }
        $users = $users->paginate(12);
 
        return view('instructor/admin/grid',compact('users')); 
     }

     // data table getData
    public function instructorDataTable()
    {       $user_role = "instructor";
            $user = User::where('user_role',$user_role)->get();
          
            return Datatables::of($user)
                ->addColumn('action', function($user){ 
                     
                    $actions = '<div class="action-dropdown">
                        <div class="dropdown">
                            <a class="btn btn-drp" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="bttns-wrap"> 
                                    <a class="dropdown-item" href="/admin/instructor/profile/'.$user->id.'"> <i class="fas fa-eye"></i></a>  
                                    <a class="dropdown-item" href="/admin/instructor/'.$user->id.'/edit"> <i class="fas fa-pen"></i></a>  
                                    <form method="post" class="d-inline btn btn-danger" action="/admin/instructor/'.$user->id.'/destroy">  
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
                ->editColumn('image', function ($user) { 
                    if($user->avatar){
                        return '<img src="/assets/images/instructor/'.$user->avatar.'" width="50" />';
                    }else{ 
                        return '<div class="table-avatar">
                                <span>'.strtoupper($user->name[0]).'</span>
                            </div>';
                    } 
            })
            ->editColumn('status', function ($user) {
                if($user->recivingMessage == 1){
                    return '<label class="badge bg-success">'.__('Enabled').'</label>';
                }
                if($user->recivingMessage == 0){
                    return '<label class="badge bg-danger">'.__('Disabled').'</label>';
                } 
             })
            ->addIndexColumn()
            ->rawColumns(['action', 'image','status'])
            ->make(true);
    }

     // create page 
     public function create()
     {  
         return view('instructor/admin/create');
     }

     // store page 
    public function store(Request $request)
    {  
    //    return $request->all();

       $request->validate([
           'name' => 'required|string', 
           'phone' => 'string',
           'email' => 'required|email|unique:users,email', 
           'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
       ],
       [ 
           'avatar' => 'Max file size is 5 MB!'
       ]);

       // initial password for instructor if admin create profile
       $initialPass = 1234567890;

       // add instructor
       $instructor = new User([
           'name' => $request->name,
           'username' => $request->username,
           'user_role' => 'instructor',
           'email' => $request->email,
           'phone' => $request->phone,
           'short_bio' => $request->short_bio,
           'social_links' => is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links,
           'description' => $request->description,
           'recivingMessage' => $request->recivingMessage,
           'password' => Hash::make($initialPass),
       ]);  

       $instructorslug = Str::slug($request->name);
        //if avatar is valid then save it
       if ($request->hasFile('avatar')) {
           $image = $request->file('avatar');
           $name = $instructorslug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/assets/images/instructor');
           $image->move($destinationPath, $name);
           $instructor->avatar = $name;
       } 

       $instructor->save();
       return redirect('admin/instructor')->with('success', 'instructor Added Successfully!');

    }

    // show page 
    public function show($id)
     {  
        $instructor = User::where('id', $id)->first();

        $subscription = Subscription::where('instructor_id', $id)->get();
    
        return view('instructor/admin/show',compact('instructor', 'subscription')); 
     }

      // show page 
    public function edit($id)
    {  
       $instructor = User::where('id', $id)->first();
       
       return view('instructor/admin/edit',compact('instructor'));
    }

    public function update(Request $request,$id)
    {
       //  return $request->all();

        $userId = $id;  

        $this->validate($request, [
            'name' => 'required|string', 
            'phone' => 'required|string', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [ 
            'avatar' => 'Max file size is 5 MB!'
        ]);

       
        $user = User::where('id', $userId)->first();
        $user->name = $request->name;
        if ($request->username) {
           $user->username =  Str::slug($request->username);
        }
        if ($request->user_role) {
           $user->user_role =  $user->user_role;
        }
        $user->short_bio = $request->short_bio;
        $user->social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->recivingMessage = $request->recivingMessage;
        $user->email = $user->email; 
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        } 

        if ($request->hasFile('avatar')) { 
           // Delete old file
           if ($user->avatar) {
              $oldFile = public_path('/assets/images/instructor/'.$user->avatar);
              if (file_exists($oldFile)) {
                  unlink($oldFile);
              }
          } 
          $slugg = Str::slug($request->name);
          $image = $request->file('avatar');
          $name = $slugg.'-'.uniqid().'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/assets/images/instructor');
          $image->move($destinationPath, $name);
          $user->avatar = $name; 
      }

        $user->save();
        return redirect('admin/instructor')->with('success', 'Instructor Profile has been Updated successfully!');
    }

    public function destroy($id){
         
        $instructor = User::where('id', $id)->first();
         //delete instructor avatar
         $instructorOldThumbnail = public_path('/assets/images/instructor/'.$instructor->avatar);
         if (file_exists($instructorOldThumbnail)) {
             @unlink($instructorOldThumbnail);
         }
         
         \App\Models\BundleCourse::where('user_id', $id)->delete();
         \App\Models\Checkout::where('instructor_id', $id)->delete();
         \App\Models\Course::where('user_id', $id)->delete();
         \App\Models\CourseActivity::where('user_id', $id)->delete();
         \App\Models\InstructorModuleSetting::where('instructor_id', $id)->delete();
         \App\Models\Message::where('user_id', $id)->delete();
         \App\Models\Module::where('user_id', $id)->delete();
         \App\Models\Subscription::where('instructor_id', $id)->delete();
         \App\Models\VimeoData::where('user_id', $id)->delete();
        $instructor->delete();

        return redirect('admin/instructor')->with('success', 'Instructor Successfully deleted!');
    }
}
