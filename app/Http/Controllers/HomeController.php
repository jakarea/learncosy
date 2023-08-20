<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Subscription;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function studentsPayment()
    {
        // get all payments of the students who are enrolled in the courses of the instructor
        $payments = Checkout::courseEnrolledByInstructor()->with('course')->get();
        return view('payments/instructor/students-payment', compact('payments'));
    }

    public function details()
    {
        return view('payments/instructor/details');
    }

    public function adminPayment()
    {
        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', auth()->user()->id)->get();
        // dd($payments);
        return view('payments/instructor/admin-payment', compact('payments'));
    }

    public function adminPaymentData( Request $request )
    {
        $payments = Subscription::with(['subscriptionPakage'])->where('instructor_id', auth()->user()->id)->get();
        // dd($payments);
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
}
