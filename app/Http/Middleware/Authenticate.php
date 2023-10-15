<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $url = env('LIVE_DOAMIN', 'localhost');
        if (!$request->expectsJson()) {
            $host = $request->getHost();
            if (strpos($host, 'app.'.$url) !== false) {
                return route('login');
            } else {
                return route('tlogin');
            }
        }    
        
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
    }
}
