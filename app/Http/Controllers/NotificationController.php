<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
Use \Carbon\Carbon;

class NotificationController extends Controller
{
    public function notificationDetails()
    {
        $unseens = Notification::where('user_id',Auth::user()->id)->where('status','unseen')->select('id','user_id','status')->get();
        foreach ($unseens as $key => $unseen) 
        {
            Notification::where('user_id',Auth::user()->id)->where('status','unseen')->update(['status'=>'seen']);
        }
        $currentYear = Carbon::now()->subDays(365); 
        $today = Carbon::now();
        $lastOneYears = Notification::leftjoin('users','notifications.user_id','=','users.id')
                                        ->where('notifications.user_id',Auth::user()->id)
                                        ->whereYear('notifications.created_at','>', $currentYear) 
                                        ->select('notifications.id','notifications.type','notifications.message','users.avatar','notifications.created_at')
                                        ->orderBy('notifications.created_at','DESC')
                                        ->get();
        $todays = [];
        $yestardays = [];
        $sevenDays = [];
        $thirtyDays = [];
        foreach ($lastOneYears as $key => $lastOneYear) 
        {
            // Start Todays
            $today = Carbon::parse(Carbon::now())->toDateString();
            $getQueryDate = Carbon::parse($lastOneYear->created_at)->toDateString();
            if($today == $getQueryDate)
            {
                $todays[] = array(
                    'id' => $lastOneYear->id,
                    'type' => $lastOneYear->type,
                    'message' => $lastOneYear->message,
                    'avatar' => $lastOneYear->avatar,
                    'create' => $lastOneYear->created_at
                );
            }
            // End Todays
            // Start Yestarday
            $yestarday = Carbon::parse(Carbon::yesterday())->toDateString();
            if($getQueryDate == $yestarday)
            {
                $yestardays[] = array(
                    'id' => $lastOneYear->id,
                    'type' => $lastOneYear->type,
                    'message' => $lastOneYear->message,
                    'avatar' => $lastOneYear->avatar,
                    'create' => $lastOneYear->created_at
                );
            }
            // End Yestarday
            // Start 7 days
            $lastSevenDaysDate = Carbon::parse(Carbon::now()->subDays(7))->toDateString();
            if($getQueryDate > $lastSevenDaysDate)
            {
                $sevenDays[] = array(
                    'id' => $lastOneYear->id,
                    'type' => $lastOneYear->type,
                    'message' => $lastOneYear->message,
                    'avatar' => $lastOneYear->avatar,
                    'create' => $lastOneYear->created_at
                );
            }
            // End 7 days
            // Start 30 days
            $lastThirtyDaysDate = Carbon::parse(Carbon::now()->subDays(30))->toDateString();
            if($getQueryDate > $lastThirtyDaysDate)
            {
                $thirtyDays[] = array(
                    'id' => $lastOneYear->id,
                    'type' => $lastOneYear->type,
                    'message' => $lastOneYear->message,
                    'avatar' => $lastOneYear->avatar,
                    'create' => $lastOneYear->created_at
                );
            }
            // End 30 days
        }
        // return $thirtyDays;
        return view('instructor.notification.system',compact('todays','yestardays','sevenDays','thirtyDays','lastOneYears'));
    }
}
