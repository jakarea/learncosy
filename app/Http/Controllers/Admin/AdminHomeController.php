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
    // dashboard
    public function dashboard()
    {
        $categories = [];
        $students = [];
        $users = 0;
        $enrolmentStudents = 0;


        $TopPerformingCourses = Course::select('courses.id','courses.title','courses.categories','courses.thumbnail','courses.slug', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'))
        ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
        ->groupBy('courses.id')
        ->havingRaw('sale_count > 0')
        ->orderByDesc('sale_count')
        ->limit(5)
        ->get();
        
        $lastMessages = Message::lastMessagePerUser()->with('user')->get();

        $studentsCount = User::where('user_role', 'student')->count();
        $instructorsCount = User::where('user_role', 'instructor')->count();
        $enrolmentStudents = Checkout::with('course')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->count();

        $enrolments = Checkout::orderBy('id', 'desc')->get();
        $activeInActiveStudents = $this->getActiveInActiveStudents($enrolments);
        $earningByDates = $this->getEarningByDates();
        $earningByMonth = $this->getEarningByMonth();
        $courses = Course::get();
        $courseCount = count($courses);
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
                'lastMessages'
            )
        );
    }

    public function perform(){ 
        $TopPerformingCourses = Course::select('courses.id','courses.price','courses.offer_price','courses.user_id','courses.title','courses.categories','courses.thumbnail','courses.slug', DB::raw('COUNT( DISTINCT checkouts.id) as sale_count'))
            ->with('user')
            ->with('reviews')
            ->leftJoin('checkouts', 'courses.id', '=', 'checkouts.course_id')
            ->groupBy('courses.id')
            ->orderByDesc('sale_count')
            ->paginate(12);
        return view('e-learning/course/admin/top-perform',compact('TopPerformingCourses'));
    }

    private function getEarningByMonth()
    {
        $data = Subscription::join('subscription_packages', 'subscriptions.subscription_packages_id', '=', 'subscription_packages.id')
        ->get(['subscriptions.start_at', 'subscription_packages.amount']);
        $monthlySums = array_fill(0, 12, 0);

  // Iterate through the data array
  foreach ($data as $item) {
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