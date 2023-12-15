<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VimeoData;
use Illuminate\Http\Request;
use Stripe\Exception\AuthenticationException;
use Illuminate\Support\Facades\Http;

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

     public function vimeoUpdate(Request $request)
     {
        // return 1234;
        $user = auth()->user();

        // Define custom error messages
        $messages = [
            'client_id.required' => 'Please enter a valid Vimeo client id.',
            'client_secret.required' => 'Please enter a valid Vimeo client secret.',
            'access_key.required' => 'Please enter a valid Vimeo access key.',
        ];

         // Validate the Vimeo keys using the Vimeo package's validation feature
        $request->validate([
             'client_id' => [
                 'required'
             ],
             'client_secret' => 'required',
             'access_key' => 'required',
        ], $messages);


        $access = $request->access_key;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access,
        ])->get('https://api.vimeo.com/me');

        if ($response->successful()) {
            $vimeo = VimeoData::updateOrCreate(
                ['user_id' => $user->id],
                [
                'client_id' => $request->client_id,
                'client_secret' => $request->client_secret,
                'access_key' => $request->access_key,
                ]
            );

            $connected = ($user->client_id && $user->client_secret && $user->access_key) ? 'yes' : 'not';

            return back()->with('success', 'Vimeo data updated successfully');
        }else{
            return back()->with('error', 'The provided Vimeo access key is invalid.');
        }
     }
}
