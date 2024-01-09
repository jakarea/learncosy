<?php
namespace App\Http\Middleware;

use Auth;
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
        // Changes by Jakaria 
        $user = auth()->user();

        $modules = InstructorModuleSetting::where('instructor_id', $user->id)->first();
        if (Auth::user()->user_role == 'instructor') {

            // Retrieve the user's subscription based on instructor_id
            $subscription = Subscription::where('instructor_id', $user->id)->latest('created_at')->first();

            if ($subscription && $subscription->status == 'cancel') {
                return redirect('instructor/subscription')->with('error', 'You are not subscribed user. Please subscribe to access this feature.');
            }elseif ($subscription && $subscription->ends_at && now() > $subscription->ends_at) {
                // Subscription expired, show alert or redirect
                return redirect('instructor/subscription')->with('error', 'You are not subscribed user. Please subscribe to access this feature.');
            }elseif (!$subscription) {
                // Subscription not found, show alert or redirect
                return redirect('instructor/profile/step-2/complete')->with('success', 'Verification Successfully Done.'); 
            }elseif (!$user->subdomain) {
                return redirect('instructor/profile/step-3/complete')->with('error', 'Please set your subdomain to access this feature.');
            }elseif (!$modules) {
                // return redirect('instructor/profile/step-5/complete')->with('error', 'Please complete your profile to access this feature.');
                return redirect('instructor/profile/step-5/complete');
            }else{
                return $next($request);
            }

            // deactive vimeo account checking by nayan
            // elseif (!$user->vimeo_data && !$user->stripe_secret_key && !$user->stripe_public_key) {
            //     // return redirect('instructor/profile/step-4/complete')->with('error', 'Please complete your profile to access this feature.');
            //     return redirect('instructor/profile/step-4/complete');
            // }
        }

        return $next($request);
    }
}
