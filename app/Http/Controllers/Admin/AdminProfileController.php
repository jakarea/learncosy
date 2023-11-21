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
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5000',
        ],
        [ 
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

        $adSlugg = Str::slug($request->name);

        if ($request->hasFile('avatar')) { 
            if ($user->avatar) {
               $oldFile = public_path($user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
            $file = $request->file('avatar');
            $image = Image::make($file);
            $uniqueFileName = $adSlugg . '-' . uniqid() . '.png';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;

           $user->avatar = $image_path;
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
        //  return $request->all();

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

    public function adminPayment()
    { 

        $status = isset($_GET['status']) ? $_GET['status'] : ''; 
        $enrolments = Subscription::with('instructor');

        if ($status) {
            if ($status == 'asc') {
                $enrolments->orderBy('id', 'asc');
            }
            
            if ($status == 'desc') {
                $enrolments->orderBy('id', 'desc');
            }
        }else{
            $enrolments->orderBy('id', 'desc'); 
        }

        $enrolments = $enrolments->paginate(6); 
 

        $today = Carbon::today();

        // last one year
        $oneYearAgo = Carbon::parse($today)->subYear();
        $lastOneyear = $enrolments
            ->where('start_at', '>=', $oneYearAgo)
            ->where('start_at', '<', $today)
            ->sum('amount'); 

        // last 2 years
        $oneTwoYearAgo = Carbon::parse($today)->subYears(2);
        $earningsLastTwoYears = $enrolments
            ->where('start_at', '>=', $oneTwoYearAgo)
            ->where('start_at', '<', Carbon::parse($today)->subYears(1))
            ->sum('amount');
       
        // todays earning
        $earningsToday = $enrolments
            ->where('start_at', '>=', $today)
            ->where('start_at', '<', $today->copy()->addDay())
            ->sum('amount'); 

        // yesterday earnings
        $yesterday = Carbon::parse($today)->subDay();
        $earningsYesterday = $enrolments
        ->where('start_at', '>=', $yesterday)
        ->where('start_at', '<', $today)
        ->sum('amount');

        // total enrollments
        $totalEnrollments = Checkout::count();
        $enrollesToday = Checkout::
            where('start_date', '>=', $today)
            ->where('start_date', '<', $today->copy()->addDay())
            ->count(); 

        // today enrollments
        $todaysEnrolments = Subscription::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();

        return view('payments/admin/grid-admin-payment', compact('enrolments','todaysEnrolments','earningsYesterday','lastOneyear','earningsLastTwoYears','earningsToday','totalEnrollments','enrollesToday'));
    }

    public function details($stripe_plan)
    {
        $stripe_plan = Crypt::decrypt($stripe_plan);

        $payment = Subscription::where('stripe_plan',$stripe_plan)->with('instructor','subscriptionPakage')->first();
        return view('payments/admin/details', compact('payment'));
    }

    public function export($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('adminInvoice',$data);
        return $pdf->download('invoice-'.$payment_id.'.pdf');
    }

    public function view($payment_id)
    {
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();
        return view('payments/admin/view', compact('payment'));
    }

    public function generatePdf($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('adminInvoice',$data);
        return $pdf->download('invoice-'.$payment_id.'.pdf');
    }

    public function mailInvoice($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment,
            'mail' => $payment->user->email,
            'payment_id' => 'invoice-'.$payment_id.'.pdf',
        );
        $pdf = Pdf::loadView('adminInvoice',$data);
        if($data['mail'] != '')
        {
            Mail::send('adminInvoice', $data, function($message) use ($data,$pdf) {
                        $message->to($data['mail'])
                                ->subject('Payment Invoice')
                                ->attachData($pdf->output(),$data['payment_id']);
            });
            return redirect()->back()->with('success', 'Payment Invoice sent to mail successfully.');
        }
        else
        {
            return redirect()->back()->with('warning', 'User mail address not set.Mail not sent!!!');
        }
    } 


    public function coverUpload(Request $request)
    {
        if ($request->hasFile('cover_photo')) {
            $coverPhoto = $request->file('cover_photo');

            $userId = Auth::user()->id;
            $user = User::where('id', $userId)->first();
            $adSlugg = Str::slug($user->name);

            if ($user->cover_photo) {
                $oldFile = public_path($user->cover_photo);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
            $file = $request->file('cover_photo');
            $image = Image::make($file);
            $uniqueFileName = $adSlugg . '-' . uniqid() . '.jpg';
            $image->save(public_path('uploads/users/') . $uniqueFileName);
            $image_path = 'uploads/users/' . $uniqueFileName;

            $user->cover_photo = $image_path; 
            $user->save();
    
            return response()->json(['message' => "UPLOADED"]);
        }
    
        return response()->json(['error' => 'No image uploaded'], 400);
    } 

}
