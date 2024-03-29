<?php
namespace App\Http\Controllers;

use App\Models\BundleCourse;
use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DataTables;
use Auth;

use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $cart = Cart::where(function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->leftJoin('users', 'carts.instructor_id', '=', 'users.id') // Join with 'instructor_id'
        ->select('carts.*', 'users.name', 'users.stripe_public_key') // Include 'stripe_public_key'
        ->get();

        return view('e-learning/course/students/cart',compact('cart'));
    }

    public function add($domain, $course)
    {
        $course = Course::findOrFail( $course );
        $userIdentifier = $_COOKIE['userIdentifier'];
        $instructor_id = $course->user_id;
        $instructor = User::where('id', $instructor_id)->firstOrFail();

        $user = auth()->user();
        $cart = Cart::firstOrNew([
            'user_id' => $user ? $user->id : NULL,
            'course_id' => $course->id,
        ]);

        if ($cart->exists) {
            return redirect()->route('students.catalog.courses', config('app.subdomain') )->with('error', 'Course already added to the cart');
        }

        $cart->price = $course->price;
        $cart->quantity = 1;
        $cart->instructor_id = $instructor->id;
        $cart->user_identifier = $userIdentifier;
        $cart->save();
        return redirect()->route('students.catalog.courses', config('app.subdomain') )->with('success', 'Course added to cart.');
    }


    public function buyCourse($domain, $course)
    {

        if (!auth()->check()) {
            $redirectUrl = route('buy.course', ['id' => $course, 'subdomain' => config('app.subdomain')]);
            session()->put('redirect_url', $redirectUrl);
            return redirect()->route('login', config('app.subdomain'));
        }

        $course = Course::findOrFail( $course );
        $userIdentifier = $_COOKIE['userIdentifier'];
        $instructor_id = $course->user_id;
        $instructor = User::where('id', $instructor_id)->firstOrFail();

        $user = auth()->user();
        $cart = Cart::firstOrNew([
            'user_id' => $user ? $user->id : NULL,
            'course_id' => $course->id,
        ]);

        if ($cart->exists) {
            return redirect()->route('cart.index', config('app.subdomain') );
        }

        $cart->price = $course->price;
        $cart->quantity = 1;
        $cart->instructor_id = $instructor->id;
        $cart->user_identifier = $userIdentifier;
        $cart->save();

        return redirect()->route('cart.index', config('app.subdomain') );
    }



    public function addToCartSkippLogin(Course $course)
    {
        $userIdentifier = $_COOKIE['userIdentifier'];

        $instructor_id = $course->user_id;
        $instructor = User::where('id', $instructor_id)->firstOrFail();

        $user = auth()->user();

        $cart = Cart::firstOrNew([
            'user_id' => $user ? $user->id : NULL,
            'course_id' => $course->id,
        ]);

        if ($cart->exists) {
            return back()->with('error', 'Course already added to the cart');
        }

        $cart->price = $course->price;
        $cart->quantity = 1;
        $cart->instructor_id = $instructor->id;
        $cart->user_identifier = $userIdentifier;
        $cart->save();
        return back()->with('success', 'Course added to cart.');
    }

    // public function addToCartBundlekippLogin(BundleCourse $bundlecourse)
    // {

    //     $userIdentifier = session()->getId();
    //     $userIdentifierData = Cookie::make('userIdentifier', $userIdentifier, 60 * 24 * 30); // Cookie expires in 30 days

    //     $instructor_id = $bundlecourse->instructor_id;
    //     $instructor = User::where('id', $instructor_id)->firstOrFail();

    //     $user = auth()->user();

    //     $cart = Cart::firstOrNew([
    //         'user_id' => $user ? $user->id : NULL,
    //         'bundle_course_id' => $bundlecourse->id,
    //     ]);

    //     if ($cart->exists) {
    //         return back()->with('error', 'Course already added to the cart');
    //     }

    //     $cart->bundleprice = $bundlecourse->regular_price;
    //     $cart->quantity = 1;
    //     $cart->instructor_id = $instructor->id;
    //     $cart->user_identifier = $userIdentifierData;
    //     $cart->save();
    //     return back()->with('success', 'Course added to cart.');
    // }





    public function remove($domain, $id){
        $cart = Cart::where('id', $id)->first();
        $cart->delete();
        return response()->json(['message' => 'Course Removed from cart Successfully.']);
    }

}



