<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DataTables;

class StudentController extends Controller
{
    // list page 
    public function index()
     {   
         return view('students/instructor/index'); 
     }

     // data table getData
    public function studentsDataTable()
    {       $user_role = "students";
            $user = User::select('id','name','user_name','avatar','email','phone','recivingMessage','user_role')->get();
          
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
                                    <a class="dropdown-item" href="/instructor/students/profile/'.$user->id.'"> <i class="fas fa-eye"></i></a>  
                                    <a class="dropdown-item" href="/instructor/students/'.$user->id.'/edit"> <i class="fas fa-pen"></i></a>  
                                    <form method="post" class="d-inline btn btn-danger" action="/instructor/students/'.$user->id.'/destroy">  
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
                        return '<img src="/assets/images/user/'.$user->avatar.'" width="50" />';
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
         return view('students/instructor/create'); 
     }

    // store page 
    public function store(Request $request)
     {  
        // return $request->all();

        $request->validate([
            'name' => 'required|string',
            'user_role' => 'required|string',
            'short_bio' => 'string',
            'phone' => 'string',
            'email' => 'required|email|unique:users,email', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ]);


        // add student
        $student = new User([
            'name' => $request->name,
            'user_role' => $request->user_role,
            'email' => $request->email,
            'phone' => $request->phone,
            'short_bio' => $request->short_bio,
            'social_links' => is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links,
            'description' => $request->description,
            'recivingMessage' => $request->recivingMessage,
            'password' => 12345678,
        ]);  
 


        $studentslug = Str::slug($request->name);
         //if avatar is valid then save it
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = $studentslug.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/user');
            $image->move($destinationPath, $name);
            $student->avatar = $name;
        } 

        $student->save();
        return redirect('instructor/students')->with('success', 'Student Added Successfully!');

     }

    // show page 
    public function show($id)
     {  
        $student = User::where('id', $id)->first();
    
        return view('students/instructor/show',compact('student')); 
     }

    // show page 
    public function edit($id)
     {  
        $student = User::where('id', $id)->first();
        
        return view('students/instructor/edit',compact('student'));
     }

     public function update(Request $request,$id)
     {
        //  return $request->all();
 
         $userId = $id;  
 
         $this->validate($request, [
             'name' => 'required|string',
             'user_role' => 'required|string',
             'short_bio' => 'required|string',
             'phone' => 'required|string',
             'email' => 'required|email|unique:users,email,'.$userId, 
             'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
         ]);
 
        
         $user = User::where('id', $userId)->first();
         $user->name = $request->name;
         if ($request->username) {
            $user->username =  Str::slug($request->username);
         }
         $user->short_bio = $request->short_bio;
         $user->social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
         $user->user_role = $request->user_role;
         $user->phone = $request->phone;
         $user->description = $request->description;
         $user->recivingMessage = $request->recivingMessage;
         $user->email = $request->email;
         if ($request->password) {
             $user->password = Hash::make($request->password);
         }else{
             $user->password = $user->password;
         } 
 
         if ($request->avatar) {
             $userSlug = Str::slug($user->name); 
             $imageName = $userSlug.'.'.request()->avatar->getClientOriginalExtension();
             request()->avatar->move(public_path('assets/images/user'), $imageName); 
             $user->avatar = $imageName;
         }
 
         $user->save();
         return redirect()->route('allStudents')->with('success', 'Students Profile has been Updated successfully!');
     }

     public function destroy($id){
         
        $student = User::where('id', $id)->first();
         //delete student avatar
         $studentOldThumbnail = public_path('/assets/images/user/'.$student->avatar);
         if (file_exists($studentOldThumbnail)) {
             @unlink($studentOldThumbnail);
         } 
        $student->delete();

        return redirect('instructor/students')->with('success', 'Student Successfully deleted!');
    }
}
