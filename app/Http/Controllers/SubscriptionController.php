<?php
namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Course;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\PackageSubscribe;
use Stripe\Checkout\Session;
use App\Mail\PackageSubscribeCancle;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscriptionPackage;
use PDF;
class SubscriptionController extends Controller
{
    /**
     * Configure Stripe
     */
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd( Auth::id());

        $packages = SubscriptionPackage::where('status','active')->get();
        $insPackage = Subscription::where('instructor_id', Auth::id())->latest('created_at')->first();

        if ($insPackage && $insPackage->status == 'cancel') {
            $activePackageId = null;
        }else{
            $activePackageId = $insPackage ? $insPackage->subscriptionPakage->id : null;
        }

        return view('subscription/instructor/list',compact('packages','activePackageId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // before redirect to stripe checkout page, check if .env file has STRIPE_KEY and STRIPE_SECRET
        if(!env('STRIPE_KEY') || !env('STRIPE_SECRET')) {
            return redirect()->back()->with('error', 'Please provide stripe key and secret in .env file');
        }
        // redirect to stripe checkout page
        $package = SubscriptionPackage::findorfail($id);
        if(!$package) {
            return redirect()->back()->with('error', 'Subscription package not found');
        }
        $checkout = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $package->sales_price ? $package->sales_price * 100 : $package->regular_price  * 100,
                        'product_data' => [
                            'name' => $package->name,
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('instructor.subscription.success') . '?session_id={CHECKOUT_SESSION_ID}' . '&package_id=' . $package->id,
            'cancel_url' => route('instructor.subscription.cancel'),
        ]);

        return redirect($checkout->url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function success( Request $request )
    {
        //
        $session_id = request()->session_id;

        $session = Session::retrieve($session_id);

        $package = SubscriptionPackage::findorfail($request->package_id);

        // monthly or yearly
        $type = $package->type;
        // if type is monthly, then add 30 days to current date else add 365 days
        if ($type == 'monthly') {
            $ends_at = date('Y-m-d H:i:s', strtotime('+30 days'));
        } else {
            $ends_at = date('Y-m-d H:i:s', strtotime('+365 days'));
        }

        // Subscription store in database

        $subscription = Subscription::create([
            'subscription_packages_id' => $request->package_id,
            'instructor_id' => auth()->user()->id,
            'name' => $package->name,
            'amount' => $package->sales_price ? $package->sales_price : $package->regular_price,
            'stripe_plan' => $session->payment_intent,
            'quantity' => 1,
            'start_at' => date('Y-m-d H:i:s'),
            'end_at' => $ends_at,
        ]);

        // return redirect()->route('instructor.dashboard.index')->with('success', 'Stop Here'); 

        // Generate and save the PDF file
        $pdf = PDF::loadView('emails.invoice', ['data' => $package, 'subscription' => $subscription]);
        $pdfContent = $pdf->output();

        // Send the email with the PDF attachment
        $mailInfo = Mail::send('emails.invoice', ['data' => $package, 'subscription' => $subscription], function($message) use ($package, $pdfContent, $subscription) {
            $message->to(auth()->user()->email)
                    ->subject('Invoice')
                    ->attachData($pdfContent,  $subscription->name.'.pdf', ['mime' => 'application/pdf']);
        });

        // dd($mailInfo);

        // return back with success message
        return redirect()->route('instructor.dashboard.index')->with('success', 'Subscribed Successfully');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        //
        return redirect()->route('instructor.dashboard.index')->with('error', 'Subscription cancelled');
    }
    public function status($id)
    {
        //
        $subscription = Subscription::where('subscription_packages_id',$id)->where('instructor_id',Auth::user()->id)->latest('created_at')->first();
        $subscription->status = 'cancel';
        $subscription->save();

        return redirect()->back()->with('error', 'Subscription Cancelled');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
