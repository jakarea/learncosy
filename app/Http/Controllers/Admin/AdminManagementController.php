<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminManagementController extends Controller
{
    public function index()
    {
        $user_role = "admin";
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $users = User::where('user_role',$user_role)->orderBy('id', 'desc');
        if (!empty($name)) {
            $users->where('name', 'like', '%' . trim($name) . '%');
        }
        $users = $users->paginate(12);
        return view('admin/grid',compact('users'));
    }

     // create page
     public function create()
     {
         return view('admin/create');
     }

     // store page
    public function store(Request $request)
    {
    //    return $request->all();
    $request->validate([
           'name' => 'required|string',
           'phone' => 'required|string', 
           'email' => 'required|email|unique:users,email',
           'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
       ],
       [
           'avatar' => 'Max file size is 5 MB!'
       ]);

       // initial password for admin if admin create profile
       $initialPass = 1234567890;

       $social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
       // add admin
       $admin = new User([
           'name' => $request->name,
           'email' => $request->email,
           'user_role' => 'admin',
           'phone' => $request->phone,
           'short_bio' => $request->website,
           'company_name' => $request->company_name,
           'social_links' => trim($social_links,','),
           'description' => $request->description,
           'recivingMessage' => $request->recivingMessage,
           'password' => Hash::make($initialPass),
       ]);
 
        $adminslug = Str::slug($request->name);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $adminslug . '-' . uniqid() . '.png';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;
            $admin->avatar = $image_path;
        }

        $admin->save();
        return redirect('admin/alladmin')->with('success', 'Admin Added Successfully!');
    }

      // show page
      public function show($id)
      {
         $user = User::where('id', $id)->first();
         return view('admin/show',compact('user'));
      }

       // edit page
    public function edit($id)
    {
       $user = User::where('id', $id)->first();

       return view('admin/edit',compact('user'));
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
         $user->subdomain = $user->subdomain;
         if ($request->email) {
            $user->email =  $user->email;
         }
         $social_links = is_array($request->social_links) ? implode(",",$request->social_links) : $request->social_links;
         $user->company_name = $request->company_name;
         $user->short_bio = $request->website;
         $user->social_links = trim($social_links,',');
         $user->phone = $request->phone;
         $user->description = $request->description;
         $user->recivingMessage = $request->recivingMessage;

         if ($request->password) {
             $user->password = Hash::make($request->password);
         }else{
             $user->password = $user->password;
         }

         $slugg = Str::slug($request->name);

        if ($request->hasFile('avatar')) { 
            if ($user->avatar) {
               $oldFile = public_path($user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $slugg . '-' . uniqid() . '.png';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;
           $user->avatar = $image_path;
       }

         $user->save();
         return redirect('admin/alladmin')->with('success', 'Admin Profile has been Updated successfully!');
     }

     public function destroy($id){

        $admin = User::where('id', $id)->first();
         //delete admin avatar
         $adminOldThumbnail = public_path('uploads/users/'.$admin->avatar);
         if (file_exists($adminOldThumbnail)) {
             @unlink($adminOldThumbnail);
         }
        $admin->delete();

        return redirect('admin/alladmin')->with('success', 'Admin Successfully deleted!');
    }

}
