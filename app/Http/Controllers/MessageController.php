<?php

namespace App\Http\Controllers;


use File;
use Pusher\Pusher;
use App\Models\Chat;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{

    public function index(Request $request)
    {
        $data['adminInfo'] = Auth::user();
        $data['users'] = User::select(
            'users.id',
            'users.name',
            'users.avatar',
            'users.email',
        )
            ->withCount([
                'chats as unread' => function ($query) {
                    $query->where('is_read', 0)->where('receiver_id', Auth::id());
                },
            ])
            ->where('users.id', '!=', Auth::id())
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
            ->get();

        $data['groups'] = Group::whereHas('participants')->latest()->get();

        // $userId = Auth::id();
        // return $data['users']=  Chat::join(DB::raw('(SELECT
        // LEAST(sender_id, receiver_id) AS min_user_id,
        // GREATEST(sender_id, receiver_id) AS max_user_id,
        // MAX(created_at) AS last_message_time
        // FROM chats
        // WHERE sender_id = ? OR receiver_id = ?
        // GROUP BY min_user_id, max_user_id) AS subquery'), function ($jToin) {
        //     $join->on(DB::raw('LEAST(chats.sender_id, chats.receiver_id)'), '=', 'subquery.min_user_id')
        //          ->on(DB::raw('GREATEST(chats.sender_id, chats.receiver_id)'), '=', 'subquery.max_user_id')
        //          ->on('chats.created_at', '=', 'subquery.last_message_time');
        // })
        // ->where(function ($query) use ($userId) {
        //     $query->where('chats.sender_id', $userId)
        //         ->orWhere('chats.receiver_id', $userId);
        // })
        // ->addBinding($userId, 'select')
        // ->addBinding($userId, 'select')
        // ->get();



        // return $data;
        // return view('e-learning/course/instructor/message-list-backup', $data);

        return view('e-learning/course/instructor/message-list', $data);
    }


    // One to one get chat message
    public function getChatMessage(Request $request)
    {
        if ($request->ajax()) {
            $user_id = $request->receiver_id;
            $my_id = Auth::id();
            $data['friend'] = User::findOrFail($user_id);

            // Make read all unread message
            Chat::where(['sender_id' => $user_id, 'receiver_id' => $my_id])->update(['is_read' => 1]);

            // Get all message from selected user
            $data['messages'] = Chat::where(function ($query) use ($user_id, $my_id) {
                $query->where(["sender_id" => $user_id, "receiver_id" => $my_id, "message_type" => 1, "is_read" => 1]);
            })->orWhere(function ($query) use ($user_id, $my_id) {
                $query->where(["sender_id" => $my_id, "receiver_id" => $user_id, "message_type" => 1, "is_read" => 1]);
            })->get();

            return view('e-learning.course/instructor.chat', $data);
        }
    }

    // One to one send chat message
    public function sendChatMessage(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'message' => 'required_without:file', // Message is required if file is not present
                'file' => 'required_without:message|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,zip,mp3, mp4,dat|max:1024',
            ]);

            $sender_Id = Auth::id();
            $receiver_id = $request->receiver_id;
            $message = $request->message;

            $data = new Chat();
            $data->sender_id = $sender_Id;
            $data->receiver_id = $receiver_id;
            $data->message = $message;
            $data->message_type = 1;
            $data->is_read = false;
            $data->save();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $image = substr(md5(time()), 0, 10) . '.' . $file->getClientOriginalExtension();
                $fileName = $file->storeAs('chat', $image, 'public');
                $data->update([
                    'file' => $image,
                    'file_extension' => $file->getClientOriginalExtension(),
                    'file_type' => 2
                ]);
            }

            // pusher
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

            $data = ['from' => $sender_Id, 'to' => $receiver_id];
            $pusher->trigger('my-channel', 'my-event', $data);
        }
    }


    // One to many get chat message
    public function getGroupChatMessage(Request $request)
    {
        if ($request->ajax()) {

            // dd( $request->all() );

            $data['myInfo'] = User::find(Auth::id());
            $data['currentGroup'] = Group::with('participants')->where('id', $request->receiver_id)->with('participants')->firstOrFail();

            Chat::where(['group_id' => $request->receiver_id])->update(['is_read' => 1]);

            $data['messages'] = Chat::where(function ($query) use ($request) {
                $query->where(['group_id' => $request->receiver_id, "message_type" => 2, "is_read" => 1]);
            })->get();

            // dd( $data['messages']->toArray() );

            $maxUpdatedAt = $data['messages']->max('updated_at');

            $data['currentGroup']->update(['updated_at' => $maxUpdatedAt]);

            return view('e-learning.course.instructor.group-chat', $data);
        }
    }

    // Send group message
    public function sendGroupMessage(Request $request)
    {
        if ($request->ajax()) {

            $request->validate([
                'message' => 'required_without:file',
                'file' => 'required_without:message|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,zip,mp3, mp4,dat|max:1024',
            ]);

            $sender_Id = Auth::id();
            $participants = GroupParticipant::where('group_id', $request->receiver_id)->get();

            $data = new Chat();

            $data->sender_id = $sender_Id;
            $data->receiver_id = null;
            $data->group_id = $request->receiver_id;
            $data->message = $request->message;
            $data->message_type = 2;
            $data->is_read = false;
            $data->save();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $image = substr(md5(time()), 0, 10) . '.' . $file->getClientOriginalExtension();
                $fileName = $file->storeAs('chat', $image, 'public');
                $data->update([
                    'file' => $image,
                    'file_extension' => $file->getClientOriginalExtension(),
                    'file_type' => 2
                ]);
            }

            foreach ($participants as $member) {

                // pusher
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

                $data = ['from' => $request->receiver_id, 'to' => $member->user_id];

                $notify = '' . $member->user_id . '';
                $pusher->trigger($notify, 'App\\Events\\Notify', $data);
            }
        }
    }


    public function searchChatUser(Request $request)
    {
        if ($request->ajax()) {
            // dd( $request->all());
            $searchTerm = $request->input('term');
            $layoutDesing = $request->input('layout');

            $data['users'] = User::select(
                'users.id',
                'users.name',
                'users.avatar',
                'users.email',
            )
                ->withCount([
                    'chats as unread' => function ($query) {
                        $query->where('is_read', 0)->where('receiver_id', Auth::id());
                    },
                ])
                ->where('users.id', '!=', Auth::id())
                ->where('users.name', 'LIKE', '%' . $searchTerm . '%')
                ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
                ->get();

            // dd( $data['users']->toArray() );

            if ($layoutDesing == "layout1") {
                return view('e-learning.course.instructor.chat-user.search-users-for-group', $data);
            } else {
                return view('e-learning.course.instructor.chat-user.search-users', $data);
            }
        }
    }

    public function deleteSingleChatHistory(Request $request)
    {
        $userId = $request->userId;

        $chats = Chat::where('sender_id', $userId)->orWhere('receiver_id', $userId);

        $chats->each(function ($chat) {
            $fileName = $chat->file_name;
            $path = storage_path("app/public/chat/{$fileName}");
            if (File::exists($path)) {
                File::delete($path);
            }
        });

        $chats->delete();
        return response()->json(['success' => 'Chat messages deleted successfully!!']);
    }

    public function deleteGroupChatHistory(Request $request)
    {
        $chats = Chat::where('group_id', $request->groupId);

        $chats->each(function ($chat) {
            $fileName = $chat->file_name;
            $path = storage_path("app/public/chat/{$fileName}");

            if (File::exists($path)) {
                File::delete($path);
            }
        });
        $chats->delete();
        return response()->json(['success' => 'Group messages deleted successfully!!']);
    }

    public function downloadChatFile($filename)
    {
        $path = storage_path('app/public/chat/' . $filename);
        if (!File::exists($path)) {
            abort(404);
        }
        return response()->download($path, $filename);
    }
}
