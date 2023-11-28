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


    public function startGroupTyping(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required|integer',
        ]);

        $channel = 'typing-channel';
        $event = 'group-typing-started';
        $group_id = $request->receiver_id;
        $userInfo = $this->getUserInfo(auth()->id());
        $this->broadcastGroupTypingEvent($channel, $event, $userInfo, $group_id);
    }

    public function stopGroupTyping(Request $request)
    {
        $this->validate($request, [
            'group_id' => 'required|integer',
        ]);

        $channel = 'typing-channel';
        $event = 'group-typing-stopped';
        $group_id = $request->receiver_id;
        $userInfo = $this->getUserInfo(auth()->id());
        $this->broadcastGroupTypingEvent($channel, $event, $userInfo, $group_id);
    }

    private function broadcastGroupTypingEvent($channel, $event, $userInfo, $group_id)
    {
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger("group-{$group_id}-{$channel}", $event, ['user_info' => $userInfo]);
    }

    private function getUserInfo($receiver_id)
    {
        $user = auth()->user();
        $receiver = $receiver_id;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'receiver' => $receiver,
        ];
    }
}
