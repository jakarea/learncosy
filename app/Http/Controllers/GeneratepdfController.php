<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use App\Models\Checkout;
use App\Models\Subscription;
use Illuminate\Support\Facades\Crypt;

class GeneratepdfController extends Controller
{
    public function generatePdf($payment_id){
        // return 'generate pdf';
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Generate PDF</h1>');
        // return $pdf->download();

        $payment_id = Crypt::decrypt($payment_id);
        $payment = Checkout::where('payment_id',$payment_id)->with('instructor','user','course')->first();

        $data = array(
            'payment' => $payment
        );
        
        $pdf = Pdf::loadView('invoice',$data);
        return $pdf->download('invoice.pdf',);


    }
}
