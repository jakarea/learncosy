<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Checkout;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        $categories = [];
        $courses = 0;
        $students = [];

        $enrolments = Checkout::where('instructor_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $activeInActiveStudents = $this->getActiveInActiveStudents($enrolments);
        $earningByDates = $this->getEarningByDates($enrolments);
        $course_wise_payments = $this->getCourseWisePayments($enrolments);

        $courses = Course::where('user_id', Auth::user()->id)->get();
        $allCategories = $courses->pluck('categories'); 

        foreach($allCategories as $category){ 
            $cats = explode(",", $category);
            foreach($cats as $cat){
                $unique_array[] = strtolower($cat);
            }
        }

        foreach($enrolments as $enrolment){
            $students[$enrolment->user_id] = $enrolment->created_at;
        }

        $categories = array_unique($unique_array);
        return view('dashboard/instructor/dashboard',compact('categories','courses','students','enrolments','course_wise_payments','activeInActiveStudents','earningByDates')); 
    }

    private function getActiveInActiveStudents($data){
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
            $dates[] =  $createdDate;
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

    private function getEarningByDates($data){
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

    private function getCourseWisePayments($enrolments){
        $course_wise_payments = [];
        foreach($enrolments as $enrolment){
            $students[$enrolment->user_id] = $enrolment->user;
            $title = substr($enrolment->course->title,0,30);
            if (strlen($enrolment->course->title) > 30) {
                $title .= "...";
            }
            if(isset($course_wise_payments[$title])){
                $course_wise_payments[$title] = $course_wise_payments[$title] + $enrolment->amount;
            }else{
                $course_wise_payments[$title] =  $enrolment->amount;
            }
        }
        return $course_wise_payments;
    }
}