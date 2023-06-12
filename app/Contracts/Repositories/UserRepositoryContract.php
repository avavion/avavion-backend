<?php

namespace App\Contracts\Repositories;

use App\Dto\User\UserDto;

interface UserRepositoryContract
{
    /**
     * @return array<UserDto>
     */
    public function getAllUsers(): array;

    /**
     * @return array<UserDto>
     */
    public function getAllUsersWithConfirmedEmail(): array;

    /**
     * @param string $id
     * @return UserDto|null
     */
    public function getUserById(string $id): UserDto|null;
}
