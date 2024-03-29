<?php

namespace App\Http\Controllers;

// use PDF;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Barryvdh\DomPDF\Facade\Pdf;

class SubscriptionPaymentController extends Controller
{

    public function index()
    {

        $packages = SubscriptionPackage::where('status','active')->get();
        $insPackage = Subscription::where('instructor_id', Auth::id())->latest('created_at')->first();

        if (!$insPackage) {
            $activePackageId = null;
        }

        if ($insPackage && $insPackage->status == 'cancel') {
            $activePackageId = null;
        }

        if ($insPackage && $insPackage->status != 'cancel' && $insPackage->subscription_packages_id) {
            $activePackageId = $insPackage->subscription_packages_id;
        }

        return view('subscription/instructor/list',compact('packages','activePackageId'));
    }

    public function createPayment($domain, $id){
        $package = SubscriptionPackage::findorfail($id);
        return view('subscription/payment/payment',compact('package'));
    }

    public function payment(Request $request){

        // dd( $request->all() );
        $package = SubscriptionPackage::findOrfail($request->packageId);
        $current_package = Subscription::where('status','active')->where('instructor_id',auth()->user()->id)->first();
        $subscription = Subscription::where(['subscription_packages_id' => $request->packageId, 'instructor_id' => auth()->user()->id])->first();
        if($subscription ){
            return redirect('instructor/profile/step-3/complete')->with('success', 'Alrady You have purchase the package!!');
        }

        if ($current_package) {
            $current_package->status = 'cancel';
            $current_package->save();
        }

        $type = $package->type;
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
                    'stripe_plan' => $charge->id,
                    'status' => 'active',
                    'quantity' => 1,
                    'start_at' => date('Y-m-d H:i:s'),
                    'end_at' => $ends_at,
                ]);

                $pdf = PDF::loadView('emails.package.subscribe', ['data' => $package, 'subscription' => $subscription]);
                $pdfContent = $pdf->output();

                // Send the email with the PDF attachment
                $mailInfo = Mail::send('emails.invoice', ['data' => $package, 'subscription' => $subscription], function($message) use ($package, $pdfContent, $subscription) {
                    $message->to(auth()->user()->email)
                            ->subject('Invoice')
                            ->attachData($pdfContent,  $subscription->name.'.pdf', ['mime' => 'application/pdf']);
                });

                if (Auth::user()->subdomain) {
                    return redirect()->route('instructor.dashboard.index',['subdomain' => config('app.subdomain')])->with('success', 'Subscribed Successfully');
                }else{
                    return redirect('instructor/profile/step-3/complete')->with('success', 'Subscribed Successfully');
                }

            }

        } catch (\Exception $e) {
            return redirect()->route('instructor.dashboard.index',['subdomain' => config('app.subdomain')])->with('error', $e->getMessage());
        }

    }

    public function cancel()
    {
        //
        return redirect()->route('instructor.dashboard.index')->with('error', 'Subscription cancelled');
    }
    public function status($doamin, $id)
    {
        //
        $subscription = Subscription::where('subscription_packages_id',$id)->where('instructor_id',Auth::user()->id)->latest('created_at')->first();
        $subscription->status = 'cancel';
        $subscription->save();

        $pdf = PDF::loadView('emails.package.cancle', ['subscription' => $subscription]);
        $pdfContent = $pdf->output();

        // Send the email with the PDF attachment
        $mailInfo = Mail::send('emails.package.cancle', ['subscription' => $subscription], function($message) use ($pdfContent, $subscription) {
            $message->to(auth()->user()->email)
                    ->subject('Invoice')
                    ->attachData($pdfContent,  $subscription->name.'.pdf', ['mime' => 'application/pdf']);
        });

        return redirect()->back()->with('success', 'Subscription Cancelled!');
    }

}
