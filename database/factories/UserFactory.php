<?php

namespace Database\Factories;

use App\Enums\UserRolesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'last_name' => fake()->lastName,
            'first_name' => fake()->firstName,
            'email' => fake()->unique()->safeEmail,
            'username' => fake()->unique()->userName,
            'password' => Hash::make('avavionmvm'),
            'role' => UserRolesEnum::USER,
            'email_verified_at' => fake()->boolean() ? fake()->dateTime() : null
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
