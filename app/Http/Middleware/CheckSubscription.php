<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Module;
use App\Models\Subscription;
use Illuminate\Http\Request;

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
        $user = auth()->user();
        
        if ($user) {
                        
            // Retrieve the user's subscription based on instructor_id
            $subscription = Subscription::where('instructor_id', $user->id)->first();
            if ($subscription && $subscription->ends_at && now() > $subscription->ends_at) {
                // Subscription expired, show alert or redirect
                return back()->with('error', 'Your subscription has expired. Please renew your subscription to access this feature.');
            }
    
            if (!$subscription) {
                // Subscription not found, show alert or redirect
                return redirect('custom/2')->with('error', 'You are not subscribed user. Please subscribe to access this feature.');
            }

            // Check User have set username or not
            if (!$user->username) {
                return redirect('custom/3')->with('error', 'Please set your username to access this feature.');
            }

            // Check Vimeo Data and Stripe Data
            if (!$user->vimeo_data && !$user->stripe_secret_key && !$user->stripe_public_key) {
                return redirect('custom/4')->with('error', 'Please complete your profile to access this feature.');
            }

            // Check Module data for instructor
            $modules = InstructorModuleSetting::where('instructor_id', $user->id)->first();
            if (!$modules) {
                return redirect('custom/5')->with('error', 'Please create a course to access this feature.');
            }

            //Check Course data for instructor
            $courses = Course::where('user_id', $user->id)->first();
            if (!$courses) {
                return redirect('custom/6')->with('error', 'Please create a course to access this feature.');
            }
        }
    
        return $next($request);
    }
}
