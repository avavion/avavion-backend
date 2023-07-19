<?php

namespace App\Contracts\Repositories;

use App\Dto\User\CreateUserDto;
use App\Dto\User\UserDto;
use App\Models\User;

interface UserRepositoryContract
{
    /**
     * @return array<UserDto>
     */
    public function getAll(): array;

    /**
     * @return array<UserDto>
     */
    public function getAllWithConfirmedEmail(): array;

    /**
     * @param string $id
     * @return UserDto|null
     */
    public function getById(string $id): UserDto|null;

    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User;

    /**
     * @param string $email
     * @return bool
     */
    public function existByEmail(string $email): bool;

    public function create(CreateUserDto $createUserDto);
}
