<?php

class UserDataTest extends ChartTestCase
{
    /**
     * Ensure user's counters gets updated on requests.
     *
     * @return void
     */
    public function testNatalRequestIncrement()
    {
        $requests = $this->user->requests;
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals($requests + 1, $this->user->refresh()->requests);
    }

    public function testNatalLifetimeRequestIncrement()
    {
       $lifetimeRequests = $this->user->lifetime_requests;
       $this->post('/chart/natal', $this->natalChartInput);
       $this->assertEquals($lifetimeRequests + 1, $this->user->refresh()->lifetime_requests);
    }

    public function testSolarRequestIncrement()
    {
       $requests = $this->user->requests;
       $this->post('/chart/solar', $this->solarChartInput);
       $this->assertEquals($requests + 1, $this->user->refresh()->requests);
    }

    public function testSolarLifetimeRequestIncrement()
    {
      $lifetimeRequests = $this->user->lifetime_requests;
      $this->post('/chart/solar', $this->solarChartInput);
      $this->assertEquals($lifetimeRequests + 1, $this->user->refresh()->lifetime_requests);
    }

    /**
     * Ensure user's requests are blocked if quota is reached & allowed if quota is 0.
     *
     * @return void
     */
    public function testQuotaForbidden()
    {
        $this->user->update(['requests' => $this->user->quota]);
        $this->post('/chart/natal', $this->natalChartInput)->response->assertForbidden();
    }

    public function testZeroQuotaOk()
    {
        $this->user->update(['requests' => 1, 'quota' => 0]);
        $this->post('/chart/natal', $this->natalChartInput)->response->assertOk();
    }
}
