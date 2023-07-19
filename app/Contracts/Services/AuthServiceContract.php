<?php

namespace App\Contracts\Services;

use App\Dto\Auth\AuthUserDto;
use App\Dto\Auth\LoginUserDto;
use App\Dto\Auth\RegistrationUserDto;

interface AuthServiceContract
{
    public function login(LoginUserDto $loginUserDto): string;

    public function registration(RegistrationUserDto $registrationUserDto): string;

    public function logout();
}
