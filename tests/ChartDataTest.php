<?php

class ChartDataTest extends ChartTestCase
{
    /**
     * Ensure the python script returns JSON & has correct data.
     *
     */
    public function testNatalChart()
    {
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertTrue($this->response['planets']['sun']['sign'] === 'Scorpio');
    }

    public function testSolarReturnChart()
    {
        $this->post('/chart/solar', $this->solarChartInput);
        $this->assertTrue($this->response['planets']['moon']['sign'] === 'Aquarius');
    }

    public function testProgressedChart()
    {
        $this->post('/chart/progressed', $this->progressedChartInput);
        $this->assertTrue($this->response['planets']['moon']['sign'] === 'Virgo');
    }

    public function testSynastryChart()
    {
        $this->post('/chart/natal/synastry', $this->synastryChartInput);
        $this->assertTrue($this->response['secondary']['planets']['sun']['sign'] === 'Aquarius');
    }

    public function testTransits()
    {
        $this->post('/chart/natal/transits', $this->transitInput);
        $this->assertTrue($this->response['transits']['planets']['sun']['sign'] === 'Cancer');
    }

    public function testPrimaryAspectsToTransits()
    {
        $this->post('/chart/natal/transits', $this->transitInput + ['aspects' => 'transits']);
        $this->assertTrue($this->response['primary']['planets']['sun']['aspects']['moon']['type'] === 'Quincunx');
    }

    public function testSingleChartChartWithForcedKey()
    {
        $this->post('/chart/natal', $this->natalChartInput + ['force_primary_chart_key' => 'true']);
        $this->assertTrue(isset($this->response['primary']));
    }
}
