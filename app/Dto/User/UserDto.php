<?php

namespace App\Dto\User;

use App\Enums\UserRolesEnum;

readonly class UserDto
{
    public function __construct(
        public string        $id,
        public string        $firstName,
        public string        $lastName,
        public string        $username,
        public string        $email,
        public UserRolesEnum $role,
        public ?string       $emailVerifiedAt
    )
    {
    }
}
