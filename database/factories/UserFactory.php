<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
            'first_name'        => $this->faker->firstName,
            'last_name'         => $this->faker->lastName,
            'email'             => $this->faker->unique()->safeEmail,
            'steam_id'          => $this->steamId(),
            'discord_id'        => $this->discordId(),
            'remember_token'    => Str::random(10),
        ];
    }

    protected function steamId()
    {
        $possible = '765611xxxxxxxx' . $this->faker->numberBetween(100,999);
        $check = User::firstWhere('steam_id', $possible);
        return is_null($check)
            ? $possible
            : $this->steamId();
    }

    protected function discordId()
    {
        $possible = '3240601xxxxxxx'. $this->faker->numberBetween(1000,9999);
        $check = User::firstWhere('discord_id', $possible);
        return is_null($check)
            ? $possible
            : $this->discordId();
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
