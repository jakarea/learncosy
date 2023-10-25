<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        //$courseIds = Cart::where('user_id', auth()->id())->pluck('course_id')->toArray();
        //return $courses = Course::whereIn('id', $courseIds)->get();
        $cart = Cart::where('user_id', auth()->id())
        ->join('users', 'carts.instructor_id', '=', 'users.id')
        ->get(['carts.*', 'users.name', 'users.stripe_secret_key', 'users.stripe_public_key', 'users.id']);


        return view('e-learning/course/students/cart',compact('cart'));
    }
    public function add(Course $course)
    {
        $instructor_id = $course->user_id;
        $instructor = User::where('id', $instructor_id)->firstOrFail();

        $user = auth()->user();
        $cart = Cart::firstOrNew([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        if ($cart->exists) {
            return redirect()->route('students.catalog.courses')->with('error', 'Course already added to the cart');
        }

        $cart->price = $course->price;
        $cart->quantity = 1;
        $cart->instructor_id = $instructor->id;
        $cart->save();
        return redirect()->route('students.catalog.courses')->with('success', 'Course added to cart.');
    }

    public function remove($id){

        $cart = Cart::where('id', $id)->first();

        $cart->delete();

        return redirect()->back()->with('success', 'Course Removed from cart Successfully.');
    }


    public function removeItemFromCart(Request $request){

        $cart = Cart::where('id', $request->id)->first();

        $cart->delete();

        return redirect()->back()->with('success', 'Course Removed from cart Successfully.');
    }
}



