<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProxy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        return $next($request);
    }

    private function isFromLocal(Request $request): bool
    {
        $localHosts = config('app.local_urls');

        return in_array($request->getSchemeAndHttpHost(), $localHosts);
    }
}
