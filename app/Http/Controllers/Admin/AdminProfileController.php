<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Subscription;
use App\Models\User;
use App\Mail\PasswordChanged;
use App\Mail\ProfileUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordChanged;
use App\Mail\ProfileUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; 

class AdminProfileController extends Controller
{
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
        // return $request->all();

        $userId = Auth()->user()->id;  

        $this->validate($request, [
            'name' => 'required|string',
            'short_bio' => 'required|string',
            'phone' => 'required|string', 
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ]);

       
        $user = User::where('id', $userId)->first();
        $user->name = $request->name;
        $user->username =  Str::slug($request->username);
        $user->short_bio = $request->short_bio;
        $user->social_links = implode(",",$request->social_links);
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
               $oldFile = public_path('/assets/images/admin/'.$user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           } 
           $slugg = Str::slug($request->name);
           $image = $request->file('avatar');
           $name = $slugg.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/assets/images/admin');
           $image->move($destinationPath, $name);
           $user->avatar = $name; 
       }

        $user->save();

        // Send email
        Mail::to($user->email)->send(new ProfileUpdated($user));
<<<<<<< HEAD

=======
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
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
        //  return $request->all();

        //validate password and confirm password
        $this->validate($request, [
            'password' => 'required|confirmed|min:6|string',
        ]);

        $userId = Auth()->user()->id; 
        $user = User::where('id', $userId)->first();
        $user->password = Hash::make($request->password);

        $user->save();
<<<<<<< HEAD

         // Send email
         Mail::to($user->email)->send(new PasswordChanged($user));

=======
        
        // Send email
        Mail::to($user->email)->send(new PasswordChanged($user));
>>>>>>> 23902a78a3679af5b8b1afe7e3c961a5059d961e
        return redirect()->route('admin.profile')->with('success', 'Your password has been changed successfully!');
    }

    public function adminPayment()
    {   
        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', 1)->get();
        return view('payments/admin/admin-payment', compact('payments'));
    }

    public function adminPaymentData( Request $request )
    {
        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', 1)->get();
        // dd($payments);
        return datatables()->of($payments)
            // ->addColumn('action', function ($payment) {
            //     $action = '<a href="' . route('admin.subscription.edit', $payment->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
            //     $action .= '<a href="' . route('admin.subscription.destroy', $payment->id) . '" class="btn btn-sm btn-danger delete_data" data-id="'.$payment->id.'"><i class="fas fa-trash"></i></a>';
            //     return $action;
            // })
            // instructor name from instructor_id
            ->editColumn('instructor_id', function ($payment) {
                return $payment->instructor->email;
            })
            ->editColumn('amount', function ($payment) {
                return $payment->subscriptionPakage->amount;
            })
            ->rawColumns(['action', 'status', 'features'])
            ->make(true);
        
        
    }
}
