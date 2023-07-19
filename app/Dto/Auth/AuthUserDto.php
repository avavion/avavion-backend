<?php

namespace App\Dto\Auth;

use App\Enums\UserRolesEnum;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

readonly class AuthUserDto
{
    public function __construct(
        public int           $id,
        public string        $firstName,
        public string        $lastName,
        public string        $username,
        public string        $email,
        public UserRolesEnum $role,
        public ?string       $token,
        public ?string       $emailVerifiedAt = null,
    )
    {
    }

    /**
     * @throws ApiException
     */
    public static function makeFromAuth(): AuthUserDto
    {
        if (!Auth::check()) throw new ApiException('Forbidden', 403);

        /** @var User $user */
        $user = Auth::user();

        return new AuthUserDto(
            id: $user->id,
            firstName: $user->first_name,
            lastName: $user->last_name,
            username: $user->username,
            email: $user->email,
            role: $user->role,
            token: $user->currentAccessToken(),
            emailVerifiedAt: $user->email_verified_at
        );
    }

}
