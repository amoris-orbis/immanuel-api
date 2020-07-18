<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function () {
    return [
        'api_key' => hash('sha256', Str::random(32)),
        'api_secret' => Hash::make('secret'),
        'start' => Carbon::today()->startOfMonth(),
        'quota' => 100,
    ];
});
