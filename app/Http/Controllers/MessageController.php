<?php

namespace App\Http\Controllers;


use Pusher\Pusher;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    // message
    public function index(Request $request)
    {
        $users = DB::select("select users.id, users.name, users.avatar, users.email, count(is_read) as unread
        from users LEFT  JOIN  chats ON users.id = chats.from and is_read = 0 and chats.to = " . Auth::id() . "
        where users.id != " . Auth::id() . "
        group by users.id, users.name, users.avatar, users.email");

        // return view('e-learning/course/instructor/message-list-backup', compact('users'));

        return view('e-learning/course/instructor/message-list', compact('users'));
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

        // dd( $request->all() );

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
            $image = substr(md5( time()), 0, 10).'.'.$file->getClientOriginalExtension();
            $fileName = $file->storeAs('chat', $image ,'public');
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


    public function searchChatUser( Request $request){

        $searchTerm = $request->input('term');

        $data['users'] = DB::table('users')
        ->select('users.id', 'users.name', 'users.avatar', 'users.email')
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

    public function downloadChatFile( $filename ){

        $path = storage_path('app/public/chat/' . $filename);

        //dd( $path );
        // $dd = public_path($filename );

        // dd( $dd );
        // if (!Storage::exists($path)) {
        //     abort(404);
        // }
        return response()->download($path, $filename);
    }
}
