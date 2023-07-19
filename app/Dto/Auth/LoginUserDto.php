<?php

namespace App\Dto\Auth;

readonly class LoginUserDto
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}
