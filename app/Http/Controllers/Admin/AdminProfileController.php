<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Subscription;
use App\Models\Checkout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\PasswordChanged;
use App\Mail\ProfileUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    private $currentMonthStart;
    private $currentMonthEnd;
    private $previousMonthStart;
    private $previousMonthEnd;

    public function __construct()
    {
        $this->currentMonthStart = Carbon::now()->startOfMonth();
        $this->currentMonthEnd = Carbon::now()->endOfMonth();
        $this->previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $this->previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();
    }

    // profile show
    public function show()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('profile/admin/profile',compact('user'));
    }

    // profile edit
    public function edit()
    {
        $userId = Auth()->user()->id;
        $user = User::find($userId);
        return view('profile/admin/edit',compact('user'));
    }

    public function update(Request $request)
    { 

        $userId = Auth::user()->id;

        $this->validate($request, [
            'name' => 'required|string', 
            'phone' => 'required|string',
            'email' => 'required',
            'base64_avatar' => 'nullable|string',
        ],
        [ 
            'base64_avatar' => 'Max file size is 5 MB!',
            'avatar' => 'Max file size is 5 MB!'
        ]);


        $user = User::where('id', $userId)->first();
        $user->name = $request->name;
        $user->subdomain =  Str::slug($request->subdomain);
        $user->short_bio = $request->website;
        $user->company_name = $request->company_name;
        $user->social_links = $request->social_links ? implode(",",$request->social_links) : '';
        $user->phone = $request->phone;
        $user->description = $request->description;
        $user->recivingMessage = $request->recivingMessage;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }else{
            $user->password = $user->password;
        }

        if ($request->base64_avatar != NULL) {
            $base64Image = $request->input('base64_avatar');
            if ($user->avatar) {
                $oldFile = public_path($user->avatar);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            list($type, $data) = explode(';', $base64Image);
            list(, $data) = explode(',', $data);
            $decodedImage = base64_decode($data); 
            $slugg = Str::slug($request->name); 
            $uniqueFileName = $slugg . '-' . uniqid() . '.png';
            $path = 'public/uploads/users/' . $uniqueFileName;
            $path2 = 'storage/uploads/users/' . $uniqueFileName;
            Storage::put($path, $decodedImage); 
            $user->avatar = $path2;
         }

        $user->save();

        // Send email
        // Mail::to($user->email)->send(new ProfileUpdated($user));
        return redirect()->route('admin.profile')->with('success', 'Your Profile has been Updated successfully!');
    }

    // password update
    public function passwordUpdate()
    {
        $userId = Auth()->user()->id;
        $user = User::find($userId);
        return view('profile/admin/password-change',compact('user'));
    }

    public function postChangePassword(Request $request)
    { 

        //validate password and confirm password
        $this->validate($request, [
            'password' => 'required|confirmed|min:6|string',
        ]);

        $userId = Auth()->user()->id;
        $user = User::where('id', $userId)->first();
        $user->password = Hash::make($request->password);

        $user->save();

        // Send email
        Mail::to($user->email)->send(new PasswordChanged($user));
        return redirect()->route('admin.profile')->with('success', 'Your password has been changed successfully!');
    } 


    public function coverUpload(Request $request)
    {
        if ($request->cover_photo != NULL) {

            $userId = $request->userId;
            $base64ImageCover = $request->cover_photo;
            $user = User::where('id', $userId)->first();
            
            if ($user->cover_photo) {
                $oldFile = public_path($user->cover_photo);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            } 
            list($type, $data) = explode(';', $base64ImageCover);
            list(, $data) = explode(',', $data);
            $decodedImage = base64_decode($data); 
            $slugg = Str::slug($request->name); 
            $uniqueFileName = $slugg . '-' . uniqid() . '.png';
            $path = 'public/uploads/users/' . $uniqueFileName;
            $path2 = 'storage/uploads/users/' . $uniqueFileName;
            Storage::put($path, $decodedImage); 
            $user->cover_photo = $path2;

            $user->save();
            return response()->json(['message' => "UPLOADED"]);
         }
    
        return response()->json(['error' => 'No cover image uploaded'], 400);
        
    } 

}
