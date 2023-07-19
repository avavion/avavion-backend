<?php

namespace App\Dto\Auth;

readonly class RegistrationUserDto
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $username,
        public string $email,
        public string $password,
        public bool   $remember = false
    )
    {
    }
}
