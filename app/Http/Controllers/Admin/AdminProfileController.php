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
        $students = [];
        $todaysStudents = [];

        $status = isset($_GET['status']) ? $_GET['status'] : ''; 
        
        $enrolments = Checkout::with('course','user');

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


        $formatedPercentageChangeOfStudentEnrollByMonth = $this->getPercentageByMonthOfStudentEnrollment();
        $formatedPercentageChangeOfStudentEnrollByDay = $this->getPercentageByDayOfStudentEnrollment();
        $formattedPercentageChangeOfEarningByMonth = $this->getPercentageByMonthOfEarning();
        $formattedPercentageChangeOfEarningByDay = $this->getPercentageByDayOfEarning();

        $todaysEnrolments = Checkout::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();

        foreach ($enrolments as $enrolment) {
            $students[$enrolment->user_id] = $enrolment->created_at;
        }

        foreach ($todaysEnrolments as $enrolment) {
            $todaysStudents[$enrolment->user_id] = $enrolment->created_at;
        }
        
        $totalEnrollment =  count($students);
        $todaysEnrollment =  count($todaysStudents);

        $totalEnroll = $this->getEnrollmentData();
        $totalEnrollmentSell = $totalEnroll->sum('amount');

        $totalEnrollToday = $this->getEnrollmentDataToday();
        $todaysTotalEnrollmentSell = $totalEnrollToday->sum('amount');
        // return $enrolments; 
        return view('payments/admin/grid-admin-payment', compact('enrolments','totalEnrollment','todaysEnrollment','totalEnrollmentSell','todaysTotalEnrollmentSell','formatedPercentageChangeOfStudentEnrollByMonth','formatedPercentageChangeOfStudentEnrollByDay','formattedPercentageChangeOfEarningByMonth','formattedPercentageChangeOfEarningByDay'));
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

    private function getEnrollmentData()
    {
        return Checkout::orderBy('id', 'desc')->get();
    }


    private function getEnrollmentByDateRange($startDate, $endDate)
    {
        return Checkout::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('id', 'desc')
                ->get();
    }

    private function getEnrollmentByDate($date)
    {
        $carbonDate = Carbon::parse($date);
        return Checkout::whereDate('created_at', $carbonDate->toDateString())
            ->orderBy('id', 'desc')
            ->get();
    }


    private function getEnrollmentDataToday()
    {
        return Checkout::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
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

    public function getPercentageByMonthOfStudentEnrollment(){
        $currentMonthEnrolledStudents = [];
        $previousMonthEnrolledStudents = [];
        $currentMonthEnrollments = Checkout::whereYear('created_at', '=', now()->year)
                ->whereMonth('created_at', '=', now()->month)
                ->get();
        $previousMonthEnrollments = Checkout::whereYear('created_at', '=', date('Y', strtotime('-1 month')))
            ->whereMonth('created_at', '=', date('m', strtotime('-1 month')))
            ->get();
        foreach ($currentMonthEnrollments as $enrolment) {
            $currentMonthEnrolledStudents[$enrolment->user_id] = $enrolment->created_at;
        }

        foreach ($previousMonthEnrollments as $enrolment) {
            $previousMonthEnrolledStudents[$enrolment->user_id] = $enrolment->created_at;
        }

        $currentMonthEnrolledStudentsCount = count($currentMonthEnrolledStudents);
        $previousMonthEnrolledStudentsCount = count($previousMonthEnrolledStudents);

        if ($previousMonthEnrolledStudentsCount === 0) {
            $percentageChangeOfStudentEnroll = ($currentMonthEnrolledStudentsCount > 0) ? 100 : 0;
        } else {
            $percentageChangeOfStudentEnroll = (($currentMonthEnrolledStudentsCount - $previousMonthEnrolledStudentsCount) / abs($previousMonthEnrolledStudentsCount)) * 100;
        }
        return  number_format($percentageChangeOfStudentEnroll, 2);
    }

    public function getPercentageByDayOfStudentEnrollment(){
        $currentDayEnrolledStudents = [];
        $previousDayEnrolledStudents = [];
        $currentDate = Carbon::now();
        $previousDate = Carbon::now()->subDay();
        $currentDayEnrollments = Checkout::whereDate('created_at', $currentDate->toDateString())->get();
        $previousDayEnrollments = Checkout::whereDate('created_at', $previousDate->toDateString())->get();

        foreach ($currentDayEnrollments as $enrolment) {
            $currentDayEnrolledStudents[$enrolment->user_id] = $enrolment->created_at;
        }

        foreach ($previousDayEnrollments as $enrolment) {
            $previousDayEnrolledStudents[$enrolment->user_id] = $enrolment->created_at;
        }

        $currentDayEnrolledStudentsCount = count($currentDayEnrolledStudents);
        $previousDayEnrolledStudentsCount = count($previousDayEnrolledStudents);

        if ($previousDayEnrolledStudentsCount === 0) {
            $percentageChangeOfStudentEnroll = ($currentDayEnrolledStudentsCount > 0) ? 100 : 0;
        } else {
            $percentageChangeOfStudentEnroll = (($currentDayEnrolledStudentsCount - $previousDayEnrolledStudentsCount) / abs($previousDayEnrolledStudentsCount)) * 100;
        }
        return  number_format($percentageChangeOfStudentEnroll, 2);
    }


    public function getPercentageByMonthOfEarning(){
        $currentMonthStart = $this->currentMonthStart;
        $currentMonthEnd = $this->currentMonthEnd;
        $previousMonthStart = $this->previousMonthStart;
        $previousMonthEnd = $this->previousMonthEnd;
        $currentMonthEnrollment = $this->getEnrollmentByDateRange($currentMonthStart, $currentMonthEnd);
        $previousMonthEnrollment = $this->getEnrollmentByDateRange($previousMonthStart, $previousMonthEnd);
        $currentMonthTotalSell = $currentMonthEnrollment->sum('amount');
        $previousMonthTotalSell = $previousMonthEnrollment->sum('amount');
        $percentageChange = 0;
        if($previousMonthTotalSell){
            $percentageChange = (($currentMonthTotalSell - $previousMonthTotalSell) / abs($previousMonthTotalSell)) * 100;
        }
            
        return $formattedPercentageChangeOfEarning = round($percentageChange, 2);
    }

    public function getPercentageByDayOfEarning(){
        $today = Carbon::today()->toDateString();
        $previousDay = Carbon::yesterday()->toDateString();
        $currentDayEnrollment = $this->getEnrollmentByDate($today);
        $previousDayEnrollment = $this->getEnrollmentByDate($previousDay);
        $currentDayTotalSell = $currentDayEnrollment->sum('amount');
        $previousDayTotalSell = $previousDayEnrollment->sum('amount');
        // dd( $previousMonthTotalSell);
        $percentageChange = 0;
        if($previousDayTotalSell){
            $percentageChange = (($currentDayTotalSell - $previousDayTotalSell) / abs($previousDayTotalSell)) * 100;
        }
        
        return $formattedPercentageChangeOfEarning = round($percentageChange, 2);
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
