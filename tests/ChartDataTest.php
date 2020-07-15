<?php

class ChartDataTest extends TestCase
{
    /**
     * Ensure the python script returns JSON & has correct data.
     *
     * @return void
     */
    public function testNatalChartJson()
    {
        $this->json('POST', '/chart/natal', $this->natalChartInput)->seeJson([
            'planet' => 'Sun',
            'sign' => 'Scorpio',
        ]);
    }

    public function testSolarChartJson()
    {
        $this->json('POST', '/chart/solar', $this->solarChartInput)->seeJson([
            'planet' => 'Moon',
            'sign' => 'Sagittarius',
        ]);
    }
}
