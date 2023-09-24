<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Checkout;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $status = isset($_GET['status']) ? $_GET['status'] : '';

        // get all payments of the students who are enrolled in the courses of the instructor
        $payments = Checkout::courseEnrolledByInstructor()->where('instructor_id',Auth::user()->id);
    

        if ($status) {
            if ($status == 'asc') {
                $payments->orderBy('id', 'asc');
            }
            
            if ($status == 'desc') {
                $payments->orderBy('id', 'desc');
            }
        }else{
            $payments->orderBy('id', 'desc'); 
        }

        $payments = $payments->paginate(12);

        return view('payments/instructor/students-payment', compact('payments'));
    }

    public function details($payment_id)
    {
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();
        return view('payments/instructor/details', compact('payment'));
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

    public function generatePdf($payment_id){
        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();
        $data = array(
            'payment' => $payment
        );
        $pdf = Pdf::loadView('invoice',$data);
        return $pdf->download('invoice-'.$payment_id.'.pdf');
    }
}
