<?php
namespace App\Http\Controllers\Payment;

use Stripe\Charge;

use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function processPayment(Request $request) {

        return $request->all();

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
            return redirect(route('students.catalog.courses'))->with('success', 'You have successfully enrolled in this course');;
        } catch (\Exception $e) {
            return redirect()->route('students.catalog.courses')->with('error', $e->getMessage());
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
                    'payment_method' => $charge->payment_method,
                    'payment_status' => $charge->paid? 'completed' : '',
                    'payment_id' => $charge->id,
                    'status' => $charge->status,
                    'amount' => $charge->amount_captured,
                    'start_date' =>  $start_date = now()->toDateTimeString()
                ]);
            }
            $cartItems = Cart::where('user_id', auth()->id())->delete();
    }
}
