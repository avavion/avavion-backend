<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Dto\User\CreateUserDto;
use App\Dto\User\UserDto;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Throwable;

readonly class UserRepository implements UserRepositoryContract
{
    /**
     * @return array<UserDto>
     */
    public function getAll(): array
    {
        $users = User::query()->get();

        $mapped = [];

        /** @var User $user */
        foreach ($users as $user) {
            $mapped[] = new UserDto(
                id: $user->id,
                firstName: $user->first_name,
                lastName: $user->last_name,
                username: $user->username,
                email: $user->email,
                role: $user->role,
                emailVerifiedAt: $user->email_verified_at
            );
        }

        return $mapped;
    }

    public function getByEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    /**
     * @return array<UserDto>
     */
    public function getAllWithConfirmedEmail(): array
    {
        $users = User::query()->whereNot('email_verified_at', '=', null)->get();

        $mapped = [];

        foreach ($users as $user) {
            $mapped[] = new UserDto(
                id: $user->id,
                firstName: $user->first_name,
                lastName: $user->last_name,
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
    public function getById(string $id): UserDto|null
    {
        /** @var User $user */
        $user = User::query()->where('id', '=', $id)->first();

        if (is_null($user)) {
            return null;
        }

        return new UserDto(
            id: $user->id,
            firstName: $user->first_name,
            lastName: $user->last_name,
            username: $user->username,
            email: $user->email,
            role: $user->role,
            emailVerifiedAt: $user->email_verified_at
        );
    }

    /**
     * @param string $email
     * @return bool
     */
    public function existByEmail(string $email): bool
    {
        return User::whereEmail($email)->exists();
    }

    /**
     * @param CreateUserDto $createUserDto
     * @return Model|Builder
     * @throws ApiException
     */
    public function create(CreateUserDto $createUserDto): Model|Builder
    {
        try {
            return User::query()->create([
                'email' => $createUserDto->email,
                'username' => $createUserDto->username,
                'last_name' => $createUserDto->lastName,
                'first_name' => $createUserDto->email,
                'password' => Hash::make($createUserDto->password),
                'role' => $createUserDto->role->value,
            ]);
        } catch (Throwable) {
            throw new ApiException('Cannot create User', 500);
        }
    }
}
