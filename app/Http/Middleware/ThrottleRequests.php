<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Response;

class ThrottleRequests
{
    /**
     * Handle an incoming request.
     * Requests are blocked if they're coming in too fast.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $limiter = app(RateLimiter::class);
        $limiterKey = $request->user()->api_key;

        if ($limiter->tooManyAttempts($limiterKey, 1)) {
            return response(null, Response::HTTP_TOO_MANY_REQUESTS);
        }

        $limiter->hit($limiterKey, config('app.request_throttle_seconds'));

        return $next($request);
    }
}
