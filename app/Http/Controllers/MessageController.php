<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
     // message
     public function index(Request $request)
     {    
        $course_id = $request->query('course');
        
        // $param2 = $request->query('param2');
        $userId = Auth::user()->id;
        $courses = Course::where('user_id', $userId)->get();
        $course_ids = Course::where('user_id', $userId)->pluck('id')->toArray();
        $search_course_id = $course_id ? [(int)$course_id] : $course_ids;

        $chat_rooms = Message::with('user','course')->whereIn('course_id',$search_course_id)->orderBy('created_at')->get()->groupBy(function($data) {
            return $data->receiver_id;
        });
         return view('e-learning/course/instructor/message-list',compact('chat_rooms','courses')); 
     }
 
     // instructor message list
     public function send($courseId)
     {    
        $userId = Auth::user()->id;
        $message = Message::where('user_id', $userId)->where('course_id',$courseId)->first();

        if(isset($message->receiver_id)){
            $messages = Message::with('course')->where('receiver_id',$message->receiver_id)->get();
        }else{
            $messages = Message::where('user_id', $userId)->where('course_id',$courseId)->get();
        }

        $reciver_info = Course::with('user')->where('id',$courseId)->first();
        $sender_info = Auth::user();

        return view('e-learning/course/instructor/message',compact('messages','userId','courseId','reciver_info','sender_info')); 
     } 

     public function getChatRoomMessages($chat_room){
        $userId = Auth::user()->id;
        $messages = Message::with('course')->where('receiver_id',$chat_room)->get();
        $chat_users_fetch = Message::where('receiver_id',$chat_room)->pluck('user_id')->toArray();
        $chat_users = array_unique($chat_users_fetch);
        foreach($chat_users as $chat_user){
            if($chat_user == $userId){
                $sender_id = $chat_user; 
            }else{
                $sender_id = $userId; 
                $reciver_id = $chat_user;
            }
        }
        $sender_info = User::where('id',$sender_id)->first();
        $reciver_info = User::where('id',$reciver_id)->first();
        $courseId =  $messages[0]->course_id; 

          
       

        return view('e-learning/course/instructor/message_chat_room-2',compact('messages','userId','chat_room','sender_info','reciver_info')); 

     }

     public function postChatRoomMessages(Request $request, $chat_room){

        $request->validate([
            'message' => 'required', 
        ]);

        $userId = Auth::user()->id;
        $message= Message::with('course')->where('receiver_id',$chat_room)->first();
        $message = new Message([
            'receiver_id'   => $chat_room, 
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
                'receiver_id'   => mt_rand(10000000, 99999999), 
                'course_id' => $course_id,
                'user_id'   => $userId,
                'message'   => $request->message
            ]); 
            $first_message->save();
        }else{
            $message = new Message([
                'receiver_id'   => $message->receiver_id, 
                'course_id' => $course_id,
                'user_id'   => $userId,
                'message'   => $request->message
            ]); 
            $message->save();
        }
       
        return redirect()->route('get.message',$course_id)->with('message', 'Form submitted successfully!');

     }
}
