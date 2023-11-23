<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupParticipant;
use File;
class GroupController extends Controller
{
    public function createGroup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required| min:3'
        ]);

        $characters = md5(time());
        $code = substr($characters, 0, 7);
        $group = Group::create([
            'name' => $request->name,
            'code' => $code,
            'admin_id' => auth()->user()->id,
        ]);

        if ($group && isset($request->user_id) && !empty($request->user_id)) {
            $group_id = $group->id;
            $userIds = explode(',', $request->user_id);

            collect($userIds)->each(function ($userId) use ($group_id) {
                GroupParticipant::create([
                    'user_id' => $userId,
                    'group_id' => $group_id,
                    'status' => 0,
                ]);
            });
        }

        $data = [
            "success" => "Group successfully created!!",
        ];
        return response()->json($data);
    }

    public function updateGroup( Request $request ){
        $group = Group::findOrFail( $request->groupId  );

        $group->update(["name" => $request->name]);
        return response()->json(['success' => 'Group update successfully!!']);
    }

    public function deleteGroup( Request $request ){
        $chats = Chat::where('group_id', $request->groupId);
        $chats->each(function ($chat) {
            $fileName = $chat->file_name;
            $path = storage_path("app/public/chat/{$fileName}");

            if (File::exists($path)) {
                File::delete($path);
            }
        });
        $chats->delete();

        $group = Group::with('participants')->findOrFail( $request->groupId  );
        $group->participants()->delete();
        $group->delete();
        return response()->json(['success' => 'Group deleted successfully!!']);
    }
    public function loadSuggestedPeople(Request $request)
    {
        if ($request->ajax()) {
            $data['user'] = User::findOrFail($request->userId);
            return view('e-learning.course.instructor.message-group.suggested-people', $data);
        }
    }

}
