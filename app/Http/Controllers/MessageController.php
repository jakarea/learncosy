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

    public function index()
    {
        $data['adminInfo'] = Auth::user();

        $data['users'] = User::select(
                'users.id',
                'users.name',
                'users.avatar',
                'users.email',
            )
            // ->withCount([
            //     'chats as unread' => function ($query) {
            //         $query->where('is_read', 0)->where('receiver_id', Auth::id());
            //     },
            // ])
            ->with([
                'chats' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
                    })
                    ->latest()
                    ->limit(1);
                },
            ])
            // ->where('users.subdomain', '=', config('app.subdomain') )
            // ->where('users.id', '!=', Auth::id())
            ->where([
                ['users.recivingMessage', true],
                ['users.subdomain', config('app.subdomain')],
                ['users.id', '!=', Auth::id()],
            ])

            ->orderByDesc('last_activity_at')
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
            ->get();

                $data['groups'] = Group::whereHas('participants', function ($query) use ($data) {
                    $query->where('user_id', $data['adminInfo']->id);
                })->orWhere('admin_id', $data['adminInfo']->id)->latest()->get();

        return view('e-learning/course/instructor/message-list', $data);

    }

    public function allChatsAndGroups(){
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

            ->where([
                ['users.recivingMessage', true],
                ['users.subdomain', config('app.subdomain')],
                ['users.id', '!=', Auth::id()],
            ])

            ->orderByDesc('last_activity_at')
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
            ->get();

            $user = auth()->user();
            $data['groups'] = Group::whereHas('participants', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();

        return view('e-learning/course/instructor/groups-chats', $data);
    }

    public function allGroups(Request $request){
        if( $request->ajax() ){
            $user = auth()->user();
            $data['groups'] = Group::whereHas('participants', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
            return view('e-learning.course.instructor.message-group.group-list', $data);
        }
    }


    public function getUserList()
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
            ->with([
                'chats' => function ($query) {
                    $query->where(function ($query) {
                        $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
                    })
                    ->latest()
                    ->limit(1);
                },
            ])

            ->where([
                ['users.recivingMessage', true],
                ['users.subdomain', config('app.subdomain')],
                ['users.id', '!=', Auth::id()],
            ])

            ->orderByDesc('last_activity_at')
            ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
            ->get();

            $data['groups'] = Group::whereHas('participants', function ($query) use ($data) {
                $query->where('user_id', $data['adminInfo']->id);
            })->latest()->get();
        return view('e-learning/course/instructor/groups-chats', $data);
    }


    // One to one get chat message
    public function getChatMessage(Request $request)
    {
        if ($request->ajax()) {
            $receiver_id = $request->receiver_id;
            $my_id = Auth::id();
            $data['friend'] = User::findOrFail($receiver_id);

            // Make read all unread message
            Chat::where(['sender_id' => $receiver_id, 'receiver_id' => $my_id])->update(['is_read' => 1]);

            // Get all message from selected user

            $data['messages'] = Chat::where(function ($query) use ($receiver_id, $my_id) {
                $query->where(["sender_id" => $receiver_id, "receiver_id" => $my_id, "message_type" => 1, "is_read" => 1]);
            })->orWhere(function ($query) use ($receiver_id, $my_id) {
                $query->where(["sender_id" => $my_id, "receiver_id" => $receiver_id, "message_type" => 1, "is_read" => 1]);
            })->get();

            return view('e-learning.course/instructor.chat', $data);
        }
    }

    // One to one send chat message
    public function sendChatMessage(Request $request)
    {
        // dd( $request->all() );
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
            $data->is_read = true;
            $data->save();

            if($request->hasFile('file')){
                $file =  $request->file('file');
                $fileName  = substr(md5(time()), 0, 10) . '.' . $file->getClientOriginalExtension();
                $destination  = "uploads/chat";
                $file->move($destination, $fileName);

                $data->update([
                    'file' => $fileName,
                    'file_extension' => $file->getClientOriginalExtension(),
                    'file_type' => 2
                ]);
            }

            User::find([$sender_Id, $receiver_id])->each->update(['last_activity_at' => now()]);

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

            $data = ['from' => $sender_Id, 'to' => $receiver_id, 'signal' => 'update-user-list'];

            $pusher->trigger('my-channel', 'my-event', $data);

            // $user = auth()->user();
            // $message = Chat::where("sender_id", $user->id) ->latest('created_at')->firstOrFail();
            // return view('e-learning/course/instructor/chat-user/sender',compact('user', 'message'));
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
            // dd($participants );

            $data = new Chat();

            $data->sender_id = $sender_Id;
            $data->receiver_id = null;
            $data->group_id = $request->receiver_id;
            $data->message = $request->message;
            $data->message_type = 2;
            $data->is_read = false;
            $data->save();

            if($request->hasFile('file')){
                $image =  $request->file('file');
                $imagename  = substr(md5(time()), 0, 10) . '.' . $image->getClientOriginalExtension();
                $destination  = "uploads/chat";
                $image->move($destination, $imagename);

                $data->update([
                    'file' => $imagename,
                    'file_extension' => $image->getClientOriginalExtension(),
                    'file_type' => 2
                ]);
            }

            User::find($sender_Id)->update(['last_activity_at' => now()]);

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

            $user = User::findOrFail($sender_Id);
            $message = Chat::where("sender_id", $user->id) ->latest('created_at')->firstOrFail();
            return view('e-learning/course/instructor/chat-user/sender',compact('user', 'message'));
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
                ->where([
                    ['users.recivingMessage', true],
                    ['users.subdomain', config('app.subdomain')],
                    ['users.id', '!=', Auth::id()],
                ])
                ->where('users.name', 'LIKE', '%' . $searchTerm . '%')
                ->groupBy('users.id', 'users.name', 'users.avatar', 'users.email')
                ->get();

            // dd( $data['users']->toArray() );

            $user = auth()->user();

            $data['groups'] = Group::where(function ($query) use ($user) {
                $query->whereHas('participants', function ($subQuery) use ($user) {
                    $subQuery->where('user_id', $user->id);
                })->orWhere('admin_id', $user->id);
            })

            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->get();

            if ($layoutDesing == "layout1") {
                return view('e-learning.course.instructor.chat-user.search-users-for-group', $data);
            } elseif($layoutDesing == "layout2") {
                return view('e-learning.course.instructor.chat-user.search-users', $data);
            }else{
                return view('e-learning.course.instructor.message-group.group-list', $data);
            }
        }
    }

    public function deleteSingleChatHistory(Request $request)
    {
        $userId = $request->userId;

        $chats = Chat::where('sender_id', $userId)->orWhere('receiver_id', $userId);

        $chats->each(function ($chat) {

            $fileName = $chat->file;
            $uploadsDirectory = "/uploads/chat/";

            $path = public_path($uploadsDirectory . $fileName);

            if (File::exists($path)) {
                File::delete($path);
            }
        });

        $chats->delete();
        return response()->json(['success' => 'Chat messages deleted successfully!!']);
    }

    public function deleteGroupChatHistory(Request $request)
    {
        dd( $request->all() );
        $chats = Chat::where('group_id', $request->groupId);

        $chats->each(function ($chat) {
            $fileName = $chat->file;
            $uploadsDirectory = "/uploads/chat/";
            $path = public_path($uploadsDirectory . $fileName);

            if (File::exists($path)) {
                File::delete($path);
            }
        });

        $chats->delete();
        return response()->json(['success' => 'Group messages deleted successfully!!']);
    }

    public function downloadChatFile($fileName)
    {
        $uploadsDirectory = "/uploads/chat/";
        $path = public_path($uploadsDirectory . $fileName);
        if (!File::exists($path)) {
            abort(404);
        }
        return response()->download($path, $fileName);
    }



}
