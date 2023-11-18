<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{


    public function createGroup( Request $request ) {

        $this->validate($request, [
            'name' => 'required| min:3'
        ]);

        $characters = md5( time());
        $code = substr($characters, 0, 7);
        $group = Group::create([
            'name' => $request->name,
            'code' => $code,
            'admin_id' => auth()->user()->id,
        ]);

        $group->participants()->attach(auth()->user()->id);
        $data = [
            "success" => "Group successfully created!!",
        ];

       return response()->json($data);

    }
}
