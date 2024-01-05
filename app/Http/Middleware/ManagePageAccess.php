<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\ManagePage;
use Illuminate\Http\Request;

use Session;

class ManagePageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // get subdomain
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        $instructor = User::where('subdomain',$subdomain)->first();
        $pageAccess = ManagePage::where('instructor_id',$instructor->id)->first();

        if ($pageAccess) {

            $permission = json_decode($pageAccess->pagePermissions);
            $path = $request->path();

            if ($path == 'student/dashboard') {
                if ($permission->dashboard == 0) {
                    return redirect('student/profile/myprofile')->with('error', 'You do not have permission to access Dashboard page!');
                }
            }
            if ($path == 'student/home') {
                if ($permission->homePage == 0) {
                    return redirect('student/profile/myprofile')->with('error', 'You do not have permission to access Home page!');
                }
            }
            if ($path == 'course/messages/students') {
                if ($permission->messagePage == 0) {
                    return redirect('student/profile/myprofile')->with('error', 'You do not have permission to access Message page!');
                }
            }
            if ($path == 'student/courses-certificate') {
                if ($permission->certificatePage == 0) {
                    return redirect('student/profile/myprofile')->with('error', 'You do not have permission to access Certificate page!');
                }
            }

        }

        // page.access
        return $next($request);
    }
}
