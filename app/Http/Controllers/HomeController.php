<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Checkout;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    private $currentMonthStart;
    private $currentMonthEnd;
    private $previousMonthStart;
    private $previousMonthEnd;

    public function __construct()
    {
        $this->middleware('auth');
        $this->currentMonthStart = Carbon::now()->startOfMonth();
        $this->currentMonthEnd = Carbon::now()->endOfMonth();
        $this->previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $this->previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();
    }

    public function index()
    {
        return view('home');
    }

    public function studentsPayment()
    {

        $students = [];
        $todaysStudents = [];

        $status = isset($_GET['status']) ? $_GET['status'] : '';

        $enrolments = Checkout::with('course','user')->where('instructor_id',Auth::user()->id);

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

        $enrolments = $enrolments->paginate(10);

        $formatedPercentageChangeOfStudentEnrollByMonth = $this->getPercentageByMonthOfStudentEnrollment();
        $formatedPercentageChangeOfStudentEnrollByDay = $this->getPercentageByDayOfStudentEnrollment();
        $formattedPercentageChangeOfEarningByMonth = $this->getPercentageByMonthOfEarning();
        $formattedPercentageChangeOfEarningByDay = $this->getPercentageByDayOfEarning();

        $todaysEnrolments = Checkout::whereDate('created_at', Carbon::today())->where('instructor_id',Auth::user()->id)->orderBy('id', 'desc')->get();

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
        return view('payments/instructor/students-payment', compact('enrolments','totalEnrollment','todaysEnrollment','totalEnrollmentSell','todaysTotalEnrollmentSell','formatedPercentageChangeOfStudentEnrollByMonth','formatedPercentageChangeOfStudentEnrollByDay','formattedPercentageChangeOfEarningByMonth','formattedPercentageChangeOfEarningByDay'));


        // return view('payments/instructor/students-payment', compact('payments','todaysEarnings','todaysEnrolment','totalEarnings','totalEnrolment'));
    }

    public function details($payment_id)
    {
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->where('instructor_id',Auth::user()->id)->with('instructor','user','course')->first();
        return view('payments/instructor/details', compact('payment'));
    }

    public function adminPayment()
    {
        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', Auth::user()->id)->get();
        return view('payments/instructor/admin-payment', compact('payments'));
    }

    public function adminPaymentData( Request $request )
    {
        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', auth()->user()->id)->get();

        return datatables()->of($payments)
            ->addColumn('action', function ($payment) {
                $action = '<a href="' . route('admin.subscription.edit', $payment->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>';
                $action .= '<a href="' . route('admin.subscription.destroy', $payment->id) . '" class="btn btn-sm btn-danger delete_data" data-id="'.$payment->id.'"><i class="fas fa-trash"></i></a>';
                return $action;
            })
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

    public function generatePdf($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->where('instructor_id',Auth::user()->id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('invoice',$data);
        return $pdf->download('invoice-'.$payment_id.'.pdf');
    }

    public function invoiceMail($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->where('instructor_id',Auth::user()->id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment,
            'mail' => $payment->user->email,
            'payment_id' => 'invoice-'.$payment_id.'.pdf',
        );
        $pdf = Pdf::loadView('invoice',$data);
        if($data['mail'] != '')
        {
            Mail::send('invoice', $data, function($message) use ($data,$pdf) {
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

    public function export($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->where('instructor_id',Auth::user()->id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('adminInvoice',$data);
        return $pdf->download('invoice-'.$payment_id.'.pdf');
    }

    private function getEnrollmentData()
    {
        return Checkout::orderBy('id', 'desc')->where('instructor_id',Auth::user()->id)->get();
    }


    private function getEnrollmentByDateRange($startDate, $endDate)
    {
        return Checkout::whereBetween('created_at', [$startDate, $endDate])
                ->where('instructor_id',Auth::user()->id)
                ->orderBy('id', 'desc')
                ->get();
    }

    private function getEnrollmentByDate($date)
    {
        $carbonDate = Carbon::parse($date);
        return Checkout::whereDate('created_at', $carbonDate->toDateString())
            ->where('instructor_id',Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }


    private function getEnrollmentDataToday()
    {
        return Checkout::whereDate('created_at', Carbon::today())->where('instructor_id',Auth::user()->id)->orderBy('id', 'desc')->get();
    }


    public function getPercentageByMonthOfStudentEnrollment(){
        $currentMonthEnrolledStudents = [];
        $previousMonthEnrolledStudents = [];
        $currentMonthEnrollments = Checkout::whereYear('created_at', '=', now()->year)
                ->where('instructor_id',Auth::user()->id)
                ->whereMonth('created_at', '=', now()->month)
                ->get();
        $previousMonthEnrollments = Checkout::whereYear('created_at', '=', date('Y', strtotime('-1 month')))
            ->where('instructor_id',Auth::user()->id)
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
        $currentDayEnrollments = Checkout::whereDate('created_at', $currentDate->toDateString())->where('instructor_id',Auth::user()->id)->get();
        $previousDayEnrollments = Checkout::whereDate('created_at', $previousDate->toDateString())->where('instructor_id',Auth::user()->id)->get();

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
}
