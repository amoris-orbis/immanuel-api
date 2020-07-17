<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            // Accept key & secret in either the header or the body.
            if ($request->header('Authorization')) {
                $apiKey = $request->getUser();
                $apiSecret = $request->getPassword();
            } elseif ($request->has('api_key', 'api_secret')) {
                $apiKey = $request->input('api_key');
                $apiSecret = $request->input('api_secret');
            }

            // If both were passed, then find the user.
            if (isset($apiKey, $apiSecret)) {
                $user = User::where('api_key', hash('sha256', $apiKey))->first();

                if ($user && Hash::check($apiSecret, $user->api_secret)) {
                    return $user;
                }
            }

            // If both weren't passed, or were invalid, return null.
            return null;
        });
    }
}
