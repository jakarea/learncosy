<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->get();
        $cartCount = Cart::where('user_id', auth()->id())->count();

        return view('e-learning/course/students/cart',compact('cart','cartCount'));
    }
    public function add(Course $course)
    {
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
        $cart->save();
        return redirect()->route('students.catalog.courses')->with('success', 'Course added to cart.');
    }
}



