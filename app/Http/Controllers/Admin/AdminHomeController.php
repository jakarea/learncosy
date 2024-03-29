<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Chat;
use App\Models\Notification;
use App\Models\Checkout;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{

    private $currentMonthStart;
    private $currentMonthEnd;
    private $previousMonthStart;
    private $previousMonthEnd;

    public function __construct()
    {
        $this->currentMonthStart = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $this->currentMonthEnd = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
        $this->previousMonthStart = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
        $this->previousMonthEnd = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');
    }



    // dashboard
    public function dashboard(Request $request)
    {
        $userId = Auth::user()->id;

        $user = User::where('id', $userId)->first();
        $user->session_id = null;
        $user->save();

        $categories = [];
        $students = [];
        $users = 0;
        $enrolmentStudents = 0;
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $analytics_title = 'Yearly Analytics';
        $compear = '1 year';
        $TopPerformingCourses = Course::select(
            'courses.id',
            'courses.title',
            'courses.categories',
            'courses.thumbnail',
            'courses.slug',
            'courses.price',
            'courses.offer_price',
            DB::raw('COUNT(DISTINCT checkouts.id) as sale_count'),
            DB::raw('SUM(checkouts.amount) as sum_amount'),
            DB::raw('AVG(course_reviews.star) as avg_rating')
        )
            ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
            ->leftJoin('course_reviews', 'courses.id', '=', 'course_reviews.course_id')
            ->groupBy('courses.id')
            ->havingRaw('sale_count > 0')
            ->orderByDesc('sale_count')
            ->limit(7)
            ->get();


        // $lastMessages = Chat::lastMessagePerUser()->with('user')->take(10)->get();
        $lastMessages = [];

         //9
        $currentMonthStart = $this->currentMonthStart;
        $currentMonthEnd = $this->currentMonthEnd;
        $previousMonthStart = $this->previousMonthStart;
        $previousMonthEnd = $this->previousMonthEnd;

        $currentMonthStudentCount = User::where('user_role', 'student')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->count();
        $previousMonthStudentCount = User::where('user_role', 'student')
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();

        $currentMonthInstructorCount = User::where('user_role', 'instructor')
            ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
            ->count();
        $previousMonthInstructorCount = User::where('user_role', 'instructor')
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])
            ->count();
        $percentageChangeOfStudent = 0;
        if ($previousMonthStudentCount !== 0) {
            $percentageChangeOfStudent = (int) ((($currentMonthStudentCount - $previousMonthStudentCount) / abs($previousMonthStudentCount)) * 100);
        }

        $percentageChangeOfInstructor = 0;
        if ($previousMonthStudentCount !== 0) {
            $percentageChangeOfInstructor = (int) ((($currentMonthInstructorCount - $previousMonthInstructorCount) / abs($previousMonthInstructorCount)) * 100);
        }


        if ($request->has('duration')) {
            $duration = $request->query('duration');
            if ($duration === 'one_month') {
                $firstDayOfCurrentMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
                $lastDayOfCurrentMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
                $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
                $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');
                $enrolments = Checkout::orderBy('id', 'desc')
                    ->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])
                    ->get();
                $studentsCount = User::where('user_role', 'student')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
                $instructorsCount = User::where('user_role', 'instructor')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
            } elseif ($duration === 'three_months') {
                $firstDayOfCurrentMonth = Carbon::now()->subMonth(3)->startOfMonth()->format('Y-m-d H:i:s');
                $lastDayOfCurrentMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
                $firstDayOfPreviousMonth = Carbon::now()->subMonth(6)->startOfMonth()->format('Y-m-d H:i:s');
                $lastDayOfPreviousMonth = Carbon::now()->subMonth(3)->endOfMonth()->format('Y-m-d H:i:s');
                $enrolments = Checkout::orderBy('id', 'desc')
                    ->whereBetween('created_at', [$firstDayOfPreviousMonth, $lastDayOfCurrentMonth])->get();
                $studentsCount = User::where('user_role', 'student')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
                $instructorsCount = User::where('user_role', 'instructor')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
            } elseif ($duration === 'six_months') {
                $firstDayOfCurrentMonth = Carbon::now()->subMonth(6)->startOfMonth()->format('Y-m-d H:i:s');
                $lastDayOfCurrentMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
                $firstDayOfPreviousMonth = Carbon::now()->subMonth(12)->startOfMonth()->format('Y-m-d H:i:s');
                $lastDayOfPreviousMonth = Carbon::now()->subMonth(6)->endOfMonth()->format('Y-m-d H:i:s');
                $enrolments = Checkout::orderBy('id', 'desc')->whereBetween('created_at', [$firstDayOfPreviousMonth, $lastDayOfCurrentMonth])->get();
                $studentsCount = User::where('user_role', 'student')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
                $instructorsCount = User::where('user_role', 'instructor')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
            } elseif ($duration === 'one_year') {
                $firstDayOfCurrentMonth = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
                $lastDayOfCurrentMonth = Carbon::now()->endOfYear()->format('Y-m-d H:i:s');
                $firstDayOfPreviousMonth = Carbon::now()->subYear()->startOfYear()->format('Y-m-d H:i:s');
                $lastDayOfPreviousMonth = Carbon::now()->subYear()->endOfYear()->format('Y-m-d H:i:s');
                $enrolments = Checkout::orderBy('id', 'desc')->whereBetween('created_at', [$firstDayOfPreviousMonth, $lastDayOfCurrentMonth])->get();
                $studentsCount = User::where('user_role', 'student')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
                $instructorsCount = User::where('user_role', 'instructor')->whereBetween('created_at', [$firstDayOfCurrentMonth, $lastDayOfCurrentMonth])->count();
            }
        } else {
            $enrolments = Checkout::orderBy('id', 'desc')->get();
            $studentsCount = User::where('user_role', 'student')->count();
            $instructorsCount = User::where('user_role', 'instructor')->count();
        }


        $enrolmentStudents = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->count();

        $activeInActiveStudents = $this->getActiveInActiveStudents($enrolments);
        $earningByDates = $this->getEarningByDates();
       $earningByMonth = $this->getEarningByMonth();


        if ($request->has('duration')) {
            $duration = $request->query('duration');
            if ($duration === 'one_month') {
                $analytics_title = 'Monthly Analytics';
                $compear = ' month';
                $currentDate = Carbon::now();
                $currentMonthStartDate = $currentDate->startOfMonth()->format('Y-m-d H:i:s');
                $currentMonthEndDate = $currentDate->endOfMonth()->format('Y-m-d H:i:s');

                $previousMonthStartDate = $currentDate->subMonth()->startOfMonth();
                $previousMonthEndDate = $currentDate->subMonth()->endOfMonth();
                $previousMonthStartDateFormatted = $previousMonthStartDate->format('Y-m-d H:i:s');
                $previousMonthEndDateFormatted = $previousMonthEndDate->format('Y-m-d H:i:s');

                $courses = Course::whereBetween('created_at', [$previousMonthStartDateFormatted, $currentMonthEndDate])->get();
                $currentMonthCourseCount = Course::whereBetween('created_at', [$currentMonthStartDate, $currentMonthEndDate])->count();
                $previousMonthCourseCount = Course::whereBetween('created_at', [$previousMonthStartDateFormatted, $previousMonthEndDate])->count();
            } elseif ($duration === 'three_months') {
                $analytics_title = 'Quarterly Analytics';
                $compear = '3 months';
                $currentDate = Carbon::now();
                $currentMonthStartDate = $currentDate->startOfMonth()->format('Y-m-d H:i:s');
                $currentMonthEndDate = $currentDate->endOfMonth()->format('Y-m-d H:i:s');
                $threeMonthsAgoStartDate = $currentDate->subMonths(2)->startOfMonth()->format('Y-m-d H:i:s');
                $threeMonthsAgoEndDate = $currentDate->subMonths(2)->endOfMonth()->format('Y-m-d H:i:s');
                $sixMonthsAgoStartDate = $currentDate->subMonths(5)->startOfMonth()->format('Y-m-d H:i:s');

                $courses = Course::whereBetween('created_at', [$threeMonthsAgoStartDate, $currentMonthEndDate])->get();
                $currentMonthCourseCount = Course::whereBetween('created_at', [$threeMonthsAgoStartDate, $currentMonthEndDate])->count();
                $previousMonthCourseCount = Course::whereBetween('created_at', [$sixMonthsAgoStartDate, $threeMonthsAgoEndDate])->count();
            } elseif ($duration === 'six_months') {
                $analytics_title = 'Biannually Analytics';
                $compear = '6 months';
                $currentDate = Carbon::now();
                $currentMonthStartDate = $currentDate->startOfMonth()->format('Y-m-d H:i:s');
                $currentMonthEndDate = $currentDate->endOfMonth()->format('Y-m-d H:i:s');
                $threeMonthsAgoStartDate = $currentDate->subMonths(2)->startOfMonth()->format('Y-m-d H:i:s');
                $sixMonthsAgoStartDate = $currentDate->subMonths(5)->startOfMonth()->format('Y-m-d H:i:s');
                $previousSixMonthsAgoStartDate = $currentDate->subMonths(11)->startOfMonth()->format('Y-m-d H:i:s');

                $courses = Course::whereBetween('created_at', [$sixMonthsAgoStartDate, $currentMonthEndDate])->get();
                $currentMonthCourseCount = Course::whereBetween('created_at', [$sixMonthsAgoStartDate, $currentMonthEndDate])->count();
                $previousMonthCourseCount = Course::whereBetween('created_at', [$previousSixMonthsAgoStartDate, $sixMonthsAgoStartDate])->count();
            } elseif ($duration === 'one_year') {
                $compear = ' year';
                $firstdayOfCurrentYear = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
                $lastDayOfCurrentYear = Carbon::now()->endOfYear()->format('Y-m-d H:i:s');
                $firstDayOfPreviousYear = Carbon::now()->subYear()->startOfYear()->format('Y-m-d H:i:s');
                $lastDayOfPreviousYear = Carbon::now()->subYear()->endOfYear()->format('Y-m-d H:i:s');


                $courses = Course::whereBetween('created_at', [$firstDayOfPreviousYear, $lastDayOfCurrentYear])->get();
                $currentMonthCourseCount = Course::whereBetween('created_at', [$firstdayOfCurrentYear, $lastDayOfCurrentYear])->count();
                $previousMonthCourseCount = Course::whereBetween('created_at', [$firstDayOfPreviousYear, $lastDayOfPreviousYear])->count();
            }

        } else {
            $courses = Course::get();
            $currentMonthCourseCount = Course::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
            $previousMonthCourseCount = Course::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        }

        $courseCount = count($courses);

        $percentageChangeOfCourse = 0;
        if ($previousMonthCourseCount !== 0) {
            $percentageChangeOfCourse = (($currentMonthCourseCount - $previousMonthCourseCount) / abs($previousMonthCourseCount)) * 100;
        }

        $allCategories = $courses->pluck('categories');
        $unique_array_categories = [];
        foreach ($allCategories as $category) {
            $cats = explode(",", $category);
            foreach ($cats as $cat) {
                $unique_array_categories[] = strtolower($cat);
            }
        }

        foreach ($enrolments as $enrolment) {
            $students[$enrolment->user_id] = $enrolment->created_at;
        }

        $categories = array_unique($unique_array_categories);

        if ($request->has('duration')) {
            $duration = $request->query('duration');
            if ($duration === 'one_month') {
                $totalEarnings = $this->getTotalEarningViaSubscription($duration);
                $earningParcentage = $this->getEarningParcentageViaSubscription($duration);

            } elseif ($duration === 'three_months') {
                $totalEarnings = $this->getTotalEarningViaSubscription($duration);
                $earningParcentage = $this->getEarningParcentageViaSubscription($duration);

            } elseif ($duration === 'six_months') {
                $totalEarnings = $this->getTotalEarningViaSubscription($duration);
                $earningParcentage = $this->getEarningParcentageViaSubscription($duration);

            } elseif ($duration === 'one_year') {
                $totalEarnings = $this->getTotalEarningViaSubscription($duration);
                $earningParcentage = $this->getEarningParcentageViaSubscription($duration);

            }
        } else {
            $totalEarnings = $this->getTotalEarningViaSubscription(null);
            $earningParcentage = $this->getEarningParcentageViaSubscription(null);
        }

        $courses = Course::select(
            'courses.id',
            'courses.title',
            'courses.categories',
            'courses.thumbnail',
            'courses.slug',
            'courses.price',
            'courses.offer_price',
            DB::raw('COUNT(DISTINCT checkouts.id) as sale_count'),
            DB::raw('SUM(checkouts.amount) as sum_amount'),
            DB::raw('AVG(course_reviews.star) as avg_rating')
        )
            ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
            ->leftJoin('course_reviews', 'courses.id', '=', 'course_reviews.course_id')
            ->groupBy('courses.id')
            ->orderByDesc('courses.id');

        if (!empty($status)) {
            $today = now();
            if ($status == 'one') {
                $courses->whereYear('courses.created_at', '=', $today->year)
                    ->whereMonth('courses.created_at', '=', $today->month);
            } elseif ($status == 'three') {
                $courses->where('courses.created_at', '>=', $today->subMonths(3));
            } elseif ($status == 'six') {
                $courses->where('courses.created_at', '>=', $today->subMonths(6));
            } elseif ($status == 'year') {
                $courses->where('courses.created_at', '>=', $today->subYear(1));
            }
        }

        // return $earningByMonth;

        $courses = $courses->get();

        return view(
            'e-learning/course/admin/dashboard',
            compact(
                'studentsCount',
                'instructorsCount',
                'enrolmentStudents',
                'activeInActiveStudents',
                'courses',
                'courseCount',
                'students',
                'categories',
                'users',
                'earningByDates',
                'totalEarnings',
                'earningByMonth',
                'TopPerformingCourses',
                'lastMessages',
                'percentageChangeOfStudent',
                'percentageChangeOfInstructor',
                'percentageChangeOfCourse',
                'earningParcentage',
                'analytics_title',
                'compear'
            )
        );
    }

    public function perform()
    {
        $status = isset($_GET['status']) ? $_GET['status'] : '';

       $TopPerformingCourses = Course::select('courses.id', 'courses.price', 'courses.offer_price', 'courses.user_id', 'courses.title', 'courses.categories', 'courses.thumbnail', 'courses.slug', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'))
            ->with('user')
            ->with('reviews')
            ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
            ->groupBy('courses.id');

        if ($status) {
            if ($status == 'last_7_days') {
                $sevenDaysAgo = now()->subDays(7);
                $TopPerformingCourses->whereDate('courses.created_at', '>=', $sevenDaysAgo);
            }
            if ($status == 'last_30_days') {
                $thirtyDaysAgo = now()->subDays(30);
                $TopPerformingCourses->whereDate('courses.created_at', '>=', $thirtyDaysAgo);
            }
            if ($status == 'last_1_year') {
                $oneYearAgo = now()->subDays(365);
                $TopPerformingCourses->whereDate('courses.created_at', '>=', $oneYearAgo);
            }
        } else {
            $TopPerformingCourses->orderByDesc('sale_count');
        }

       $TopPerformingCourses = $TopPerformingCourses->paginate(12);


        return view('e-learning/course/admin/top-perform', compact('TopPerformingCourses'));
    }

    private function getEarningByMonth()
    {
        // $data = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
        // ->get(['subscriptions.start_at','subscriptions.created_at', 'subscription_packages.sales_price','subscription_packages.regular_price']);

        $data = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')->get();

        // $curentMonthNumber = date('n');
        // $monthlySums = array_fill(0, $curentMonthNumber, 0);

        // // Iterate through the data array
        // foreach ($data as $item) {
        //     $createdAt = Carbon::parse($item['created_at']);
        //     $month = intval($createdAt->format('m'));
        //     $monthlySums[$month - 1] += $item['amount'];
        // }

        // return $monthlySums;


        $currentMonthNumber = Carbon::now()->month;
        $monthlySums = array_fill(0, $currentMonthNumber, 0);

        // Iterate through the data array
        foreach ($data as $item) {
            $createdAt = Carbon::parse($item['created_at']);
            $month = intval($createdAt->format('m'));

            // Ensure the month value is within the valid range (1 to $currentMonthNumber)
            if ($month >= 1 && $month <= $currentMonthNumber) {
                $monthlySums[$month - 1] += $item['amount'];
            }
        }

        return $monthlySums;
    }

    private function getTotalEarningViaSubscription($duration)
    {

        if ($duration == null) {
            $totalPayment = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->selectRaw('SUM(subscription_packages.sales_price) as total_payment')
            ->first();
        } elseif ($duration == 'one_month') {
            $currentDate = Carbon::now();
            $previousMonthStartDate = $currentDate->copy()->subMonth()->startOfMonth()->format('Y-m-d H:i:s');
            $previousMonthEndDate = $currentDate->copy()->subMonth()->endOfMonth()->format('Y-m-d H:i:s');
            $totalPayment = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.created_at', [$previousMonthStartDate, $previousMonthEndDate])
                ->selectRaw('SUM(subscription_packages.sales_price) as total_payment')
                ->first();
        } elseif ($duration == 'three_months') {
            $currentDate = Carbon::now();
            $currentMonthStartDate = $currentDate->startOfMonth()->format('Y-m-d H:i:s');
            $currentMonthEndDate = $currentDate->endOfMonth()->format('Y-m-d H:i:s');
            $threeMonthsAgoStartDate = $currentDate->subMonths(2)->startOfMonth()->format('Y-m-d H:i:s');
            $threeMonthsAgoEndDate = $currentDate->subMonths(2)->endOfMonth()->format('Y-m-d H:i:s');
            $sixMonthsAgoStartDate = $currentDate->subMonths(5)->startOfMonth()->format('Y-m-d H:i:s');

            $totalPayment = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.created_at', [$threeMonthsAgoStartDate, $currentMonthEndDate])
                ->selectRaw('SUM(subscription_packages.sales_price) as total_payment')
                ->first();
        } elseif ($duration == 'six_months') {
            $currentDate = Carbon::now();
            $currentMonthStartDate = $currentDate->startOfMonth()->format('Y-m-d H:i:s');
            $currentMonthEndDate = $currentDate->endOfMonth()->format('Y-m-d H:i:s');
            $threeMonthsAgoStartDate = $currentDate->subMonths(2)->startOfMonth()->format('Y-m-d H:i:s');
            $sixMonthsAgoStartDate = $currentDate->subMonths(5)->startOfMonth()->format('Y-m-d H:i:s');
            $previousSixMonthsAgoStartDate = $currentDate->subMonths(11)->startOfMonth()->format('Y-m-d H:i:s');


            $totalPayment = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.created_at', [$sixMonthsAgoStartDate, $currentMonthEndDate])
                ->selectRaw('SUM(subscription_packages.sales_price) as total_payment')
                ->first();
        } elseif ($duration == 'one_year') {
            $firstdayOfCurrentYear = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
            $lastDayOfCurrentYear = Carbon::now()->endOfYear()->format('Y-m-d H:i:s');
            $firstDayOfPreviousYear = Carbon::now()->subYear()->startOfYear()->format('Y-m-d H:i:s');
            $lastDayOfPreviousYear = Carbon::now()->subYear()->endOfYear()->format('Y-m-d H:i:s');

            $totalPayment = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.created_at', [$firstDayOfPreviousYear, $lastDayOfCurrentYear])
                ->selectRaw('SUM(subscription_packages.sales_price) as total_payment')
                ->first();
        }


        if ($totalPayment) {
            $totalPaymentAmount = $totalPayment->total_payment;

        } else {
            $totalPaymentAmount = 0;
        }


        return $totalPaymentAmount;
    }
    private function getTotalEarningViaSubscriptionTotal()
    {
        $earningDetails = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->get(['subscriptions.start_at', 'subscription_packages.sales_price']);
        $earningsByDate = [];

        foreach ($earningDetails as $record) {
            $createdAt = Carbon::parse($record['start_at']);
            $amount = $record['amount'];

            $createdDate = $createdAt->format('Y-m-d');

            if (!isset($earningsByDate[$createdDate])) {
                $earningsByDate[$createdDate] = 0;
            }

            $earningsByDate[$createdDate] += $amount;
        }

        return $earningsByDate;

    }

    private function getEarningParcentageViaSubscription($duration)
    {
        $currentMonthStart = $this->currentMonthStart;
        $currentMonthEnd = $this->currentMonthEnd;
        $previousMonthStart = $this->previousMonthStart;
        $previousMonthEnd = $this->previousMonthEnd;

        if ($duration == null) {

           $currentMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->whereBetween('subscriptions.start_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('subscription_packages.sales_price');
          $previousMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->whereBetween('subscriptions.start_at', [$previousMonthStart, $previousMonthEnd])
            ->sum('subscription_packages.sales_price');

        } elseif ($duration == 'one_month') {
            $currentDate = Carbon::now();
            $currentMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$currentMonthStart, $currentMonthEnd])
                ->sum('subscription_packages.sales_price');
            $previousMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$previousMonthStart, $previousMonthEnd])
                ->sum('subscription_packages.sales_price');
        } elseif ($duration == 'three_months') {
            $currentDate = Carbon::now();
            $threeMonthsAgoStartDate = $currentDate->subMonths(2)->startOfMonth();
            $threeMonthsAgoEndDate = $currentDate->subMonths(2)->endOfMonth();
            $sixMonthsAgoStartDate = $currentDate->subMonths(5)->startOfMonth();

            $currentMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$threeMonthsAgoStartDate, $currentMonthEnd])
                ->sum('subscription_packages.sales_price');
            $previousMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$sixMonthsAgoStartDate, $threeMonthsAgoStartDate])
                ->sum('subscription_packages.sales_price');
        } elseif ($duration == 'six_months') {
            $currentDate = Carbon::now();
            $currentMonthStartDate = $currentDate->startOfMonth();
            $currentMonthEndDate = $currentDate->endOfMonth();
            $threeMonthsAgoStartDate = $currentDate->subMonths(2)->startOfMonth();
            $sixMonthsAgoStartDate = $currentDate->subMonths(5)->startOfMonth();
            $previousSixMonthsAgoStartDate = $currentDate->subMonths(11)->startOfMonth();


            $currentMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$sixMonthsAgoStartDate, $currentMonthEndDate])
                ->sum('subscription_packages.sales_price');
            $previousMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$previousSixMonthsAgoStartDate, $sixMonthsAgoStartDate])
                ->sum('subscription_packages.sales_price');
        } elseif ($duration == 'one_year') {
            $firstdayOfCurrentYear = Carbon::now()->startOfYear();
            $lastDayOfCurrentYear = Carbon::now()->endOfYear();
            $firstDayOfPreviousYear = Carbon::now()->subYear()->startOfYear();
            $lastDayOfPreviousYear = Carbon::now()->subYear()->endOfYear();

            $currentMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$firstdayOfCurrentYear, $lastDayOfCurrentYear])
                ->sum('subscription_packages.sales_price');
            $previousMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
                ->whereBetween('subscriptions.start_at', [$firstDayOfPreviousYear, $lastDayOfPreviousYear])
                ->sum('subscription_packages.sales_price');
        }

        if ($previousMonthTotal !== 0) {
            $percentageChange = (($currentMonthTotal - $previousMonthTotal) / abs($previousMonthTotal)) * 100;
        } else {
            $percentageChange = ($currentMonthTotal > 0) ? 100 : 0;
        }
        return (int) $percentageChange;
    }

    private function getActiveInActiveStudents($data)
    {
        $activeCountByDate = [];
        $inactiveCountByDate = [];

        $currentDate = Carbon::now();
        $dates = [];
        $active_students = [];
        $inactive_students = [];

        foreach ($data as $record) {
            $createdAt = Carbon::parse($record['created_at']);

            $endDate = Carbon::parse($record['end_date']);
            if ($currentDate < $endDate) {
                $status = 'active';
            } else {
                $status = 'inactive';
            }

            $createdDate = $createdAt->format('Y-m-d');
            $dates[] = $createdDate;
            if (!isset($activeCountByDate[$createdDate])) {
                $activeCountByDate[$createdDate] = 0;
            }

            if (!isset($inactiveCountByDate[$createdDate])) {
                $inactiveCountByDate[$createdDate] = 0;
            }

            if ($status === 'active') {
                $activeCountByDate[$createdDate]++;
            } else {
                $inactiveCountByDate[$createdDate]++;
            }
            $active_students[] = $activeCountByDate[$createdDate];
            $inactive_students[] = $inactiveCountByDate[$createdDate];
        }
        return ['dates' => $dates, 'active_students' => $active_students, 'inactive_students' => $inactive_students];
    }

    private function getEarningByDates()
    {
        $earningDetails = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->get(['subscriptions.start_at', 'subscription_packages.sales_price']);
        $earningsByDate = [];

        foreach ($earningDetails as $record) {
            $createdAt = Carbon::parse($record['start_at']);
            $amount = $record['amount'];

            $createdDate = $createdAt->format('Y-m-d');

            if (!isset($earningsByDate[$createdDate])) {
                $earningsByDate[$createdDate] = 0;
            }

            $earningsByDate[$createdDate] += $amount;
        }

        return $earningsByDate;
    }

    private function getCourseWisePayments($enrolments)
    {
        $course_wise_payments = [];
        foreach ($enrolments as $enrolment) {
            $students[$enrolment->user_id] = $enrolment->user;
            $title = substr($enrolment->course->title, 0, 30);
            if (strlen($enrolment->course->title) > 30) {
                $title .= "...";
            }
            if (isset($course_wise_payments[$title])) {
                $course_wise_payments[$title] = $course_wise_payments[$title] + $enrolment->amount;
            } else {
                $course_wise_payments[$title] = $enrolment->amount;
            }
        }
        return $course_wise_payments;
    }

    public function notification()
    {

        $currentYear = Carbon::now()->subDays(365);
        $today = Carbon::now();
        $data = Notification::leftJoin('users', 'notifications.user_id', '=', 'users.id')

       ->where('notifications.created_at', '>', $currentYear)
       ->join('courses', 'notifications.course_id', '=', 'courses.id')
       ->select('notifications.id', 'courses.thumbnail AS thumbnail','courses.title AS title', 'notifications.type', 'notifications.course_id', 'notifications.message', 'users.avatar', 'notifications.created_at')
       ->orderBy('notifications.created_at', 'DESC')
       ->get();

       //$data = Notification::all();

        // Get today's date
        $today = now();

        // Initialize arrays for each category
        $todays = [];
        $yestardays = [];
        $sevenDays = [];
        $thirtyDays = [];
        $lastOneYears = [];

        foreach ($data as $item) {
            $createdAt = $item['created_at']; // Assuming 'created_at' is already a Carbon instance

            // Calculate the interval in days
            $interval = $today->diffInDays($createdAt);

            if ($interval == 0) {
                // Today
                $todays[] = $item;
            } elseif ($interval == 1) {
                // Yesterday
                $yestardays[] = $item;
            } elseif ($interval > 2 && $interval <= 7) {
                // Last 7 days
                $sevenDays[] = $item;
            } elseif ($interval >= 8 && $interval <= 30) {

                $thirtyDays[] = $item;
            } elseif ($interval >= 31 && $interval <= 365) {

                $lastOneYears[] = $item;
            }
        }

        // return $todays;

        return view('admin.notification',compact('todays','yestardays','sevenDays','thirtyDays','lastOneYears'));

    }
}
