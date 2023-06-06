<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Course;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\SubscriptionPackage;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
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
                        'unit_amount' => $package->amount * 100,
                        'product_data' => [
                            'name' => $package->name,
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('subscription.success') . '?session_id={CHECKOUT_SESSION_ID}' . '&package_id=' . $package->id,
            'cancel_url' => route('subscription.cancel'),
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
    public function success_url( Request $request )
    {
        //
        $session_id = request()->session_id;

        $session = Session::retrieve($session_id);

        $package = SubscriptionPackage::findorfail($request->package_id);

        // Subscription store in database

        $subscription = Subscription::create([
            'instructor_id' => auth()->user()->id,
            'name' => $package->id,
            'stripe_plan' => $session->payment_intent,
            'quantity' => 1,
            'start_at' => date('Y-m-d H:i:s'),
            'ends_at' => date('Y-m-d H:i:s', strtotime('+60 days')),
        ]);

        // return back with success message
        return redirect()->route('admin.dashboard')->with('success', 'Subscription created successfully');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel_url()
    {
        //
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
