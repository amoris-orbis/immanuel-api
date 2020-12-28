<?php

return [

    /*
    |--------------------------------------------------------------------------
    | This API's parent website
    |--------------------------------------------------------------------------
    |
    | A normal http GET request made to this API's root will redirect the user
    | to the main Immanuel website for account signup & management.
    |
    */

    'parent_site_url' => 'https://immanuel.app',

    /*
    |--------------------------------------------------------------------------
    | Throttled time between allowed requests per user
    |--------------------------------------------------------------------------
    |
    | Each user has their request rate throttled so as to avoid overloading the
    | server and/or re-selling the service with the same set of API keys.
    |
    */

    'request_throttle_seconds' => env('REQUEST_THROTTLE_SECONDS', 1),

];
