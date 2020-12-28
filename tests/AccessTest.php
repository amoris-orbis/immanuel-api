<?php

class AccessTest extends ChartTestCase
{
    /**
     * Check a user with natal chart permission can access the endpoint.
     *
     */
    public function testCanAccessNatal()
    {
        $this->assertTrue(in_array('natal', $this->user->method_access));
        $this->post('/chart/natal', $this->natalChartInput)->response->assertOk();
    }

    /**
     * Check a user without natal chart permission cannot access the endpoint.
     *
     */
    public function testCannotAccessNatal()
    {
        $this->assertTrue(in_array('natal', $this->user->method_access));
        $this->user->update([
            'method_access' => ['solar', 'progressed'],
        ]);
        $this->post('/chart/natal', $this->natalChartInput)->response->assertForbidden();
    }

    /**
     * Check a user with empty permissions can access the natal endpoint
     * (and by extension, all endpoints).
     *
     */
    public function testCanAccessNatalWithEmptyPermissions()
    {
        $this->assertTrue(in_array('natal', $this->user->method_access));
        $this->user->update([
            'method_access' => [],
        ]);
        $this->post('/chart/natal', $this->natalChartInput)->response->assertOk();
    }
}
