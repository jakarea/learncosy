<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Subscription;
use App\Models\Checkout;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\PasswordChanged;
use App\Mail\ProfileUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
               $oldFile = public_path('/assets/images/users/'.$user->avatar);
               if (file_exists($oldFile)) {
                   unlink($oldFile);
               }
           }
           $slugg = Str::slug($request->name);
           $image = $request->file('avatar');
           $name = $slugg.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/assets/images/users');
           $image->move($destinationPath, $name);
           $user->avatar = $name;
       }

        $user->save();

        // Send email
        Mail::to($user->email)->send(new ProfileUpdated($user));
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

        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', 1)->paginate(12);
        $enrolments = Checkout::orderBy('id', 'desc')->get();


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

        return view('payments/admin/grid-admin-payment', compact('payments','totalEnrollment','todaysEnrollment','totalEnrollmentSell','todaysTotalEnrollmentSell','formatedPercentageChangeOfStudentEnrollByMonth','formatedPercentageChangeOfStudentEnrollByDay','formattedPercentageChangeOfEarningByMonth','formattedPercentageChangeOfEarningByDay'));
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
        $percentageChange = (($currentMonthTotalSell - $previousMonthTotalSell) / abs($previousMonthTotalSell)) * 100;
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

        $percentageChange = (($currentDayTotalSell - $previousDayTotalSell) / abs($previousDayTotalSell)) * 100;
        return $formattedPercentageChangeOfEarning = round($percentageChange, 2);
    }


}
