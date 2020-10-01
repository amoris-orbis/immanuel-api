<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

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
        // If quota is reached then forbid access, unless it is infinite (ie. zero).
        if ($request->user()->quota > 0 && $request->user()->requests >= $request->user()->quota) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        // If quota is not reached then increment counters.
        $request->user()->update([
            'requests' => $request->user()->requests + 1,
            'lifetime_requests' => $request->user()->lifetime_requests + 1,
        ]);

        return $next($request);
    }
}
