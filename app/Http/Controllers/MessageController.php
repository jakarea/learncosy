<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Course;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
     // message
     public function index(Request $request)
     {    
        // $course = $request->query('course');
        
        // $param2 = $request->query('param2');
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->pluck('id')->toArray();
        $chat_rooms = Message::with('user','course')->whereIn('course_id',$courses)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->chat_id;
        });
         return view('e-learning/course/instructor/message-list',compact('chat_rooms','courses')); 
     }
 
     // instructor message list
     public function send($courseId)
     {    
        $userId = Auth::user()->id;
        $message = Message::where('user_id', $userId)->where('course_id',$courseId)->first();
        if(isset($message->chat_id)){
            $messages = Message::with('course')->where('chat_id',$message->chat_id)->get();
        }else{
            $messages = Message::where('user_id', $userId)->where('course_id',$courseId)->get();
        }

        return view('e-learning/course/instructor/message',compact('messages','userId','courseId')); 
     } 

     public function getChatRoomMessages($chat_room){
        $userId = Auth::user()->id;
        $messages = Message::with('course')->where('chat_id',$chat_room)->get();
        $courseId =  $messages[0]->course_id;
        return view('e-learning/course/instructor/message_chat_room',compact('messages','userId','chat_room')); 

     }

     public function postChatRoomMessages(Request $request, $chat_room){

        $request->validate([
            'message' => 'required', 
        ]);

        $userId = Auth::user()->id;
        $message= Message::with('course')->where('chat_id',$chat_room)->first();
        $message = new Message([
            'chat_id'   => $chat_room, 
            'course_id' => $message->course_id,
            'user_id'   => $userId,
            'message'   => $request->message
        ]); 
        $message->save();
    
        return redirect()->route('get.chat_room.message',$chat_room)->with('message', 'Form submitted successfully!');

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
