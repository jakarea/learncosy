<?php

use Stripe\Stripe;
use Vimeo\Laravel\Facades\Vimeo;
use Vimeo\Vimeo as VimeoSDK;
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

/**
 * Helper function to check logged in user is connected with stripe or not if connected then show connected and store data in $account
 */
if (!function_exists('isConnectedWithStripe')) {
    function isConnectedWithStripe()
    {
        $user = auth()->user();
        $account = null;
        $status = '';
    
        if ($user->stripe_secret_key && $user->stripe_public_key) {
            Stripe::setApiKey($user->stripe_secret_key);
            // Retrieve the user's stripe data based on user_id
            $account = \Stripe\Account::retrieve($user->stripe_account_id);
            $status = 'Connected';
    
            if (!$account) {
                // Stripe account not found, show alert or redirect
                $status = 'Not Connected';
                return [$account, $status];
            }
        } else {
            // User is not authenticated
            $status = 'Not Connected';
            return [$account, $status];
        }
    
        return [$account, $status];
    }    
}

/**
 * Helper function to check logged in user role is student and check if user has enrolled in course or not
 */
if (!function_exists('isEnrolled')) {
    function isEnrolled($course_id)
    {
        $user = auth()->user();
        $enrolled = false;

        if ($user) {
            // Retrieve the user's checkout based on user_id and course_id
            $checkout = \App\Models\Checkout::where('user_id', $user->id)->where('course_id', $course_id)->first();

            if ($checkout) {
                $enrolled = true;
            }
        }

        return $enrolled;
    }
}

/**
 * Helper function to Get first lesson by course id
 */
if (!function_exists('getFirstLesson')) {
    function getFirstLesson($courseId)
    {
        $lesson = \App\Models\Lesson::where('course_id', $courseId)->orderBy('id', 'asc')->first();
        return $lesson;
    }
}

/**
 * Helper function to check vimeo data is connected or not
 */
if (!function_exists('isVimeoConnected')) {
    function isVimeoConnected()
    {
        $user = auth()->user();
        $vimeoData = null;
        $status = '';
    
        if ($user) {
            $vimeoData = \App\Models\VimeoData::where('user_id', $user->id)->first();
    
            if (!$vimeoData) {
                // Vimeo data not found, show alert or redirect
                $status = 'Not Connected';
                return [$vimeoData, $status];
            } else {
                // Check vimeo data is connected or not to Vimeo API in real-time
                $vimeo = new \Vimeo\Vimeo($vimeoData->client_id, $vimeoData->client_secret, $vimeoData->access_key);
                
                try {
                    $response = $vimeo->request('/me');
                    $accountName = $response['body']['name'];
                    $status = 'Connected';
                } catch (\Vimeo\Exceptions\VimeoUploadException $e) {
                    $status = 'Invalid Credentials';
                    return [$vimeoData, $status];
                } catch (\Exception $e) {
                    // Handle any other exceptions or errors that occurred during the request
                    $status = 'Connection Failed';
                    return [$vimeoData, $status];
                }
            }
        } else {
            // User is not authenticated
            $status = 'Not Connected';
            return [$vimeoData, $status];
        }
    
        return [$vimeoData, $status, $accountName];
    }
}
