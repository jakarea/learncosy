<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Module;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\InstructorModuleSetting;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = auth()->user()->user_role('instructor')->first();
        
        if (Auth::user()->user_role == 'instructor') {
                        
            // Retrieve the user's subscription based on instructor_id
            $subscription = Subscription::where('instructor_id', $user->id)->first();
            if ($subscription && $subscription->ends_at && now() > $subscription->ends_at) {
                // Subscription expired, show alert or redirect
                return back()->with('error', 'Your subscription has expired. Please renew your subscription to access this feature.');
            }
    
            if (!$subscription) {
                // Subscription not found, show alert or redirect
                return redirect('instructor/profile/step-2/complete')->with('error', 'You are not subscribed user. Please subscribe to access this feature.');
            }
            // else{
            //     return $next($request);
            // }

            // Check User have set username or not
            if (!$user->username) {
                return redirect('instructor/profile/step-3/complete')->with('error', 'Please set your username to access this feature.');
            }
            // else{
            //     return $next($request);
            // }

            // Check Vimeo Data and Stripe Data
            if (!$user->vimeo_data && !$user->stripe_secret_key && !$user->stripe_public_key) {
                return redirect('instructor/profile/step-4/complete')->with('error', 'Please complete your profile to access this feature.');
            }
            // else{
            //     return $next($request);
            // }

            // Check Module data for instructor
            $modules = InstructorModuleSetting::where('instructor_id', $user->id)->first();
            if (!$modules) {
                return redirect('instructor/profile/step-5/complete')->with('error', 'Please complete your profile to access this feature.');
            }
            else{
                return $next($request);
            }    
        }
    
        return $next($request);
    }
}
