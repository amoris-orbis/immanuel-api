<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RiftLab\ImmanuelChart\Facades\Chart;

class ChartController extends Controller
{
    protected $methods = [
        'natal' => 'addNatalChart',
        'solar' => 'addSolarReturnChart',
        'progressed' => 'addProgressedChart',
        'synastry' => 'addSynastryChart',
        'transits' => 'addTransits',
    ];

    protected $aspectsTo = [
        'solar' => 'aspectsToSolarReturn',
        'progressed' => 'aspectsToProgressed',
        'synastry' => 'aspectsToSynastry',
        'transits' => 'aspectsToTransits',
    ];

    public function buildChart(Request $request, $primaryChart, $secondaryChart = null, $transits = null)
    {
        // Set up base chart.
        $chart = Chart::create($request->all());
        // Add primary chart.
        $chart->{$this->methods[$primaryChart]}();
        // Add secondary chart if requested.
        if ($secondaryChart) {
            $chart->{$this->methods[$secondaryChart]}();
        }
        // Add transit chart if requested.
        if ($transits) {
            $chart->addTransits();
        }
        // Define primary chart's aspects if requested.
        if($request->has('aspects') && isset($this->aspectsTo[$request->input('aspects')])) {
            $chart->{$this->aspectsTo[$request->input('aspects')]}();
        }
        // Decide how to structure returned object(s).
        $forcePrimaryOnSingleChart = $request->input('force_primary_chart_key', false);
        // Return data.
        return $chart->get($forcePrimaryOnSingleChart);
    }
}
