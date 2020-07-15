<?php

use Illuminate\Support\Arr;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Arbitrary chart details for consistent testing.
     *
     */
    protected $natalChartInput;

    protected $solarChartInput;

    /**
     * Populate testing data here.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->natalChartInput = [
            'latitude' => '38.5616505',
            'longitude' => '-121.5829968',
            'birth_date' => '2000-10-30',
            'birth_time' => '05:00',
            'house_system' => 'Polich Page',
        ];

        $this->solarChartInput = Arr::add($this->natalChartInput, 'solar_return_year', 2025);
    }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
