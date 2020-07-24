<?php

class ChartDataTest extends ChartTestCase
{
    /**
     * Ensure the python script returns JSON & has correct data.
     *
     * @return void
     */
    public function testNatalChartJson()
    {
        $this->post('/chart/natal', $this->natalChartInput)->seeJson([
            'planet' => 'Sun',
            'sign' => 'Scorpio',
        ]);
    }

    public function testSolarChartJson()
    {
        $this->post('/chart/solar', $this->solarChartInput)->seeJson([
            'planet' => 'Moon',
            'sign' => 'Sagittarius',
        ]);
    }

    public function testProgressedChartJson()
    {
        $this->post('/chart/progressed', $this->progressedChartInput)->seeJson([
            'planet' => 'Moon',
            'sign' => 'Virgo',
        ]);
    }
}
