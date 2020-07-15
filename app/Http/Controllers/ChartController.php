<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Sunlight\ImmanuelChart\Facades\Chart;

class ChartController extends Controller
{
    /**
     * Generate natal chart data based on inputs.
     *
     * @param  Request  $request
     * @return Response
     */
    public function natalChart(Request $request)
    {
        $chartData = Chart::create($request->all())->getNatalChart();

        if ($chartData !== false) {
            return response()->json($chartData);
        }

        return response(null, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Generate solar return chart data based on inputs.
     *
     * @param  Request  $request
     * @return Response
     */
    public function solarChart(Request $request)
    {
        $chartData = Chart::create($request->all())->getSolarReturnChart($request->input('solar_return_year'));

        if ($chartData !== false) {
            return response()->json($chartData);
        }

        return response(null, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
