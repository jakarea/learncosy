<?php

namespace App\Http\Controllers;

use PDF;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;

class SubscriptionPaymentController extends Controller
{
    public function createPayment($id){
        $package = SubscriptionPackage::findorfail($id);
        return view('subscription/payment/payment',compact('package'));
    }

    public function payment(Request $request){

        $package = SubscriptionPackage::findorfail($request->packageId);

        $type = $package->type;
        // if type is monthly, then add 30 days to current date else add 365 days
        if ($type == 'monthly') {
            $ends_at = date('Y-m-d H:i:s', strtotime('+30 days'));
        } else {
            $ends_at = date('Y-m-d H:i:s', strtotime('+365 days'));
        }

        if( $package->sales_price ){
            $discountAmount = $package->regular_price - $package->sales_price;
            $total = $package->regular_price - $discountAmount;
        }else{
            $total = $package->regular_price;
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        try {

            $charge = Charge::create([
                'amount'      => $total * 100, // Amount in cents
                'currency' => 'eur',
                'source'      => $request->stripeToken,
                'description' => "Package Name: ".$package->name,
            ]);

            if( $charge->status == "succeeded"){
                $subscription = Subscription::create([
                    'subscription_packages_id' => $package->id,
                    'instructor_id' => auth()->user()->id,
                    'name' => $package->name,
                    'amount' => $total,
                    'stripe_plan' => 5465454,
                    'quantity' => 1,
                    'start_at' => date('Y-m-d H:i:s'),
                    'end_at' => $ends_at,
                ]);

                return redirect()->route('instructor.dashboard.index')->with('success', 'Subscribed Successfully');
            }

        } catch (\Exception $e) {
            return redirect()->route('instructor.dashboard.index')->with('error', $e->getMessage());
        }

    }

}
