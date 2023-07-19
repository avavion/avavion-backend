<?php

namespace App\Dto\User;

use App\Enums\UserRolesEnum;

readonly class CreateUserDto
{
    public function __construct(
        public string        $firstName,
        public string        $lastName,
        public string        $email,
        public string        $username,
        public string        $password,
        public UserRolesEnum $role = UserRolesEnum::USER
    )
    {
    }
}
