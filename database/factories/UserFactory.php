<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'api_key' => hash('sha256', Str::random(32)),
            'api_secret' => Hash::make('secret'),
            'method_access' => ['natal', 'solar', 'progressed', 'synastry', 'transits'],
            'start' => Carbon::today()->startOfMonth(),
            'end' => Carbon::today()->endOfMonth(),
            'quota' => 10,
        ];
    }
}
