<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
     // stripe settings
     public function stripeIndex()
     {  
        $user = User::findorfail(auth()->user()->id);
        // return $user;
         return view('settings/instructor/stripe', compact('user'));
     }

     // Update stripe data
     public function stripeUpdate(Request $request)
     {
        $connet = '';
         $user = auth()->user();
         // stripe_secret_key and stripe_public_key is an valid stripe can access
         if (!$request->stripe_secret_key || !$request->stripe_public_key) {
             return back()->with('error', 'Please enter valid stripe keys');
         }

         $user->stripe_secret_key = $request->stripe_secret_key ? $request->stripe_secret_key : $user->stripe_secret_key;
         $user->stripe_public_key = $request->stripe_public_key ? $request->stripe_public_key : $user->stripe_public_key;
         $user->save();

         // check stripe connected or not
        if( !$user->stripe_secret_key || !$user->stripe_public_key ){
            $connet = 'not';
        }else{
            $connet = 'yes';
        }
         return back()->with('success', 'Stripe data updated successfully');
     }

     // vimeo settings
     public function vimeoIndex()
     {  
         return view('settings/instructor/vimeo'); 
     }
}
