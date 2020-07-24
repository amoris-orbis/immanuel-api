<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Sunlight\ImmanuelChart\Facades\Chart;

class ChartValidation
{
    /**
     * Always default to basic chart validation.
     *
     */
    protected $validators = ['chart'];

    /**
     * Handle an incoming request.
     * If this a request for a solar return chart, we require the year up-front
     * along with all the natal chart inputs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch ($request->path()) {
            case 'chart/solar':
                $this->validators[] = 'solar';
                break;

            case 'chart/progressed':
                $this->validators[] = 'progressed';
                break;
        }

        if (Chart::validate($request->all(), $this->validators)->fails()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
