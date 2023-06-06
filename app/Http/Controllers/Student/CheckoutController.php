<?php

namespace App\Http\Controllers\Student;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * Configure Stripe
     */
    public function __construct()
    {
        Stripe::setApiKey(auth()->user()->stripe_secret_key ?? env('STRIPE_SECRET'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        //
        $course = Course::where('slug', $slug)->first();

        if($course->offer_price == 0){
            $course_price = $course->price;
        }else{
            $course_price = $course->offer_price;
        }

        // check if checkout table has the logged in user id and course id
        $checkout = $course->checkouts()->where('user_id', auth()->user()->id)->first();

        if($checkout){
            return redirect()->route('students.show.courses', $course->slug)->with('error', 'You have already enrolled in this course');
        }

        // Create a checkout session
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $course_price * 100,
                    'product_data' => [
                        'name' => $course->title,
                        'images' => [asset('assets/images/courses/' . $course->thumbnail)],
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', $course->slug) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel', $course->slug),
        ]);

        return redirect($checkout_session->url);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function success($slug)
    {
        $session_id = Session::all()['data'][0]['id'];
        // Find the course based on the slug
        $course = Course::where('slug', $slug)->first();
        $start_date = null;
        $end_date = null;
        // start_date end_date add based on course subscription_status
        if($course->subscription_status == 'one_time'){
            $start_date = null;
            $end_date = null;
        }else if($course->subscription_status == 'monthly'){
            $start_date = now()->toDateTimeString();
            $end_date = now()->addMonth();
        }else if($course->subscription_status == 'anully'){
            $start_date = now()->toDateTimeString();
            $end_date = now()->addYear();
        }else if($course->subscription_status == 'Free'){
            $start_date = null;
            $end_date = null;
        }

        // return $start_date . ' ' . $end_date;

        try {
            // Retrieve the payment data and amount using the session ID
            $session = Session::retrieve($session_id);
            $payment_id = $session->payment_intent;
            $paymentMethod = 'Stripe';
            $amount = $session->amount_total / 100;
    

    
            // Attach the user to the course with the payment details
            $course->students()->attach(auth()->user()->id, [
                'payment_method' => $paymentMethod,
                'amount' => $amount,
                'paid' => true,
                'start_at' => $start_date,
                'end_at' => $end_date,
            ]);
    
            // Store the transaction in the checkout table
            $checkout = $course->checkouts()->create([
                'course_id' => $course->id,
                'payment_method' => $paymentMethod,
                'payment_status' => 'paid',
                'payment_id' => $payment_id,
                'status' => 'completed',
                'amount' => $amount,
                'start_date' => $start_date,
                'end_date' => $end_date,
            ]);
    
            if ($checkout) {
                return redirect()->route('students.show.courses', $course->slug)->with('success', 'You have successfully enrolled in this course');
            } else {
                return redirect()->route('students.show.courses', $course->slug)->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the process
            return redirect()->route('students.show.courses', $slug)->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel($slug)
    {
        //
        return redirect()->route('students.show.courses', $slug)->with('error', 'You have cancelled the payment');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
