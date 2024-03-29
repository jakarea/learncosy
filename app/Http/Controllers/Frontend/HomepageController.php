<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\Course;
use App\Models\BundleCourse;
use App\Models\Checkout;
use App\Models\CourseReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all user who are instructor use auth service provider

        return view('instructor/admin/chart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function courseDetails($slug)
    {
        $course = Course::where('slug', $slug)->with('modules.lessons')->firstOrFail();
        $promo_video_link = '';
        if ($course->promo_video != '') {
            $ytarray = explode("/", $course->promo_video);
            $ytendstring = end($ytarray);
            $ytendarray = explode("?v=", $ytendstring);
            $ytendstring = end($ytendarray);
            $ytendarray = explode("&", $ytendstring);
            $ytcode = $ytendarray[0];
            $promo_video_link = $ytcode;
        }

        $course_reviews = CourseReview::where('course_id', $course->id)->get();
        $courseEnrolledNumber = Checkout::where('course_id', $course->id)->count();

        $userIdentifier = isset($_COOKIE['userIdentifier']) ? $_COOKIE['userIdentifier'] : null;

        $cartCourses = Cart::where(function ($query) use ($userIdentifier) {
            if (auth()->id()) {
                $query->where('user_id', auth()->id());
            } else {
                $query->Where('user_identifier', $userIdentifier);
            }
        })->get();

        $related_course = [];
        if ($course) {
            if($course->categories){
                $categoryArray = explode(',', $course->categories);

                $related_course = Course::where('instructor_id', $course->instructor_id)
                ->where('status','published')
                ->where('id', '!=', $course->id)
                ->where(function ($query) use ($categoryArray) {
                    foreach ($categoryArray as $category) {
                        $query->orWhere('categories', 'like', '%' . trim($category) . '%');
                    }
                })
                ->take(4)
                ->get();
            }


            return view('frontend.course-details', compact('course', 'promo_video_link', 'course_reviews', 'related_course', 'courseEnrolledNumber','cartCourses'));
        } else {
            return redirect('/')->with('error', 'Course not found!');
        }
    }

    public function instructorHome()
    {
        // get subdomain from subdomain
        $domain = env('APP_DOMAIN', 'learncosy.com');
        $request = app('request');
        $subdomain = $request->getHost(); // Get the host (e.g., "instructor.learncosy.com")
        $segments = explode('.', $subdomain); // Split the host into segments
        $subdomain = $segments[0]; // Get the first segment as the subdomain

        if (request()->getHost() != 'app.' . $domain && $subdomain != 'app' && !empty($subdomain)) {
            $instructors = User::with(['courses.reviews'])->where('subdomain', $subdomain)->first();
            if (!$instructors) {
                return redirect('//app.' . $domain . '/login');
            }
            // filter course
            $title = isset($_GET['title']) ? $_GET['title'] : '';
            $categories = isset($_GET['categories']) ? $_GET['categories'] : '';
            $subscription_status = isset($_GET['subscription_status']) ? $_GET['subscription_status'] : '';
            $price = isset($_GET['price']) ? $_GET['price'] : '';

            $instructors = User::with(['courses.reviews'])->where('subdomain', $subdomain)->first();

            if (!empty($title)) {
                $instructors = User::with(['courses' => function ($query) use ($title) {
                    $query->where('title', 'like', '%' . $title . '%');
                }])->first();
            }
            if (!empty($categories)) {
                $instructors = User::with(['courses' => function ($query) use ($categories) {
                    $query->where('categories', 'like', '%' . $categories . '%');
                }])->first();
            }
            if (!empty($subscription_status)) {
                $instructors = User::with(['courses' => function ($query) use ($subscription_status) {
                    $query->where('subscription_status', 'like', '%' . $subscription_status . '%');
                }])->first();
            }
            if (!empty($price)) {
                $instructors = User::with(['courses' => function ($query) use ($price) {
                    $query->where('price', 'like', '%' . $price . '%');
                }])->first();
            }
            // filter end

            // $instructors = User::with(['courses'])->where('subdomain', $subdomain)->first();

            $instructor_courses = collect($instructors->courses)->where('status','published')->pluck('id')->toArray();
            $courses_review = CourseReview::with(['course', 'user'])->whereIn('course_id', $instructor_courses)->inRandomOrder()->take(5)->get();
            $students = User::where('user_role', 'student')->get();
            $bundle_courses = BundleCourse::where('instructor_id', $instructors->id)->get();

            foreach ($bundle_courses as $course) {
                $courses_id = explode(",", $course->selected_course);
                $course_info = Course::whereIn('id', $courses_id)->get();
                $course['courses'] =  $course_info;
            }

            // return $courses_review;


            $userIdentifier = isset($_COOKIE['userIdentifier']) ? $_COOKIE['userIdentifier'] : null;

            $cartCourses = Cart::where(function ($query) use ($userIdentifier) {
                if (auth()->id()) {
                    $query->where('user_id', auth()->id());
                } else {
                    $query->Where('user_identifier', $userIdentifier);
                }
            })->get();

            return view('frontend.homepage', compact('instructors', 'courses_review', 'bundle_courses', 'students', 'cartCourses'));
        } else {
            return redirect('//app.' . $domain . '/login');
        }
    }

    public function homeInstructorCourseDetails($subdomain, $slug)
    {
        $instructor = User::with(['courses'])->where('subdomain', $subdomain)->first();
        $course = Course::with(['modules.lessons', 'user'])->where('user_id', $instructor->id)->where('slug', $slug)->first();
        $courses_review = CourseReview::with(['course', 'user'])->where('course_id', $course->id)->inRandomOrder()->take(5)->get();

        // return view('frontend.course', compact(['instructors', 'courses'));
        // return response()->json([
        //     'instructor'    => $instructor,
        //     'course'        => $course,
        //     'courses_review' => $courses_review,

        // ]);

        return view('frontend.course', compact('instructor', 'course', 'courses_review'));
    }

    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $instructors = User::where('user_role', 'instructor')->where('id', $id)->first();
        $courses = Course::where('user_id', $id)->get();
        return view('frontend.course', compact('instructors', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // login as instructor
    public function loginAsInstructor($userSessionId, $userId, $insId)
    {

        if (!$userId || !$userSessionId) {
            return redirect('/login')->with('error', 'Failed to Login as Instructor');
        }

        $adminUserId = Crypt::decrypt($userId);
        $adminUser = User::find($adminUserId);

        if (!$adminUser) {
            return redirect('/login')->with('error', 'Failed to Login as Instructor');
        }

        $reqSessionId = Crypt::decrypt($userSessionId);
        $dbSessionId = Crypt::decrypt($adminUser->session_id);

        $keysToForget = ['userId', 'userRole'];

        foreach ($keysToForget as $key) {
            if (session()->has($key)) {
                session()->forget($key);
            }
        }
        session(['userId' => encrypt($adminUser->id), 'userRole' => $adminUser->user_role]);

        if ($reqSessionId === $dbSessionId && $insId) {
            $instructorUserId = Crypt::decrypt($insId);
            $instructorUser = User::find($instructorUserId);

            if ($instructorUser) {
                Auth::login($instructorUser);

                return redirect('instructor/dashboard')->with('success', 'You have successfully logged into the profile of ' . $instructorUser->name);
            }
        }

        return redirect('/login')->with('error', 'Failed to Login as Instructor');
    }

    // login as student
    public function loginAsStudent($userSessionId, $userId, $stuId)
    {
        if (!$userId || !$userSessionId) {
            return redirect('/login')->with('error', 'Failed to Login as Student');
        }

        $adminUserId = Crypt::decrypt($userId);
        $adminUser = User::find($adminUserId);

        if (!$adminUser) {
            return redirect('/login')->with('error', 'Failed to Login as Student');
        }

        $reqSessionId = Crypt::decrypt($userSessionId);
        $dbSessionId = Crypt::decrypt($adminUser->session_id);

        $keysToForget = ['userId', 'userRole'];

        foreach ($keysToForget as $key) {
            if (session()->has($key)) {
                session()->forget($key);
            }
        }
        session(['userId' => encrypt($adminUser->id), 'userRole' => $adminUser->user_role]);

        if ($reqSessionId === $dbSessionId && $stuId) {
            $studentUserId = Crypt::decrypt($stuId);
            $studentUser = User::find($studentUserId);

            if ($studentUser) {
                Auth::login($studentUser);

                return redirect('student/dashboard')->with('success', 'You have successfully logged into the profile of ' . $studentUser->name);
            }
        }

        return redirect('/login')->with('error', 'Failed to Login as Student');
    }
}
