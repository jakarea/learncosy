<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Group;

class GroupOwner  //
{

    public function handle(Request $request, Closure $next)
    {
        $group = Group::find($request->id);

        if ($group->admin_id == auth()->user()->id)
        {
            return $next($request);
        }
        else
        {
            return redirect('/logout')->with('error', 'Unauthorized');
        }

    }
}
