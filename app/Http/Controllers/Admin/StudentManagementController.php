<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DataTables;
use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; 

class StudentManagementController extends Controller
{
    // list page 
    public function index()
    {   
        $user_role = "student";
        $users = User::where('user_role',$user_role)->get();

         return view('students/admin/grid',compact('users'));  
    }

    // data table getData
    public function studentsDataTable()
    {       $user_role = "student";
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
                                    <a class="dropdown-item" href="/admin/students/profile/'.$user->id.'"> <i class="fas fa-eye"></i></a>  
                                    <a class="dropdown-item" href="/admin/students/'.$user->id.'/edit"> <i class="fas fa-pen"></i></a>  
                                    <form method="post" class="d-inline btn btn-danger" action="/admin/students/'.$user->id.'/destroy">  
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
                        return '<img src="/assets/images/students/'.$user->avatar.'" width="50" />';
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
        return view('students/admin/create'); 
    }

    // store page 
    public function store(Request $request)
     {  
        // return $request->all();

        $request->validate([
            'name' => 'required|string', 
            'short_bio' => 'string',
            'phone' => 'string',
            'email' => 'required|email|unique:users,email', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [ 
            'avatar' => 'Max file size is 5 MB!'
        ]);

        // initial password for student if instructor create profile
        $initialPass = 1234567890;

        // add student
        $student = new User([
            'name' => $request->name, 
            'email' => $request->email,
            'phone' => $request->phone,
            'short_bio' => $request->short_bio,
            'social_links' => is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links,
            'description' => $request->description,
            'recivingMessage' => $request->recivingMessage,
            'password' => Hash::make($initialPass),
        ]);  

        $studentslug = Str::slug($request->name);
         //if avatar is valid then save it
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = $studentslug.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/images/students');
            $image->move($destinationPath, $name);
            $student->avatar = $name;
        } 

        $student->save();
        return redirect('admin/students')->with('success', 'Student Added Successfully!');

     }

     // show page 
    public function show($id)
    {  
       $student = User::where('id', $id)->first();
       $checkout = Checkout::where('user_id', $id)->with('course')->get();
       return view('students/admin/show',compact('student', 'checkout')); 
    }

    // show page 
    public function edit($id)
     {  
        $student = User::where('id', $id)->first();
      
        return view('students/admin/edit',compact('student'));
     }

     public function update(Request $request,$id)
     {
        //  return $request->all();
 
         $userId = $id;  
 
         $this->validate($request, [
             'name' => 'required|string', 
             'short_bio' => 'string',
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
         }else{
            $user->username = $user->username;
        } 

         $user->short_bio = $request->short_bio;
         $user->social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
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
               $oldFile = public_path('/assets/images/students/'.$user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           } 
           $slugg = Str::slug($request->name);
           $image = $request->file('avatar');
           $name = $slugg.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/assets/images/students');
           $image->move($destinationPath, $name);
           $user->avatar = $name; 
       }
 
         $user->save();
         return redirect()->route('admin.allStudents')->with('success', 'Students Profile has been Updated successfully!');
     }

     public function destroy($id){
         
        $student = User::where('id', $id)->first();
         //delete student avatar
         $studentOldThumbnail = public_path('/assets/images/students/'.$student->avatar);
         if (file_exists($studentOldThumbnail)) {
             @unlink($studentOldThumbnail);
         } 
        $student->delete();

        return redirect('admin/students')->with('success', 'Student Successfully deleted!');
    }

}
