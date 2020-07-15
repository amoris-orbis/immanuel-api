<?php

use Illuminate\Support\Arr;

class HttpResponseTest extends TestCase
{
    /**
     * Ensure a 200 OK response with valid natal data.
     *
     * @return void
     */
    public function testValidNatalRequest()
    {
        $response = $this->call('POST', '/chart/natal', $this->natalChartInput);
        $this->assertEquals(200, $response->status());
    }

    /**
     * Ensure a 200 OK response with valid solar return data.
     *
     * @return void
     */
    public function testValidSolarRequest()
    {
        $response = $this->call('POST', '/chart/solar', $this->solarChartInput);
        $this->assertEquals(200, $response->status());
    }

    /**
     * Ensure a 400 "Bad Request" response for malformed data.
     * In this case birth_date & solar_return_year are formatted incorrectly.
     *
     * @return void
     */
    public function testBadNatalRequestMalformedData()
    {
        $chartInput = ['birth_date' => '30/10/2000'] + $this->natalChartInput;
        $response = $this->call('POST', '/chart/natal', $chartInput);
        $this->assertEquals(400, $response->status());
    }

    public function testBadSolarRequestMalformedData()
    {
        $chartInput = ['solar_return_year' => '25'] + $this->solarChartInput;
        $response = $this->call('POST', '/chart/solar', $chartInput);
        $this->assertEquals(400, $response->status());
    }

    /**
     * Ensure a 400 "Bad Request" response for missing data.
     * In this case we remove the latitude key.
     *
     * @return void
     */
    public function testBadNatalRequestMissingData()
    {
        $chartInput = Arr::except($this->natalChartInput, 'latitude');
        $response = $this->call('POST', '/chart/natal', $chartInput);
        $this->assertEquals(400, $response->status());
    }

    /**
     * Ensure a 400 "Bad Request" response for missing data.
     * In this case solar_return_year is missing.
     *
     * @return void
     */
    public function testBadSolarRequestMissingData()
    {
        $response = $this->call('POST', '/chart/solar', $this->natalChartInput);
        $this->assertEquals(400, $response->status());
    }
}
