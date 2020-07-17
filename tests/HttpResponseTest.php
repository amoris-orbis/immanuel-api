<?php

use Illuminate\Support\Arr;

class HttpResponseTest extends ChartTestCase
{
    /**
     * Ensure a 200 OK response with valid natal data.
     *
     * @return void
     */
    public function testValidNatalRequest()
    {
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Ensure a 200 OK response with valid solar return data.
     *
     * @return void
     */
    public function testValidSolarRequest()
    {
        $this->post('/chart/solar', $this->solarChartInput);
        $this->assertEquals(200, $this->response->status());
    }

    /**
     * Ensure a 400 "Bad Request" response for malformed data.
     * In this case birth_date & solar_return_year are formatted incorrectly.
     *
     * @return void
     */
    public function testBadNatalRequestMalformedData()
    {
        $natalChartInput = Arr::set($this->natalChartInput, 'birth_date', '30/10/2000');
        $this->post('/chart/natal', $natalChartInput);
        $this->assertEquals(400, $this->response->status());
    }

    public function testBadSolarRequestMalformedData()
    {
        $solarChartInput = Arr::set($this->solarChartInput, 'solar_return_year', '25');
        $this->post('/chart/solar', $solarChartInput);
        $this->assertEquals(400, $this->response->status());
    }

    /**
     * Ensure a 400 "Bad Request" response for missing data.
     * In this case we remove the latitude key.
     *
     * @return void
     */
    public function testBadNatalRequestMissingData()
    {
        $natalChartInput = Arr::except($this->natalChartInput, 'latitude');
        $this->post('/chart/natal', $natalChartInput);
        $this->assertEquals(400, $this->response->status());
    }

    /**
     * Ensure a 400 "Bad Request" response for missing data.
     * In this case solar_return_year is missing.
     *
     * @return void
     */
    public function testBadSolarRequestMissingData()
    {
        $this->post('/chart/solar', $this->natalChartInput);
        $this->assertEquals(400, $this->response->status());
    }
}
