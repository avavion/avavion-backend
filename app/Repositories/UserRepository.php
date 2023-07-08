<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Dto\User\UserDto;
use App\Models\User;

readonly class UserRepository implements UserRepositoryContract
{
    /**
     * @return array<UserDto>
     */
    public function getAllUsers(): array
    {
        $users = User::query()->get();

        $mapped = [];

        foreach ($users as $user) {
            $mapped[] = new UserDto(
                id: $user->id,
                username: $user->username,
                email: $user->email,
                role: $user->role,
                emailVerifiedAt: $user->email_verified_at
            );
        }

        return $mapped;
    }

    /**
     * @return array<UserDto>
     */
    public function getAllUsersWithConfirmedEmail(): array
    {
        $users = User::query()->whereNot('email_verified_at', '=', null)->get();

        $mapped = [];

        foreach ($users as $user) {
            $mapped[] = new UserDto(
                id: $user->id,
                username: $user->username,
                email: $user->email,
                role: $user->role,
                emailVerifiedAt: $user->email_verified_at
            );
        }

        return $mapped;
    }

    /**
     * @param string $id
     * @return UserDto|null
     */
    public function getUserById(string $id): UserDto|null
    {
        $user = User::query()->where('id', '=', $id)->first();

        if (is_null($user)) {
            return null;
        }

        return new UserDto(
            id: $user->id,
            username: $user->username,
            email: $user->email,
            role: $user->role,
            emailVerifiedAt: $user->email_verified_at
        );
    }
}
