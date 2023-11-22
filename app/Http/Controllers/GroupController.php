<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupParticipant;
use Illuminate\Http\Request;

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

    public function loadSuggestedPeople(Request $request)
    {
        if ($request->ajax()) {
            $data['user'] = User::findOrFail($request->userId);
            return view('e-learning.course.instructor.message-group.suggested-people', $data);
        }
    }
}
