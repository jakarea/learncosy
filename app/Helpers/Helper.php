<?php

use App\Models\User;
use Stripe\Stripe;
use Vimeo\Vimeo as VimeoSDK;
use Vimeo\Laravel\Facades\Vimeo;
/**
 * Helper function to get SubscriptionPackage
 */
if (!function_exists('getSubscriptionPackage')) {
    function getSubscriptionPackage()
    {
        // subscription package
        
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

/**
 * Helper function to check if user has completed lesson or not
 */
if (!function_exists('isLessonCompleted')) {
    function isLessonCompleted($lesson_id)
    {
        $user = auth()->user();
        $completed = false;

        if ($user) {
            // Retrieve the user's lesson based on user_id and lesson_id
            $lesson = \App\Models\CourseActivity::where('user_id', $user->id)->where('lesson_id', $lesson_id)->first();

            if ($lesson) {
                $completed = true;
            }
        }

        return $completed;
    }
}

/**
 * Helper function to total course count by instructor
 */
if (!function_exists('totalCourseByInstructor')) {
    function totalCourseByInstructor($user_id)
    {
        $totalCourse = \App\Models\Course::where('user_id', $user_id)->count();
        return $totalCourse;
    }
}

/**
 * Helper function to total student enrolled course of logged in instructor and count by instructor
 */
if (!function_exists('totalEnrolledOfStudentByInstructor')) {
    function totalEnrolledOfStudentByInstructor($user_id)
    {
        $course = \App\Models\Course::where('user_id', $user_id)->get();

        $enrolled = \App\Models\Checkout::whereIn('course_id', $course->pluck('id'))->count();
        return $enrolled;
    }
}

/**
 * Helper function to total earning of logged in instructor
 */
if (!function_exists('totalEarningByInstructor')) {
    function totalEarningByInstructor($user_id)
    {
        $course = \App\Models\Course::where('user_id', $user_id)->get();

        $earning = \App\Models\Checkout::whereIn('course_id', $course->pluck('id'))->sum('amount');
        return $earning;
    }
}

/**
 * Helper function to subscription cost of logged in instructor
 */
if (!function_exists('subscriptionCostByInstructor')) {
    function subscriptionCostByInstructor($user_id)
    {
        $subscriptionCost = \App\Models\Subscription::where('instructor_id', $user_id)->get();

        $amount = 0;

        if( $subscriptionCost->count() > 0 ) { 
            $amount = \App\Models\SubscriptionPackage::where('id', $subscriptionCost->pluck('name'))->sum('amount');
        }
        return $amount;
    }
}

/**
 * Helper function to count total enrolled of course by student
 */
if (!function_exists('totalEnrolledByStudent')) {
    function totalEnrolledByStudent($user_id)
    {
        $totalEnrolled = \App\Models\Checkout::where('user_id', $user_id)->count();
        return $totalEnrolled;
    }
}

/**
 * Helper function to count total complete lessons by student
 */
if (!function_exists('totalCompleteLessonsByStudent')) {
    function totalCompleteLessonsByStudent($user_id)
    {
        $totalCompleteLessons = \App\Models\CourseActivity::where('user_id', $user_id)->count();
        return $totalCompleteLessons;
    }
}

/**
 * Helper function to count total complete CourseReviews by student
 */
if (!function_exists('totalCompleteCourseReviewsByStudent')) {
    function totalCompleteCourseReviewsByStudent($user_id)
    {
        $totalCompleteCourseReviews = \App\Models\CourseReview::where('user_id', $user_id)->count();
        return $totalCompleteCourseReviews;
    }
}

/**
 * Helper function to count total amount paid by student
 */
if (!function_exists('totalAmountPaidByStudent')) {
    function totalAmountPaidByStudent($user_id)
    {
        $totalAmountPaid = \App\Models\Checkout::where('user_id', $user_id)->sum('amount');
        return $totalAmountPaid;
    }
}

/*
* Helper function to get the instructor's module setting value by key.
*/
if (!function_exists('modulesetting')) {
    /**
     * Get the module setting value by key.
     *
     * @param string $key
     * @return mixed|null
     */
    function modulesetting($key)
    {
        $request = app('request');
        $subdomain = $request->getHost(); // Get the host (e.g., "teacher1.learncosy.local")
        $segments = explode('.', $subdomain); // Split the host into segments
        $sub_domain = $segments[0]; // Get the first segment as the subdomain

        if ($sub_domain) {
            $user = User::where('username', $sub_domain)->first();

            if (!$user) {
                // Redirect the user to set up their username
                return redirect()->route('instructor.dashboard.index');
            }

            $setting = \App\Models\InstructorModuleSetting::where('instructor_id', $user->id)->first();

            if ($setting) {
                $setting->value = json_decode($setting->value);

                if ($key == 'logo') {
                    return $setting->logo ?? null;
                } elseif ($key == 'image') {
                    return $setting->image ?? null;
                } elseif ($key == 'lp_bg_image') {
                    return $setting->lp_bg_image ?? null;
                } else {
                    return $setting->value->$key ?? null;
                }
            }
        } elseif (Auth::check() && Auth::user()->user_role == 'admin') {
            return null;
        }

        return null;
    }

}


/**
 * Helper function to check instructor is subscribed or not after check logged in user is add stripe_secret_key, stripe_public_key after check logged in user vimeo_data add or not
 */
if (!function_exists('isInstructorSubscribed')) {
    function isInstructorSubscribed($user_id)
    {
        $instructor = \App\Models\User::where('id', $user_id)->first();
        $subscription = \App\Models\Subscription::where('instructor_id', $user_id)->first();

        // Check if the instructor is subscribed
        if ($instructor->stripe_secret_key && $instructor->stripe_public_key && $instructor->vimeo_data) {
            return '';
        }

        // Build the alert message based on missing data
        $html = '';
        if( !$subscription ) {
            $html .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> You are not subscribe to any plan. Please <a href="'.route('instructor.subscription').'" class="text-success">Subscribed</a> to a plan to continue.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if (!$instructor->stripe_secret_key || !$instructor->stripe_public_key) {
            $html .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> Please provide your <a href="'.route('instructor.stripe').'" class="text-success">Stripe</a> data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        if (!$instructor->vimeo_data) {
            $html .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Warning!</strong> Please provide your <a href="'.route('instructor.vimeo').'" class="text-success">Vimeo</a> data.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }

        // show alert one by one
        return $html;
    }
}



/**
 * Helper function to check student CourseLog and count total complete lessons by student
 */
if (!function_exists('StudentActitviesProgress')) {
    function StudentActitviesProgress($user_id, $course_id)
    {
        // Get the total number of lessons in the course
        $totalLessons = \App\Models\Lesson::where('course_id', $course_id)->count();
        // dd($totalLessons );
        // exit();
        // Get the total number of completed lessons by the student for the specific course
        $totalCompleteLessons = \App\Models\CourseActivity::where('course_id', $course_id)
            ->where('user_id', $user_id)
            ->whereNotNull('is_completed')
            ->count();

        // Calculate the course progress percentage
        $progress = ($totalCompleteLessons / $totalLessons) * 100;

        // format the progress percentage
        $progress = number_format($progress, 0);

        return $progress;
    }
}


/**
 * Helper function to studentRadarChart for student with label and progress
 */
if (!function_exists('studentRadarChart')) {
    function studentRadarChart($user_id)
    {
        $checkout = \App\Models\Checkout::where('user_id', $user_id)->get();
        $courseIds = $checkout->pluck('course_id')->toArray();
        $courses = \App\Models\Course::whereIn('id', $courseIds)->get();
        $labels = [];
        $progress = [];
        $lesson = [];
        $modules = [];
        foreach ($courses as $course) {
            $labels[] = $course->title;
            $progress[] = intval(StudentActitviesProgress($user_id, $course->id));
            $lesson[] = \App\Models\Lesson::where('course_id', $course->id)->count();
            $modules[] = \App\Models\Module::where('course_id', $course->id)->count();
        }
        return [
            'labels' => $labels,
            'progress' => $progress,
            'lesson' => $lesson,
            'modules' => $modules,
        ];
    }
}
