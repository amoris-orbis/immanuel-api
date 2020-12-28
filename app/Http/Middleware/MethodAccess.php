<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class MethodAccess
{
    protected $methods = ['natal', 'solar', 'progressed', 'synastry', 'transits'];

    /**
     * Handle an incoming request.
     * Requests are blocked if user does not have permission to access this API method.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestedMethods = array_intersect($request->segments(), $this->methods);

        // If any requested method is not in the list then forbid access, unless it is admin level (ie. empty).
        if (!empty($request->user()->method_access) && array_diff($requestedMethods, $request->user()->method_access)) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
