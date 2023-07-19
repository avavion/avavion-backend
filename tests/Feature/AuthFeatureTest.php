<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthFeatureTest extends TestCase
{
    public function testLoginSuccess(): void
    {
        $secret = 'avavionmvm';

        /** @var User $user */
        $user = User::factory()->create([
            'password' => Hash::make($secret)
        ]);

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => $secret
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'token'
            ],
            'status'
        ]);
    }

    public function testRegistrationSuccess(): void
    {
        $user = [
            'last_name' => fake()->lastName,
            'first_name' => fake()->firstName,
            'email' => fake()->unique()->safeEmail,
            'username' => fake()->unique()->userName,
            'password' => 'avavionmvm',
            'password_confirmation' => 'avavionmvm'
        ];

        $response = $this->post(route('auth.registration'), $user);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'token'
            ],
            'status'
        ]);
    }

    public function testRegistrationUserExists(): void
    {
        $user = [
            'last_name' => fake()->lastName,
            'first_name' => fake()->firstName,
            'email' => fake()->unique()->safeEmail,
            'username' => fake()->unique()->userName,
            'password' => 'avavionmvm',
        ];

        User::factory()->create($user);

        $user['password_confirmation'] = 'avavionmvm';

        $response = $this->post(route('auth.registration'), $user);

        $response->assertBadRequest();
    }
}
