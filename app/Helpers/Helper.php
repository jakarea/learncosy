<?php

/**
 * Helper function to get SubscriptionPackage
 */
if (!function_exists('getSubscriptionPackage')) {
    function getSubscriptionPackage()
    {
        return \App\Models\SubscriptionPackage::where('status', 'active')->get();
    }
}

/**
 * Helper function to check if user has subscription if subscription is active then show subscribed based on package id
 */
if (!function_exists('hasSubscription')) {
    function hasSubscription($package_id)
    {
        $user = auth()->user();

        if ($user) {
            // Retrieve the user's subscription based on instructor_id
            $subscription = \App\Models\Subscription::where('instructor_id', $user->id)->first();

            if ($subscription && $subscription->ends_at && now() > $subscription->ends_at) {
                // Subscription expired, show alert or redirect
                return false;
            }

            if (!$subscription) {
                // Subscription not found, show alert or redirect
                return false;
            }

            if ($subscription->subscription_package_id == $package_id) {
                return true;
            }
        }

        return false;
    }
}

/**
 * Helper function to check if user has subscribed then change package button to subscribed
 */
if (!function_exists('isSubscribed')) {
    function isSubscribed($package_id)
    {
        $user = auth()->user();
        
        if ($user) {
            // Retrieve the user's subscription based on instructor_id
            $subscription = \App\Models\Subscription::where('instructor_id', $user->id)->first();

            if ($subscription && $subscription->end_at && now() > $subscription->end_at) {
                // Subscription expired
                return false;
            }

            if (!$subscription || $subscription->name != $package_id) {
                // Subscription not found or not matching package_id
                return false;
            }
        } else {
            // User is not authenticated
            return false;
        }

        // User is subscribed and matches the package_id
        return true;
    }
}
