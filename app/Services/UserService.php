<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\UserServiceContract;
use App\Dto\User\UserDto;

readonly class UserService implements UserServiceContract
{
    public function __construct(
        private UserRepositoryContract $userRepository
    )
    {
    }

    /**
     * @return array|UserDto[]
     */
    public function getAllUsers(): array
    {
        return $this->userRepository->getAllUsers();
    }

}