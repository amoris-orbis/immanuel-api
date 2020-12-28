<?php

class ThrottleTest extends ChartTestCase
{
    public function testRequestsAreThrottled()
    {
        $this->post('/chart/natal', $this->natalChartInput)->response->assertOk();
        $this->post('/chart/natal', $this->natalChartInput)->response->assertStatus(429);
        sleep(config('app.request_throttle_seconds') + 1);
        $this->post('/chart/natal', $this->natalChartInput)->response->assertOk();
    }
}
