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

class AdminPaymentController extends Controller
{
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

        $enrolments = $enrolments->paginate(12);


        $today = Carbon::today();



        $totalEarningsUntilToday = Subscription::whereDate('created_at', '<=', now())
                        ->sum('amount');

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


        $numberOfEnrollments = Checkout::where('payment_status', 'completed')->count();

        $percentageEnrollments = ($totalEnrollments > 0)
                            ? number_format((Checkout::where('payment_status', 'completed')->count() / $totalEnrollments) * 100, 2)
                            : 0;

        // today enrollments
        $todaysEnrolments = Subscription::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();

        return view('payments/admin/grid-admin-payment', compact('enrolments','todaysEnrolments','earningsYesterday','lastOneyear','earningsLastTwoYears','earningsToday','totalEnrollments','enrollesToday','percentageEnrollments','totalEarningsUntilToday'));
    }

    public function details($stripe_plan)
    {
        $stripe_plan = Crypt::decrypt($stripe_plan);

        $payment = Subscription::where('stripe_plan',$stripe_plan)->with('instructor','subscriptionPakage')->first();
        return view('payments/admin/details', compact('payment'));
    }

    public function export($stripe_plan){
        $stripe_plan = Crypt::decrypt($stripe_plan);

         $payment = Subscription::where('stripe_plan',$stripe_plan)->with('instructor','subscriptionPakage')->first();
         $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('payments/admin/export-invoice',$data);
        return $pdf->download('invoice-'.$stripe_plan.'.pdf');
    }

    public function generatePdf($stripe_plan){
        $stripe_plan = Crypt::decrypt($stripe_plan);

         $payment = Subscription::where('stripe_plan',$stripe_plan)->with('instructor','subscriptionPakage')->first();
         $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('payments/admin/export-invoice',$data);
        return $pdf->download('invoice-'.$stripe_plan.'.pdf');
    }

    public function invoiceMail($stripe_plan){

        $stripe_plan = Crypt::decrypt($stripe_plan);
        $payment = Subscription::where('stripe_plan',$stripe_plan)->with('instructor','subscriptionPakage')->first();
        $data = array(
            'payment' => $payment,
            'mail' => $payment->instructor->email,
            'stripe_plan' => 'invoice-'.$stripe_plan.'.pdf',
        );
        $pdf = Pdf::loadView('payments/admin/export-invoice',$data);
        if($data['mail'] != '')
        {
            Mail::send('payments/admin/export-invoice', $data, function($message) use ($data,$pdf) {
                        $message->to($data['mail'])
                                ->subject('Payment Invoice')
                                ->attachData($pdf->output(),$data['stripe_plan']);
            });
            return redirect()->back()->with('success', 'Payment Invoice sent to mail successfully.');
        }
        else
        {
            return redirect()->back()->with('warning', 'User mail address not set.Mail not sent!!!');
        }
    }


}
