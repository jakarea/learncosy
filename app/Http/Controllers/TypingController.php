<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;

class TypingController extends Controller
{
    public function startTyping(Request $request)
    {
        $this->validate($request, [
            'receiver_id' => 'required|integer',
        ]);
        $channel = 'typing-channel';
        $event = 'typing-started';
        $receiver_id = $request->receiver_id;
        $userInfo = $this->getUserInfo($receiver_id);
        $this->broadcastTypingEvent($channel, $event, $userInfo);
    }

    public function stopTyping(Request $request)
    {
        $this->validate($request, [
            'receiver_id' => 'required|integer',
        ]);

        $receiver_id = $request->receiver_id;
        $userInfo = $this->getUserInfo($receiver_id);
        $channel = 'typing-channel';
        $event = 'typing-stopped';

        $this->broadcastTypingEvent($channel, $event, $userInfo);
    }

    private function broadcastTypingEvent($channel, $event, $userInfo)
    {
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger($channel, $event, ['user_info' => $userInfo]);
    }


    private function getUserInfo($receiver_id)
    {
        $user = auth()->user();
        $receiver = $receiver_id;
        $currentUserInfo = $user->id == $receiver;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'is_receiver' => true
        ];
    }
}
