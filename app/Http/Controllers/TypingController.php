<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Group;
use App\Models\GroupParticipant;
use Illuminate\Http\Request;

class TypingController extends Controller
{
    public function startTyping(Request $request)
    {
        $this->validate($request, [
            'receiver_id' => 'required|integer',
        ]);


        $sender_id = auth()->user();
        $receiver_id = $request->receiver_id;
        $channel = 'typing-channel';
        //$channel = 'private-typing-channel-' . $sender_id . '-' . $receiver_id;
        $event = 'typing-started';
        $userInfo = $this->getUserInfo($receiver_id);
        $this->broadcastTypingEvent($channel, $event, $userInfo);
    }

    public function stopTyping(Request $request)
    {
        $this->validate($request, [
            'receiver_id' => 'required|integer',
        ]);

        $sender_id = auth()->user();
        $receiver_id = $request->receiver_id;
        $userInfo = $this->getUserInfo($receiver_id);
        //$channel = 'private-typing-channel-' . $sender_id . '-' . $receiver_id;
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
            'receiver_id' => 'required|integer',
        ]);

        $channel = 'typing-channel';
        $event = 'group-typing-started';
        $group_id = $request->receiver_id;
        $userInfo = $this->getUserInfo($group_id);
        $this->broadcastGroupTypingEvent($channel, $event, $userInfo);
    }

    public function stopGroupTyping(Request $request)
    {
        $this->validate($request, [
            'receiver_id' => 'required|integer',
        ]);

        $channel = 'typing-channel';
        $event = 'group-typing-stopped';
        $groupId = $request->receiver_id;
        $userInfo = $this->getUserInfo($groupId);
        $this->broadcastGroupTypingEvent($channel, $event, $userInfo);
    }

    private function broadcastGroupTypingEvent($channel, $event, $userInfo)
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

        $typingUsers = session('typingUsers', []);

        $typingUsers[$userInfo['id']] = $userInfo;

        session(['typingUsers' => $typingUsers]);

        // // dd( $typingUsers );

        $pusher->trigger($channel, $event, ['typing_users' => $typingUsers]);

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
