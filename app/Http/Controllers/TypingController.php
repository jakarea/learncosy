<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;

class TypingController extends Controller
{
    public function startTyping(Request $request)
    {
        $user = auth()->user();
        $channel = 'typing-channel';
        $event = 'typing-started';

        $userInfo = $this->getUserInfo($user);
        $this->broadcastTypingEvent($channel, $event, $userInfo);
    }

    public function stopTyping(Request $request)
    {
        $user = auth()->user();
        $userInfo = $this->getUserInfo($user);
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


    private function getUserInfo($user)
    {
        return [
            'name' => $user->name,
            'avatar' => $user->avatar, // Replace with the actual field in your users table
        ];
    }
}
