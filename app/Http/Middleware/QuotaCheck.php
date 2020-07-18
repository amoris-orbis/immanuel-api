<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class QuotaCheck
{
    /**
     * Handle an incoming request.
     * Requests are blocked if user has exceeded their quota.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If quota is reached then forbid access.
        if (Auth::user()->requests >= Auth::user()->quota) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        // If quota is not reached then increment counters.
        Auth::user()->update([
            'requests' => Auth::user()->requests + 1,
            'lifetime_requests' => Auth::user()->lifetime_requests + 1,
        ]);

        return $next($request);
    }
}
