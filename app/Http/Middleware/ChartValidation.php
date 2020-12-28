<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use RiftLab\ImmanuelChart\Facades\Chart;

class ChartValidation
{
    protected $validators = ['natal', 'solar', 'progressed', 'synastry'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // All validators that match the requested charts.
        $validators = array_merge(array_intersect($this->validators, $request->segments()), ['optional']);

        if (Chart::validate($request->all(), $validators)->fails()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
