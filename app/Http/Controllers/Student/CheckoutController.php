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
        Stripe::setApiKey(env('STRIPE_SECRET'));
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
        // return to stripe checkout page with course offer_price and if offer_price is null then course price
        // return '<img src="'.asset('assets/images/courses/' . $course->thumbnail).'" width="100px" height="100px" />';
        if($course->offer_price == 0){
            $course_price = $course->price;
        }else{
            $course_price = $course->offer_price;
        }

        // Configure Stripe
        // Stripe::setApiKey(env('STRIPE_SECRET'));

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
            'success_url' => route('checkout.success', $course->slug),
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
        try {
            // Retrieve the payment data and amount using the session ID
            $session = Session::retrieve($session_id);
            $payment_id = $session->payment_intent;
            $paymentMethod = 'Stripe';
            $amount = $session->amount_total / 100;
    
            // Find the course based on the slug
            $course = Course::where('slug', $slug)->first();
    
            // Attach the user to the course with the payment details
            $course->students()->attach(auth()->user()->id, [
                'payment_method' => $paymentMethod,
                'amount' => $amount,
                'paid' => true,
                'start_at' => now(),
                'end_at' => now()->addMonth(), // or any other logic to determine the end date
            ]);
    
            // Store the transaction in the checkout table
            $checkout = $course->checkouts()->create([
                'course_id' => $course->id,
                'payment_method' => $paymentMethod,
                'payment_status' => 'paid',
                'payment_id' => $payment_id,
                'status' => 'completed',
                'amount' => $amount,
                'start_date' => now(),
                'end_date' => now()->addMonth(),
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
    public function store(Request $request, $slug)
    {
        //
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
