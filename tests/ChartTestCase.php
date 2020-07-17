<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\TestCase;

abstract class ChartTestCase extends TestCase
{
    /**
     * Choose how to authorise.
     *
     */
    const AUTHORISE_NONE = 0;

    const AUTHORISE_HEADER = 1;

    const AUTHORISE_BODY = 2;

    /**
     * Headers & credentials for auth testing.
     *
     */
    protected $apiKey = 'Testing_Key';

    protected $apiSecret = 'Testing_Secret';

    protected $headers = [];

    protected $authorisationType = self::AUTHORISE_HEADER;

    /**
     * Fake user for auth testing.
     *
     */
    protected $user;

    /**
     * Arbitrary chart details for consistent testing.
     *
     */
    protected $natalChartInput;

    protected $solarChartInput;

    /**
     * Populate testing data here.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory('App\User')->create([
            'api_key' => hash('sha256', $this->apiKey),
            'api_secret' => Hash::make($this->apiSecret),
        ]);

        $this->natalChartInput = [
            'latitude' => '38.5616505',
            'longitude' => '-121.5829968',
            'birth_date' => '2000-10-30',
            'birth_time' => '05:00',
            'house_system' => 'Polich Page',
        ];

        $this->solarChartInput = Arr::add($this->natalChartInput, 'solar_return_year', 2025);

        // Auth by default if required.
        if ($this->authorisationType !== self::AUTHORISE_NONE) {
            $this->authorise();
        }
    }

    /**
     * Remove test user here.
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->user->delete();
    }

    /**
     * Test two different types of auth, and default to headers since most tests
     * require authorisation.
     *
     */
    protected function authorise($authorisationType = self::AUTHORISE_HEADER)
    {
        if ($authorisationType === self::AUTHORISE_HEADER) {
            // Authorise via headers.
            $this->headers = [
                'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':' . $this->apiSecret),
            ];
        } elseif ($authorisationType === self::AUTHORISE_BODY) {
            // Authorise via POSTed body.
            $this->natalChartInput += [
                'api_key' => $this->apiKey,
                'api_secret' => $this->apiSecret,
            ];
        }
    }

    /**
     * Silently add our headers to all post() requests.
     *
     */
    public function post($uri, array $data = [], array $headers = [])
    {
        return parent::post($uri, $data, array_merge($this->headers, $headers));
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
