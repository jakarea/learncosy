<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use Illuminate\Http\Request;

class TypingController extends Controller
{
    public function startTyping(Request $request)
    {
        $user = $request->user();
        $channel = 'typing-channel';
        $event = 'typing-started';

        $this->broadcastTypingEvent($channel, $event, $user->name);
    }

    public function stopTyping(Request $request)
    {
        $user = $request->user();
        $channel = 'typing-channel';
        $event = 'typing-stopped';

        $this->broadcastTypingEvent($channel, $event, $user->name);
    }

    private function broadcastTypingEvent($channel, $event, $message)
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



        $pusher->trigger($channel, $event, ['message' => $message]);
    }
}
