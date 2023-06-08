<?php

namespace App\Http\Controllers;

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
        return view('payments/instructor/students-payment');
    }

    public function adminPayment()
    {
        return view('payments/instructor/admin-payment');
    }

    public function adminPaymentData( Request $request )
    {
        $payments = Subscription::where('instructor_id', auth()->user()->id)->get();
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
            ->rawColumns(['action', 'status', 'features'])
            ->make(true);
        
        
    }
}
