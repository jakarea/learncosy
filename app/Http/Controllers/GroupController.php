<?php

namespace App\Http\Controllers;

use File;
use App\Models\Chat;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\GroupParticipant;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function createGroup(Request $request)
    {
        $this->validate($request, [
            'name' => 'required| min:3'
        ]);

        $group = Group::where(['name' => $request->name ])->first();
        if( $group ){
            return response()->json(['error' => 'Group already exists!!']);
        }
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

            $userIds[] = Auth::id();

            collect($userIds)->each(function ($userId) use ($group_id) {
                GroupParticipant::create([
                    'user_id' => $userId,
                    'group_id' => $group_id,
                    'status' => 0,
                ]);
            });
        }

        $data = [
            "groupId" => $group->id,
            "success" => "Group successfully created!!",
        ];
        return response()->json($data);
    }

    public function updateGroup(Request $request)
    {
        if ($request->ajax()) {
            $group = Group::findOrFail($request->groupId);
            $groupName = $request->name ? $request->name : $group->name;

            $fullPath = $group->avatar;
            if ($image = $request->file('avatar')) {
                if (File::exists($group->avatar)) {
                    File::delete($group->avatar);
                }

                $imageExt        = substr(md5(time()), 0, 10) . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'uploads/chat/group/';
                $fullPath        = $destinationPath . $imageExt;
                $image->move($destinationPath, $imageExt);
            }


            $group->update(["name" =>  $groupName, 'avatar' => $fullPath]);
            return response()->json(['success' => 'Group update successfully!!']);
        }
    }

    public function deleteGroup(Request $request)
    {
        if ($request->ajax()) {
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

            $group = Group::with('participants')->findOrFail($request->groupId);
            $group->participants()->delete();

            if (File::exists($group->avatar)) {
                File::delete($group->avatar);
            }

            $group->delete();
            return response()->json(['success' => 'Group deleted successfully!!']);
        }
    }

    public function addPeopleToGroup(Request $request)
    {
        if ($request->ajax()) {

            if (isset($request->user_id) && !empty($request->user_id)) {
                $group_id = $request->groupId;
                $userIds = explode(',', $request->user_id);

                $userIds[] = Auth::id();

                collect($userIds)->each(function ($userId) use ($group_id) {
                    GroupParticipant::updateOrCreate([
                        'user_id' => $userId,
                        'group_id' => $group_id,
                        'status' => 0,
                    ]);
                });
            }

            $data = [
                "success" => "People added successfuly to group!!",
            ];
            return response()->json($data);
        }
    }

    public function loadSuggestedPeople(Request $request)
    {
        if ($request->ajax()) {
            $data['user'] = User::findOrFail($request->userId);
            return view('e-learning.course.instructor.message-group.suggested-people', $data);
        }
    }
}
