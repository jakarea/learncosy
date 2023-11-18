<?php

namespace App\Http\Controllers;


use Pusher\Pusher;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class MessageController extends Controller
{
    // message
    public function index(Request $request)
    {


        $data['users'] = DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.avatar',
                'users.email',
                DB::raw('(SELECT message FROM chats WHERE (chats.from = users.id OR chats.to = users.id) ORDER BY created_at DESC LIMIT 1) AS last_message'),
                DB::raw('(SELECT file FROM chats WHERE chats.to = ' . Auth::id() . ' AND chats.from = users.id ORDER BY created_at DESC LIMIT 1) AS received_file'),
                DB::raw('(SELECT file FROM chats WHERE chats.from = ' . Auth::id() . ' AND chats.to = users.id ORDER BY created_at DESC LIMIT 1) AS sent_file'),
            )
            ->selectRaw('COUNT(chats.is_read) as unread')
            ->leftJoin('chats', function ($join) {
                $join->on('users.id', '=', 'chats.from')
                    ->where([
                        ['chats.is_read', 0],
                        ['chats.to', Auth::id()],
                    ]);
            })
            ->where('users.id', '!=', Auth::id())
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
            ->get();

        // $userId = Auth::id();
        // return $data['users']=  Chat::join(DB::raw('(SELECT
        // LEAST(sender_id, receiver_id) AS min_user_id,
        // GREATEST(sender_id, receiver_id) AS max_user_id,
        // MAX(created_at) AS last_message_time
        // FROM chats
        // WHERE sender_id = ? OR receiver_id = ?
        // GROUP BY min_user_id, max_user_id) AS subquery'), function ($join) {
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
        // return view('e-learning/course/instructor/message-list-backup', compact('users'));

        return view('e-learning/course/instructor/message-list', $data);
    }

    public function getChatMessage($user_id)
    {

        $my_id = Auth::id();

        $data['friend'] = User::findOrFail($user_id);

        // Make read all unread message
        Chat::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $data['messages'] = Chat::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('e-learning.course/instructor.chat', $data);
    }

    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'message' => 'required_without:file', // Message is required if file is not present
            'file' => 'required_without:message|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx,zip,mp3, mp4,dat|max:1024',
        ]);

        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Chat();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $image = substr(md5(time()), 0, 10) . '.' . $file->getClientOriginalExtension();
            $fileName = $file->storeAs('chat', $image, 'public');
            $data->update([
                'file' => $image,
                'file_extension' => $file->getClientOriginalExtension(),
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

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }


    public function searchChatUser(Request $request)
    {
        $searchTerm = $request->input('term');
        $data['users'] = DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'users.avatar',
                'users.email',
                DB::raw('COUNT(chats.is_read) as unread'),
                DB::raw('(SELECT message FROM chats WHERE (chats.from = users.id OR chats.to = users.id) ORDER BY created_at DESC LIMIT 1) AS last_message'),
                DB::raw('(SELECT file FROM chats WHERE (chats.from = users.id AND chats.to = ' . Auth::id() . ' AND file IS NOT NULL) ORDER BY created_at DESC LIMIT 1) AS received_file'),
                DB::raw('(SELECT file FROM chats WHERE (chats.to = users.id AND chats.from = ' . Auth::id() . ' AND file IS NOT NULL) ORDER BY created_at DESC LIMIT 1) AS sent_file')
            )
            ->selectRaw('COUNT(chats.is_read) as unread')
            ->leftJoin('chats', function ($join) {
                $join->on('users.id', '=', 'chats.from')
                    ->where([
                        ['chats.is_read', 0],
                        ['chats.to', Auth::id()],
                    ]);
            })
            ->where('users.id', '!=', Auth::id())
            ->where('users.name', 'LIKE', '%' . $searchTerm . '%')
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
            ->get();

        return view('e-learning.course.instructor.chat-user.users', $data);
    }

    public function deleteSingleChatHistory( Request $request ){
        $userId = $request->userId;

        $chats = Chat::where('from', $userId)->orWhere('to', $userId)->get();

        $chats->each(function ($chat) {
            $fileName = $chat->file_name;
            $path = storage_path("app/public/chat/{$fileName}");
            if (File::exists($path)) {
                File::delete($path);
            }
        });

        Chat::where('from', $userId)->orWhere('to', $userId)->delete();
        return response()->json(['message' => 'Chat messages deleted successfully']);
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
