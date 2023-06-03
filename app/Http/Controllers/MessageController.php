<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Course;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
     // message
     public function index()
     {    
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->pluck('id')->toArray();
        $chat_rooms = Message::with('user')->whereIn('course_id',$courses)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->chat_id;
        });
         return view('e-learning/course/instructor/message-list',compact('chat_rooms')); 
     }
 
     // instructor message list
     public function send($courseId)
     {    
        $userId = Auth::user()->id;
        $messages = Message::where('user_id', $userId)->where('course_id',$courseId)->get();
        // if($messages->isEmpty()){
        //     $first_message = new Message([
        //         'chat_id'   => mt_rand(10000000, 99999999), 
        //         'course_id' => $courseId,
        //         'user_id'   => $userId,
        //         'message'   => 'Hello'
        //     ]); 
        //     $first_message->save();
        // }
        return view('e-learning/course/instructor/message',compact('messages','userId','courseId')); 
     } 

     public function submitMessage(Request $request, $course_id){
        
        $request->validate([
            'message' => 'required', 
        ]);

        $userId = Auth::user()->id;
        $message= Message::where('user_id', $userId)->where('course_id',$course_id)->first();
        if(!$message){
            $first_message = new Message([
                'chat_id'   => mt_rand(10000000, 99999999), 
                'course_id' => $course_id,
                'user_id'   => $userId,
                'message'   => $request->message
            ]); 
            $first_message->save();
        }else{
            $message = new Message([
                'chat_id'   => $message->chat_id, 
                'course_id' => $course_id,
                'user_id'   => $userId,
                'message'   => $request->message
            ]); 
            $message->save();
        }
       
        return redirect()->route('get.message',$course_id)->with('message', 'Form submitted successfully!');

     }
}
