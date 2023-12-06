<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubdomainMiddleware
{

    public function handle($request, Closure $next)
    {
        $subdomain = $this->getSubdomain($request);
        config(['app.subdomain' => $subdomain]);

        // $request->query->set('subdomain', $subdomain);
        return $next($request);
    }

    private function getSubdomain($request)
    {
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        return $subdomain;
    }
}
