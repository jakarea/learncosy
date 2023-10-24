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


            // $courseIds = Cart::where('user_id', auth()->id())->pluck('course_id')->toArray();
            // $courses = Course::whereIn('id', $courseIds)->get();
            // $course_price = 0;
            // $courseTitles = [];
            // foreach ($courses as $course) {

            //     Stripe::setApiKey( $course->user->stripe_secret_key);
            //     if($course->user->stripe_secret_key == null){
            //         return redirect()->route('students.show.courses', $course->slug)->with('error', 'Instructor has not connected with stripe yet. Remove that course from cart first please');
            //     }
            //     $courseTitles[] = $course->title;

            //     if($course->offer_price == 0){
            //         $course_price = $course_price + $course->price;
            //     }else{
            //         $course_price = $course_price + $course->offer_price;
            //     }

            //     $checkout = $course->checkouts()->where('user_id', auth()->user()->id)->first();

            //     if($checkout){
            //         return redirect()->route('students.show.courses', $course->slug)->with('error', 'You have already enrolled in this course. Remove that course from cart');
            //     }
            // }

            // $courseNames = implode(', ', $courseTitles);

            // $idsString = implode(',', $courseIds);

            // $checkout_session = Session::create([
            //     'payment_method_types' => ['card'],
            //     'line_items' => [[
            //         'price_data' => [
            //             'currency' => 'usd',
            //             'unit_amount' => $course_price * 100,
            //             'product_data' => [
            //                 'name' => $courseNames,
            //                 'images' => [asset('uploads/courses/new-budle-course-64cb5712834ef.jpg')],
            //             ],
            //         ],
            //         'quantity' => 1,
            //     ]],
            //     'mode' => 'payment',
            //     'success_url' => route('checkout.success', $idsString ) . '?session_id={CHECKOUT_SESSION_ID}',
            //     'cancel_url' => route('checkout.cancel', $idsString ),
            // ]);





            $instructor = User::findOrFail( $request->instructorId);

            // dd( $instructor);

            //Stripe::setApiKey($instructor->stripe_secret_key);
            try {
                $charge = Charge::create([
                    'amount'      => $request->amount * 100, // Amount in cents
                    'currency' => 'eur',
                    'source'      => $request->stripeToken,
                    'description' => 'Example Charge',
                ]);

                dd($charge);

                return redirect(route('students.catalog.courses'))->with('success', 'You have successfully enrolled in this course');;
            } catch (\Exception $e) {
                return redirect()->route('students.catalog.courses')->with('error', $e->getMessage());
            }


    }
}
