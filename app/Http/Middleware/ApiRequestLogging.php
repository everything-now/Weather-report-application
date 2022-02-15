<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiRequestLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        app('log')->info('Outgoing response: ' . $request);

        return $next($request);
    }

    public function terminate(Request $request, $response)
    {
        app('log')->info('Outgoing response: ' . $response);
    }
}
