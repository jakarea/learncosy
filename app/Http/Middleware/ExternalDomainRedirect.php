<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExternalDomainRedirect
{
    public function handle(Request $request, Closure $next)
    {
        // if ($this->isExternalDomain($request)) {
        //     if ($this->isDomainVerified($request)) {
        //         return $next($request);
        //     }

        //     return response()->view('unverified_domain');
        // }

        // return redirect()->route('your.route.name');



        // $verifiedDomain = 'cr7.ltd';

        // $appDomain = 'instructor.localhost';

        // if ($request->getHost() === $verifiedDomain) {
        //     return redirect()->to($appDomain);
        // }

        // Continue processing the request
        // return $next($request);
    }

    protected function isExternalDomain(Request $request)
    {
        $applicationDomain = $request->getHost();
        return $request->getHost() !== 'learncosy.com';
    }

    protected function isDomainVerified(Request $request)
    {
        return true;
    }
}
