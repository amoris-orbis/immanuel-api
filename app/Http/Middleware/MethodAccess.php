<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class MethodAccess
{
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
        $method = Str::afterLast($request->path(), '/');

        // If method is not in list then forbid access, unless it is admin level (ie. empty).
        if (!empty($request->user()->method_access) && !in_array($method, $request->user()->method_access)) {
            return response(null, Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
