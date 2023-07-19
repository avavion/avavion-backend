<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\AuthServiceContract;
use App\Dto\Auth\LoginUserDto;
use App\Dto\Auth\RegistrationUserDto;
use App\Dto\User\CreateUserDto;
use App\Enums\UserRolesEnum;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class AuthService implements AuthServiceContract
{
    public function __construct(
        private UserRepositoryContract $userRepository
    )
    {
    }

    /**
     * @throws ApiException
     */
    public function registration(RegistrationUserDto $registrationUserDto): string
    {
        if ($this->userRepository->existByEmail($registrationUserDto->email)) {
            throw new BadRequestHttpException('User already exists, log in or reset password');
        }

        $user = $this->userRepository->create(new CreateUserDto(
            firstName: $registrationUserDto->firstName,
            lastName: $registrationUserDto->lastName,
            email: $registrationUserDto->email,
            username: $registrationUserDto->username,
            password: $registrationUserDto->password,
            role: UserRolesEnum::USER
        ));

        $authorized = Auth::attempt([
            'email' => $registrationUserDto->email,
            'password' => $registrationUserDto->password
        ], $registrationUserDto->remember);

        if (!$authorized) throw new ApiException('User not found', 404);

        return $user->createToken(env('TOKEN_SECRET_KEY'))->plainTextToken;
    }

    public function login(LoginUserDto $loginUserDto): string
    {
        $user = $this->userRepository->getByEmail($loginUserDto->email);

        if (is_null($user) || !Hash::check($loginUserDto->password, $user->password))
            throw new NotFoundHttpException();

        return $user->createToken(env('TOKEN_SECRET_KEY'))->plainTextToken;
    }

    public function logout(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $user->tokens()->delete();
    }
}
