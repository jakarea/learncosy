<?php

namespace App\Http\Controllers\Instructor;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Message;
use App\Models\Checkout;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;

        $messages = Message::where('receiver_id',$userId)->orWhere('sender_id',$userId)->groupBy('receiver_id','sender_id')->take(3)->get();

        // return "From Instructor Dashboard Controller";
        $categories = [];
        $courses = 0;
        $students = [];
        $currentMonthEnrolledStudents = [];
        $previousMonthEnrolledStudents = [];

        $enrolments = Checkout::where('instructor_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $lastDayOfCurrentMonth = Carbon::now()->endOfMonth();
        $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();
        $currentMonthEnrollment = $this->getEnrollmentData(Auth::user()->id, $firstDayOfCurrentMonth, $lastDayOfCurrentMonth);
        $previousMonthEnrollment = $this->getEnrollmentData(Auth::user()->id, $firstDayOfPreviousMonth, $lastDayOfPreviousMonth);
        $currentMonthTotalSell = $currentMonthEnrollment->sum('amount');
        $previousMonthTotalSell = $previousMonthEnrollment->sum('amount');
        $percentageChange = 0;
        if($previousMonthTotalSell){
            $percentageChange = (($currentMonthTotalSell - $previousMonthTotalSell) / abs($previousMonthTotalSell)) * 100;
        }

        $formattedPercentageChangeOfEarning = round($percentageChange, 2);

        $currentMonthEnrollments = Checkout::where('instructor_id', Auth::user()->id)
            ->whereYear('created_at', '=', now()->year)
            ->whereMonth('created_at', '=', now()->month)
            ->get();

        $previousMonthEnrollments = Checkout::where('instructor_id', Auth::user()->id)
            ->whereYear('created_at', '=', date('Y', strtotime('-1 month')))
            ->whereMonth('created_at', '=', date('m', strtotime('-1 month')))
            ->get();

        $activeInActiveStudents = $this->getActiveInActiveStudents($enrolments);
        $earningByDates = $this->getEarningByDates($enrolments);
        $earningByMonth = $this->getEarningByMonth($enrolments);
        $course_wise_payments = $this->getCourseWisePayments($enrolments);

        $courses = Course::where('user_id', Auth::user()->id)->get();

        $currentMonthCourse = Course::where('user_id', Auth::user()->id)
            ->whereYear('created_at', '=', now()->year)
            ->whereMonth('created_at', '=', now()->month)
            ->count();

        $previousMonthCourse = Course::where('user_id', Auth::user()->id)
            ->whereYear('created_at', '=', date('Y', strtotime('-1 month')))
            ->whereMonth('created_at', '=', date('m', strtotime('-1 month')))
            ->count();

        if ($previousMonthCourse === 0) {
            $percentageOfCourse = ($currentMonthCourse > 0) ? 100 : 0;
        } else {
            $percentageOfCourse = (($currentMonthCourse - $previousMonthCourse) / abs($previousMonthCourse)) * 100;
        }


        $allCategories = $courses->pluck('categories');
        $unique_array = [];
        foreach ($allCategories as $category) {
            $cats = explode(",", $category);
            foreach ($cats as $cat) {
                $unique_array[] = strtolower($cat);
            }
        }

        foreach ($enrolments as $enrolment) {
            $students[$enrolment->user_id] = $enrolment->created_at;
        }

        foreach ($currentMonthEnrollments as $enrolment) {
            $currentMonthEnrolledStudents[$enrolment->user_id] = $enrolment->created_at;
        }

        foreach ($previousMonthEnrollments as $enrolment) {
            $previousMonthEnrolledStudents[$enrolment->user_id] = $enrolment->created_at;
        }

        $currentMonthEnrolledStudentsCount = count($currentMonthEnrolledStudents);
        $previousMonthEnrolledStudentsCount = count($previousMonthEnrolledStudents);

        if ($previousMonthEnrolledStudentsCount === 0) {
            $percentageChangeOfStudentEnroll = ($currentMonthEnrolledStudentsCount > 0) ? 100 : 0;
        } else {
            $percentageChangeOfStudentEnroll = (($currentMonthEnrolledStudentsCount - $previousMonthEnrolledStudentsCount) / abs($previousMonthEnrolledStudentsCount)) * 100;
        }

        $formatedPercentageChangeOfStudentEnroll = number_format($percentageChangeOfStudentEnroll, 2);
        $formatedPercentageOfCourse = number_format($percentageOfCourse, 2);


        $categories = array_unique($unique_array);

        // dd($earningByMonth);
        return view('dashboard/instructor/analytics', compact('categories', 'courses', 'students', 'enrolments', 'course_wise_payments', 'activeInActiveStudents', 'earningByDates','earningByMonth','messages','formatedPercentageChangeOfStudentEnroll','formatedPercentageOfCourse','formattedPercentageChangeOfEarning'));
    }


    private function getEnrollmentData($instructorId, $startDate, $endDate)
    {
        return Checkout::where('instructor_id', $instructorId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function analytics(){

        $payments = Checkout::courseEnrolledByInstructor()->where('instructor_id',Auth::user()->id)->paginate(12);

        $courses = Course::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('dashboard/instructor/dashboard',compact('courses','payments'));
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

    private function getEarningByDates($data)
    {
        $earningsByDate = [];

        foreach ($data as $record) {
            $createdAt = Carbon::parse($record['created_at']);
            $amount = $record['amount'];

            $createdDate = $createdAt->format('Y-m-d');

            if (!isset($earningsByDate[$createdDate])) {
                $earningsByDate[$createdDate] = 0;
            }

            $earningsByDate[$createdDate] += $amount;
        }

        return $earningsByDate;
    }

    private function getEarningByMonth($data)
    {
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

    private function getCourseWisePayments($enrolments)
    {
        $course_wise_payments = [];
        foreach ($enrolments as $enrolment) {
            $students[$enrolment->user_id] = $enrolment->user;
            $title = substr($enrolment->course->title, 0, 20);
            if (strlen($enrolment->course->title) > 20) {
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

    public function subdomain()
    {
        return view('latest-auth.subdomain');
    }

    public function checkSubdomain($user_id, Request $request)
    {
        $request->validate([
            // 'username' => 'required|string|max:32|unique:users,username,' . $user_id . '|regex:/^[a-zA-Z0-9]+$/u',
            'subdomain' => 'required|string|max:32|regex:/^[a-zA-Z0-9]+$/u',
        ]);

        $proposedUsername = $request->subdomain;

        $existingUser = User::where('subdomain', $proposedUsername)->first();

        if ($existingUser) {
            $suggestedUsernames = [];
            $count = rand(10, 99);

            while (count($suggestedUsernames) < 2) {
                $suggestedUsername = $proposedUsername . $count;
                if (!User::where('subdomain', $suggestedUsername)->exists()) {
                    $suggestedUsernames[] = $suggestedUsername;
                }
                $count++;
            }
            session(['suggestedUsernames' => $suggestedUsernames]);

            return redirect()->back();

        } else {
            $user = User::find($user_id);
            $user->subdomain = $request->subdomain;
            $user->save();

            if (session('suggestedUsernames')) {
                session()->forget('suggestedUsernames');
            }

            return redirect('instructor/profile/step-4/complete');
        }


    }
}
