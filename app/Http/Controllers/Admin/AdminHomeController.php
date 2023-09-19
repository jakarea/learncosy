<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Message;
use App\Models\Checkout;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminHomeController extends Controller

{

    private $currentMonthStart;
    private $currentMonthEnd;
    private $previousMonthStart;
    private $previousMonthEnd;

    public function __construct()
    {
        $this->currentMonthStart = Carbon::now()->startOfMonth();
        $this->currentMonthEnd = Carbon::now()->endOfMonth();
        $this->previousMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $this->previousMonthEnd = Carbon::now()->subMonth()->endOfMonth();
    }

    // dashboard
    public function dashboard()
    {
        $categories = [];
        $students = [];
        $users = 0;
        $enrolmentStudents = 0;


        // $TopPerformingCourses = Course::select('courses.id','courses.title','courses.categories','courses.thumbnail','courses.slug','courses.price','courses.offer_price', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'), DB::raw('SUM( checkouts.amount) as sum_amount'))
        // ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
        // ->groupBy('courses.id')
        // ->havingRaw('sale_count > 0')
        // ->orderByDesc('sale_count')
        // ->limit(7)
        // ->get();

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


        $lastMessages = Message::lastMessagePerUser()->with('user')->take(7)->get();

        $studentsCount = User::where('user_role', 'student')->count();
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
            $percentageChangeOfStudent = (($currentMonthStudentCount - $previousMonthStudentCount) / abs($previousMonthStudentCount)) * 100;
        }
        $formattedPercentageChangeOfStudent = ($percentageChangeOfStudent >= 0 ? '+' : '-') . number_format(abs($percentageChangeOfStudent), 2) . '%';

        $percentageChangeOfInstructor = 0;
        if ($previousMonthStudentCount !== 0) {
            $percentageChangeOfInstructor = (($currentMonthInstructorCount - $previousMonthInstructorCount) / abs($previousMonthInstructorCount)) * 100;
        }
        $formattedPercentageChangeOfInstructor = ($percentageChangeOfInstructor >= 0 ? '+' : '-') . number_format(abs($percentageChangeOfInstructor), 2) . '%';


        $instructorsCount = User::where('user_role', 'instructor')->count();
        $enrolmentStudents = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->count();

        $enrolments = Checkout::orderBy('id', 'desc')->get();
        $activeInActiveStudents = $this->getActiveInActiveStudents($enrolments);
        $earningByDates = $this->getEarningByDates();
        $earningByMonth = $this->getEarningByMonth();
        $courses = Course::get();
        $courseCount = count($courses);

        $currentMonthCourseCount = Course::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $previousMonthCourseCount = Course::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();
        $percentageChangeOfCourse = 0;
        if ($previousMonthCourseCount !== 0) {
            $percentageChangeOfCourse = (($currentMonthCourseCount - $previousMonthCourseCount) / abs($previousMonthCourseCount)) * 100;
        }
        $formattedPercentageChangeOfCourse = ($percentageChangeOfCourse >= 0 ? '+' : '-') . number_format(abs($percentageChangeOfCourse), 2) . '%';


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

        $totalEarnings = $this->getTotalEarningViaSubscription();
        $earningParcentage = $this->getEarningParcentageViaSubscription();

        // return $earningByMonth;
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
                'formattedPercentageChangeOfStudent',
                'formattedPercentageChangeOfInstructor',
                'formattedPercentageChangeOfCourse',
                'earningParcentage'
            )
        );
    }

    public function perform(){ 
 
        $status = isset($_GET['status']) ? $_GET['status'] : '';


        $TopPerformingCourses = Course::select('courses.id','courses.price','courses.offer_price','courses.user_id','courses.title','courses.categories','courses.thumbnail','courses.slug', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'))
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

            
        return view('e-learning/course/admin/top-perform',compact('TopPerformingCourses'));
    }

    private function getEarningByMonth()
    {
        $data = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
        ->get(['subscriptions.start_at','subscriptions.created_at', 'subscription_packages.amount']);
        $monthlySums = array_fill(0, 12, 0);

  // Iterate through the data array
  foreach ($data as $item) {
    // print_r($item);
    // Extract the month from the created_at value
    $createdAt = Carbon::parse($item['created_at']);
    $month = intval($createdAt->format('m'));

    // Add the amount to the corresponding month's sum
    $monthlySums[$month - 1] += $item['amount'];
  }

  return $monthlySums;

    }

    private function getTotalEarningViaSubscription()
    {
        $totalPayment = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->selectRaw('SUM(subscription_packages.amount) as total_payment')
            ->first();

        if ($totalPayment) {
            $totalPaymentAmount = $totalPayment->total_payment;
            // You can use $totalPaymentAmount as the total payment value
        } else {
            $totalPaymentAmount = 0;
            // Handle the case where there are no payments or users
        }

        return $totalPaymentAmount;
    }
    private function getTotalEarningViaSubscriptionTotal()
    {
        $earningDetails = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->get(['subscriptions.start_at', 'subscription_packages.amount']);
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


    private function getEarningParcentageViaSubscription()
    {
        $currentMonthStart = $this->currentMonthStart;
        $currentMonthEnd = $this->currentMonthEnd;
        $previousMonthStart = $this->previousMonthStart;
        $previousMonthEnd = $this->previousMonthEnd;

        $currentMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->whereBetween('subscriptions.start_at', [$currentMonthStart, $currentMonthEnd])
            ->sum('subscription_packages.amount');
        $previousMonthTotal = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
            ->whereBetween('subscriptions.start_at', [$previousMonthStart, $previousMonthEnd])
            ->sum('subscription_packages.amount');
        if ($previousMonthTotal !== 0) {
            $percentageChange = (($currentMonthTotal - $previousMonthTotal) / abs($previousMonthTotal)) * 100;
        } else {
            $percentageChange = ($currentMonthTotal > 0) ? 100 : 0;
        }

        $formattedPercentageChange = number_format($percentageChange, 2) . '%';

        return $formattedPercentageChange;
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
            ->get(['subscriptions.start_at', 'subscription_packages.amount']);
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

    // public function dashboard(){
    //     $courses = 0;
    //     $users = 0;
    //     $enrolmentStudents = 0;

    //     $courses = Course::count();
    //     $users = User::where('user_role', 'students')->orWhere('user_role', 'instructor')->count();
    //     $enrolmentStudents = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->count();

    // $userCounts = User::select('user_role', \DB::raw('count(*) as total'))
    //     ->groupBy('user_role')
    //     ->pluck('total', 'user_role');

    //     foreach ($userCounts as $role => $count) {
    //         if($role == 'student')
    //             $students = $count;

    //         if($role == 'instructor')
    //             $instructors = $count;
    //     }

    //     return view('e-learning/course/admin/dashboard',compact('courses','users','enrolmentStudents'));
    // }
}
