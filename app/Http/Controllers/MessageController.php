<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Course;
use App\Models\User;
use App\Models\Cart;
use App\Mail\MessageSent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class MessageController extends Controller
{
     // message
    public function index(Request $request)
    {
        $cartCount = Cart::where('user_id', auth()->id())->count();
        $course_id = $request->query('course');
        $senderId = $request->query('sender');
        $userId = Auth::user()->id;

        $highLightMessages = Message::with(['course'])->where('receiver_id',$userId)->orWhere('sender_id',$userId)->get()->groupBy(function($data) use ($userId){
            if( $data->receiver_id == $userId){
                return $data->sender_id;
            }
            if( $data->sender_id == $userId){
                return $data->receiver_id;
            }
        });


        foreach ($highLightMessages as $messages) {
            foreach( $messages as $message){
                if($message->receiver_id == $userId ){
                    $message['user'] = User::find($message->sender_id );
                }else{
                    $message['user'] = User::find($message->receiver_id );
                }
            }
        }

        if($senderId){
            $senderInfo =  User::find($senderId);
            $messages = Message::where(function ($query) use ($senderId, $userId){
                $query->where('receiver_id', $senderId)->where('sender_id', $userId);
            })
            ->orwhere(function ($query) use ($senderId, $userId){
                $query->where('receiver_id', $userId)->where('sender_id', $senderId);
            })->get();
        }else{
            $messages = $highLightMessages->first() ? $highLightMessages->first() : [];
            $senderInfo =  User::find($highLightMessages->keys()->first());
        } 

        return view('e-learning/course/instructor/message-list',compact('highLightMessages','messages','userId','senderInfo','cartCount'));
     }

     // instructor message list
     public function send($courseId)
     { 

        $userId = Auth::user()->id;
        $message = Message::where('sender_id', $userId)->where('course_id',$courseId)->first();

        if(isset($message->receiver_id)){
            $messages = Message::with('course')->where('receiver_id',$message->receiver_id)->get();
        }else{
            $messages = Message::where('sender_id', $userId)->where('course_id',$courseId)->get();
        }

        $reciver_info = Course::with('user')->where('id',$courseId)->first();
        $sender_info = Auth::user();


        return view('e-learning/course/instructor/message',compact('userId','courseId','reciver_info','sender_info'));
     }

     public function getChatRoomMessages($chat_room){
        $userId = Auth::user()->id;
        $messages = Message::with('course')->where('receiver_id',$chat_room)->get();
        $chat_users_fetch = Message::where('receiver_id',$chat_room)->pluck('sender_id')->toArray();
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
            'sender_id'   => $userId,
            'message'   => $request->message
        ]);
        $message->save();

        return redirect()->route('get.chat_room.message',$chat_room)->with('message', 'Form submitted successfully!');

     }

     public function submitMessage(Request $request, $course_id){

        $request->validate([
            'message' => 'required',
        ]);
 
        $receiverId = Course::with('user')->where('id',$course_id)->first();
        
        $message = new Message([
            'receiver_id' => $receiverId->user->id,
            'course_id'   => $course_id,
            'sender_id'   => Auth::user()->id,
            'message'     => $request->message
        ]);  

        $message->save(); 

         // Send email
         Mail::to($receiverId->user->email)->send(new MessageSent($message));

        return redirect()->route('message')->with('message', 'Form submitted successfully!');


     }


     public function sendMessage(Request $request){
        $senderId = $request->query('sender');

        $request->validate([
            'message' => 'required',
        ]);

        $userId = Auth::user()->id;
        $message = new Message([
            'receiver_id' => $senderId,
            'course_id'   => '',
            'sender_id'     => $userId,
            'message'     => $request->message
        ]);
        $message->save();

        return redirect()->back();

     }
}
