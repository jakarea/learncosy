<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Mail;



class SubscriptionPaymentController extends Controller
{
    public function create($id){
        // return $id;

        // dd( Auth::user());

        $package = SubscriptionPackage::findorfail($id);

        // monthly or yearly
        $type = $package->type;
        // if type is monthly, then add 30 days to current date else add 365 days
        if ($type == 'monthly') {
            $ends_at = date('Y-m-d H:i:s', strtotime('+30 days'));
        } else {
            $ends_at = date('Y-m-d H:i:s', strtotime('+365 days'));
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $package->sales_price ? $package->sales_price * 100 : $package->regular_price  * 100,
            'currency' => 'eur',
            'description' => 'Payment for XYZ service',
            'confirmation_method' => 'automatic',
            'payment_method_types' => ['card'],
            'capture_method' => 'automatic',
        ]);

        $subscription = Subscription::create([
            'subscription_packages_id' => $id,
            'instructor_id' => 46,
            'name' => $package->name,
            'amount' => $package->sales_price ? $package->sales_price : $package->regular_price,
            'stripe_plan' => $paymentIntent->id,
            'quantity' => 1,
            'start_at' => date('Y-m-d H:i:s'),
            'end_at' => $ends_at,
        ]);

        // Generate and save the PDF file
        $pdf = PDF::loadView('emails.invoice', ['data' => $package, 'subscription' => $subscription]);
        $pdfContent = $pdf->output();

        // Send the email with the PDF attachment
        Mail::send('emails.invoice', ['data' => $package, 'subscription' => $subscription], function($message) use ($package, $pdfContent, $subscription) {
            $message->to(auth()->user()->email)
                    ->subject('Invoice')
                    ->attachData($pdfContent,  $subscription->name.'.pdf', ['mime' => 'application/pdf']);
        });

        // return back with success message
        return redirect()->route('instructor.dashboard.index')->with('success', 'Subscribed Successfully');


    }
}
