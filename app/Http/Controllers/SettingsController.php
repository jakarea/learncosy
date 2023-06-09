<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Exception\AuthenticationException;

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
         $user = auth()->user();
     
         // Define custom error messages
         $messages = [
             'stripe_secret_key.required' => 'Please enter a valid Stripe secret key.',
             'stripe_public_key.required' => 'Please enter a valid Stripe public key.',
         ];
     
         // Validate the Stripe keys using the Stripe package's validation feature
         $request->validate([
             'stripe_secret_key' => [
                 'required',
                 function ($attribute, $value, $fail) {
                     try {
                         \Stripe\Stripe::setApiKey($value);
                         \Stripe\Account::retrieve();
                     } catch (AuthenticationException $e) {
                         $fail('Please enter a valid Stripe secret key.');
                        $messages['stripe_secret_key.required'] = 'Please enter a valid Stripe secret key.';
                     }
                 },
             ],
             'stripe_public_key' => 'required',
         ], $messages);
     
         $user->stripe_secret_key = $request->stripe_secret_key;
         $user->stripe_public_key = $request->stripe_public_key;
         $user->save();
     
         // Check if both keys are present
         $connected = ($user->stripe_secret_key && $user->stripe_public_key) ? 'yes' : 'not';
     
         return back()->with('success', 'Stripe data updated successfully');
     }
          

     // vimeo settings
     public function vimeoIndex()
     {  
         return view('settings/instructor/vimeo'); 
     }
}
