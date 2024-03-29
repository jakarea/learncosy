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
        $domain = env('APP_DOMAIN', 'learncosy.com');

        if (!$request->expectsJson()) {

            $host = $request->getHost();
            $subdomain = explode('.', $host)[0];

            // dd($subdomain );

            if (strpos($host, 'app.'.$domain) !== false) {
                return route('login', ['subdomain' => $subdomain]);
            } else {

                return route('login', ['subdomain' => $subdomain]);
            }
        }


        // if (! $request->expectsJson()) {
        //     return route('login');
        // }
    }


}
