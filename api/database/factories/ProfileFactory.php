<?php

namespace Database\Factories;

use Domain\Enums\UserAgeEnum;
use Domain\User\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'age' => fake()->randomElement(UserAgeEnum::values()),
            'gender' => fake()->numberBetween(0, 1),
            'is_subscribed' => fake()->boolean(),
        ];
    }
}
