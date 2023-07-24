<?php

namespace App\Http\Middleware;

use Closure;
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
                return back()->with('error', 'You are not subscribed user. Please subscribe to access this feature.');
            }
        }
    
        return $next($request);
    }
}
