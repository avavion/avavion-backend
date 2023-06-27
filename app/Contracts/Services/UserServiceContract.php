<?php

namespace App\Contracts\Services;

use App\Dto\User\UserDto;

interface UserServiceContract
{
    /**
     * @return array<UserDto>
     */
    public function getAllUsers(): array;
}
