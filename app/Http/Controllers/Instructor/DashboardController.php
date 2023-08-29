<?php

namespace App\Http\Controllers\Instructor;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // return "From Instructor Dashboard Controller"; 
        $categories = [];
        $courses = 0;
        $students = [];

        $enrolments = Checkout::where('instructor_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $activeInActiveStudents = $this->getActiveInActiveStudents($enrolments);
        $earningByDates = $this->getEarningByDates($enrolments);
        $earningByMonth = $this->getEarningByMonth($enrolments);
        $course_wise_payments = $this->getCourseWisePayments($enrolments);

        $courses = Course::where('user_id', Auth::user()->id)->get();
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

        $categories = array_unique($unique_array);

        // return $earningByDates;
        return view('dashboard/instructor/analytics', compact('categories', 'courses', 'students', 'enrolments', 'course_wise_payments', 'activeInActiveStudents', 'earningByDates','earningByMonth'));
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

    public function username($user_id, Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:32|unique:users,username,' . $user_id . '|regex:/^[a-zA-Z0-9]+$/u',
        ]);

        $user = User::find($user_id);
        $user->username = $request->username;
        $user->save();
        return redirect('instructor/profile/step-4/complete');
    }
}