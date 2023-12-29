<?php
namespace App\Http\Controllers\Payment;

use Stripe\Charge;

use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Notification;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PaymentController extends Controller
{
    public function processPayment(Request $request) {

        $courseIds = Cart::where('user_id', auth()->id())->pluck('course_id')->toArray();
        $courses = Course::whereIn('id', $courseIds)->get();
        $course_price = 0;
        $courseTitles = [];
        foreach ($courses as $course) {
            Stripe::setApiKey( $course->user->stripe_secret_key);
            if($course->user->stripe_secret_key == null){
                return redirect()->route('students.show.courses', $course->slug)->with('error', 'Instructor has not connected with stripe yet. Remove that course from cart first please');
            }
            $courseTitles[]= $course->title;

            if($course->offer_price == 0){
                $course_price = $course_price + $course->price;
            }else{
                $course_price = $course_price + $course->offer_price;
            }
        }

        $courseNames = implode(', ', $courseTitles);

        $instructor = User::findOrFail($request->instructorId);

        Stripe::setApiKey($instructor->stripe_secret_key);
        try {
            $charge = Charge::create([
                'amount'      => $course_price * 100, // Amount in cents
                'currency' => 'eur',
                'source'      => $request->stripeToken,
                'description' => $courseNames,
            ]);

            $this->success($charge);

            return redirect(route('students.catalog.courses', config('app.subdomain') ))->with('success', 'You have successfully enrolled in this course');;
        } catch (\Exception $e) {
            return redirect()->route('students.catalog.courses', config('app.subdomain'))->with('error', $e->getMessage());
        }
    }

    public function success($charge)
    {
        $courseIds = Cart::where('user_id', auth()->id())->pluck('course_id')->toArray();

        foreach ($courseIds as $courseId) {
            $course = Course::where('id', $courseId)->first();
                // Store the transaction in the checkout table
                $checkout = $course->checkouts()->create([
                    'course_id' => $course->id,
                    'instructor_id' => $course->user_id,
                    'payment_method' => "Stripe",
                    'payment_status' => $charge->paid? 'completed' : '',
                    'payment_id' => $charge->id,
                    'status' => $charge->status,
                    'amount' => $charge->amount_captured / 100,
                    'start_date' =>  $start_date = now()->toDateTimeString()
                ]);

                $notify = new Notification([
                    'user_id'   => Auth::user()->id,
                    'instructor_id' => $course->user_id,
                    'course_id' => $course->id,
                    'type'      => 'instructor',
                    'message'   => "enrolled",
                    'status'   => 'unseen',
                ]);
                $notify->save();

                // $pdf = PDF::loadView('emails.invoice', ['data' => $checkout]);
                // $pdfContent = $pdf->output();

                // // Send the email with the PDF attachment
                // $mailInfo = Mail::send('emails.invoice', ['data' => $checkout], function($message) use ($checkout, $pdfContent) {
                //     $message->to(auth()->user()->email)
                //             ->subject('Invoice')
                //             ->attachData($pdfContent,  $checkout->payment_method.'.pdf', ['mime' => 'application/pdf']);
                // });

            }
            $cartItems = Cart::where('user_id', auth()->id())->delete();

    }
}
