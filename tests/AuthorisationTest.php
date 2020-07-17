<?php

class AuthorisationTest extends ChartTestCase
{
    /**
     * Make sure we're not authorised by default.
     *
     */
    protected $authorisationType = self::AUTHORISE_NONE;

    /**
     * Ensure both types of auth work.
     *
     * @return void
     */
    public function testHeaderAuthPasses()
    {
        $this->authorise(self::AUTHORISE_HEADER);
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals(200, $this->response->status());
    }

    public function testBodyAuthPasses()
    {
        $this->authorise(self::AUTHORISE_BODY);
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals(200, $this->response->status());
    }

    public function testBadAuthKeyFails()
    {
        $this->apiKey = 'Wrong_Key';
        $this->authorise(self::AUTHORISE_HEADER);
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals(401, $this->response->status());
    }

    public function testBadAuthSecretFails()
    {
        $this->apiSecret = 'Wrong_Secret';
        $this->authorise(self::AUTHORISE_HEADER);
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals(401, $this->response->status());
    }

    public function testNoAuthFails()
    {
        $this->post('/chart/natal', $this->natalChartInput);
        $this->assertEquals(401, $this->response->status());
    }
}
